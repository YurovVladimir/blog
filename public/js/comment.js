var body = $('body');

body.on('click', '.edit_comment', function () {
    let comment_id = $(this).attr('data-comment_id');
    $('#comment_' + comment_id).show();
    $('.btn[data-comment_id=' + comment_id + ']').show();
    $('.comment_' + comment_id).hide();
});

body.on('click', '.save_comment', function () {
    let comment_id = $(this).attr('data-comment_id'),
        post_id = $('#post_id').val(),
        comment_textarea = $('#comment_' + comment_id);
    $.ajax({
        type: "PUT",
        url: "/comments/" + comment_id,
        data: {
            'post_id': post_id,
            'text': comment_textarea.val(),
            '_token': $('input[name=_token]').val(),
        },
        success: function (msg) {
            comment_textarea.hide();
            $('.save_comment[data-comment_id=' + comment_id + ']').hide();
            $('.comment_' + comment_id).text(comment_textarea.val()).show();
        },
        error: function (error) {
        }
    });
});

body.on('click', '.delete_comment', function () {
    let comment_id = $(this).attr('data-comment_id'),
        post_id = $('#post_id').val(),
        comment = $(this).parents('.comment_block');

    $.ajax({
        type: "DELETE",
        url: "/comments/" + comment_id,
        data: {
            'post_id': post_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function () {
            comment.remove();
        },
        error: function (error) {
        }
    });
});

$('.store_comment').on('click', function () {
    let post_id = $('#post_id').val(),
        template_comment = $('.comment_block[data-comment_id=0]').clone(),
        comment_input = $('#commentInput');
    $.ajax({
        type: "post",
        url: "/comments",
        data: {
            'post_id': post_id,
            '_token': $('input[name=_token]').val(),
            'text': comment_input.val(),
        },
        success: function (comment) {
            comment_input.val("");
            template_comment.attr("data-comment_id", comment.id);
            template_comment.find("[data-comment_id=0]").attr("data-comment_id", comment.id);
            template_comment.find(".comment_0").removeClass("comment_0").addClass("comment_" + comment.id).text(comment.text);
            template_comment.find("#comment_0").attr("id", "comment_" + comment.id).val(comment.text);
            template_comment.find(".created_at font").text("now");
            $(".comment-list").prepend(template_comment);
        },
        error: function (error) {

        }
    });
});

body.on('click', '.liked', function () {
    let self = $(this),
        comment_id = self.attr('data-comment_id'),
        tag_i = self.find('i'),
        user_id = $('meta[name=csrf-token]').attr('content');
    $.ajax({
        type: "POST",
        url: "/comments/" + comment_id + "/likes",
        data: {
            '_token': user_id,
            'is_liked': tag_i.hasClass('fa-heart-o'),
        },
        success: function (data) {
            let count_comm = self.find(".count"),
                count = parseInt(count_comm.text());
            if (isNaN(count)) {
                count = 0;
            }
            if (data) {
                tag_i.addClass('fa-heart').addClass('text-danger').removeClass('fa-heart-o').removeClass('text-default');
                count_comm.text(count + 1)
            } else {
                tag_i.removeClass('fa-heart').removeClass('text-danger').addClass('fa-heart-o').addClass('text-default');
                count_comm.text(count - 1)
            }
        },
        statusCode: {
            401: function () {
                showAuthAlert();
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
});

body.on('click', '.liked_post', function () {
    let self = $(this),
        post_id = self.attr('data-post_id'),
        tag_i = self.find('i'),
        token = $('meta[name=csrf-token]').attr('content');

    $.ajax({
        type: "POST",
        url: "/posts/" + post_id + "/likes",
        data: {
            '_token': token,
            'is_liked': tag_i.hasClass('fa-thumbs-o-up'),
        },
        success: function (data) {
            let count_post = self.find(".count_post"),
                count = parseInt(count_post.text());
            if (data) {
                tag_i.addClass('fa-thumbs-up').addClass('text-danger').removeClass('fa-thumbs-o-up').removeClass('text-default');
                count_post.text(count + 1)
            } else {
                tag_i.removeClass('fa-thumbs-up').removeClass('text-danger').addClass('fa-thumbs-o-up').addClass('text-default');
                count_post.text(count - 1)
            }
        },
        statusCode: {
            401: function () {
                showAuthAlert();
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
});

function showAuthAlert() {
    swall({
        title: 'Необходимо авторизоваться!',
        text: "Перейти в меню авторизации?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Да, перейти!',
        cancelButtonText: 'Не переходить.'
    }).then((result) => {
        if (result.value) {
            window.location.href = '/login'
        }
    });
}

body.on('click', '.follow', function () {
    $('.unfollow').show();
    $('.follow').hide();
});


body.on('click', '.unfollow', function () {
    $('.follow').show();
    $('.unfollow').hide();
});
