
var clipboard = new ClipboardJS('.copy-btn');

clipboard.on('success', function(e) {
    console.info('Text:', e.text);

    e.clearSelection();
});
