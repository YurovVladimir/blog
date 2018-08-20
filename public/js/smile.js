$('#smile').on('input', function (eventObject) {
    $('#result').text($(this).val().replace(/\)\)+/g, ":)"))
});