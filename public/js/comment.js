$('.edit_comment').on('click', function () {
    let comment_id = $(this).attr('data-comment_id');
    $('#comment_' + comment_id).show();
    $('.btn[data-comment_id=' + comment_id + ']').show();
    $('.comment_' + comment_id).hide();
});
$('.save_comment').on('click', function () {
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
            $('.btn[data-comment_id=' + comment_id + ']').hide();
            $('.comment_' + comment_id).text(comment_textarea.val()).show();
        },
        error: function (error) {
            console.log(error);
        }
    });
})