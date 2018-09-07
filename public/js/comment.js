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
            console.log(error);
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
            console.log(error);
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
            template_comment.find(".avatar_a").attr("src", "/img/default_avatar.jpg");
            template_comment.find(".created_at").text("now");
            template_comment.find(".user_name strong").text(comment.user.name);
            $(".comment-list").prepend(template_comment);
            console.log(comment);
        },
        error: function (error) {
            console.log(error);
        }
    });
});

