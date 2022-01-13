$(function () {
    let manualReset = false;
    $('form').on('reset', function (e) {
        if(manualReset) {
            manualReset = false;
            return;
        }
        e.preventDefault();
        confirmAction(function () {
            manualReset = true;
            $(e.currentTarget).trigger('reset');
            e.currentTarget.dispatchEvent(new Event('resetForm'));
        });
    });
});
