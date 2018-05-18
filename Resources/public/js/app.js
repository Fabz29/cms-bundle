$('.cms-block-editable').click(function () {
    var idElement = $(this).attr('data-modal-target');
    $(idElement).addClass('active');
    $(idElement).parent().addClass('active');
});

$('.close-modal').click(function () {
    $('.cms-modal-overlay, .cms-modal').removeClass('active');
});

$('.modal-overlay').prependTo('body');
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
$('.froala-editor').froalaEditor();