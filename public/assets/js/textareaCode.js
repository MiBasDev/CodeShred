$(document).ready(function () {
    // Configuración para HTML
    const codeHtml = $("#html-code").get(0);
    const editorHtml = CodeMirror.fromTextArea(codeHtml, {
        lineNumbers: true,
        mode: 'xml',
        theme: 'dracula',
        autoIndent: true,
        matchBrackets: true,
        autoCloseTags: true,
        autoRefresh: true
    });

    // Configuración para CSS
    const codeCss = $("#css-code").get(0);
    const editorCss = CodeMirror.fromTextArea(codeCss, {
        lineNumbers: true,
        mode: 'css',
        theme: 'dracula',
        autoIndent: true,
        matchBrackets: true,
        autoCloseBrackets: true,
        autoRefresh: true
    });

    // Configuración para JavaScript
    const codeJs = $("#js-code").get(0);
    const editorJs = CodeMirror.fromTextArea(codeJs, {
        lineNumbers: true,
        mode: 'javascript',
        theme: 'dracula',
        autoIndent: true,
        matchBrackets: true,
        autoCloseBrackets: true,
        lint: true,
        autoRefresh: true
    });

    // Función para actualizar los textareas al escribir en los editores
    editorHtml.on('change', function () {
        $("#html-code").val(editorHtml.getValue());
    });

    editorCss.on('change', function () {
        $("#css-code").val(editorCss.getValue());
    });

    editorJs.on('change', function () {
        $("#js-code").val(editorJs.getValue());
    });

    // Función para dar estilos a las scrollbar de los editores
    function applyScrollBarStyles() {
        // Buscamos los elementos de la scrollbar
        var vScrollBars = document.querySelectorAll('.CodeMirror-vscrollbar');
        var fillerElements = document.querySelectorAll('.CodeMirror-scrollbar-filler');
        var hScrollBars = document.querySelectorAll('.CodeMirror-hscrollbar');

        vScrollBars.forEach(function (vScrollBar) {
            vScrollBar.style.height = '100%';
        });
        fillerElements.forEach(function (fillerElement) {
            fillerElement.style.height = '0px';
        });
        hScrollBars.forEach(function (hScrollBar) {
            hScrollBar.style.overflow = 'hidden';
        });
    }

    applyScrollBarStyles();

    // Bendito sea StackOverflow
    var observerScroll = new MutationObserver(function (mutationsList, observerScroll) {
        applyScrollBarStyles();
    });

    // Observamos los cambios en el nodo body y sus descendientes
    observerScroll.observe(document.body, {
        childList: true,
        subtree: true
    });
});