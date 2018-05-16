import '../css/app.scss';

$('.modal').prependTo('body');
$('.cms_block_edit_form').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        success: function (content) {
            $('body').append(content);
            location.reload();
        },
    });
});