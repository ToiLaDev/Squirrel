Quill.register('modules/imageBrowser', function(quill, options) {
    let range = quill.getSelection(true);
    const insertToEditor = (url) => {
        quill.insertEmbed(range.index, 'image', url, Quill.sources.USER);
        range.index++;
    }
    quill.getModule('toolbar').addHandler('image', function () {
        const browserWindow = window.open(options.url,'Images Browser','height=700,width=1200');
        browserWindow.addEventListener('mediaSelected', function (e) {
            e.detail.forEach(media => insertToEditor(media.url));
            quill.setSelection(range.index, Quill.sources.SILENT);
        });
    });
});
