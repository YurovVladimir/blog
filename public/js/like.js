var body = $('body');
body.on('click', '.liked', function () {
    let comment_id = $(this).attr('data-comment_id'),
        like = (comment_id + likes()).create({
            'is_liked': true,
            'user_id': auth().user_id
        });
    $.ajax({
        type: "PUT",
        url: "/comments/" + comment_id,
        data: {
            'post_id': post_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function () {
            like.show()
        },
        error: function (error) {
            console.log(error);
        }
    });
});