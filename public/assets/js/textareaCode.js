$(document).ready(function () {
    // Configuración de CodeMirror para HTML
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
    // Añadimos un aria-label al textarea de HTML generado por CodeMirror para accesibilidad (sof)
    $(editorHtml.getWrapperElement()).find('textarea').attr('aria-label', 'Editor de código HTML');

    // Configuración de CodeMirror para CSS
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
    // Añadimos un aria-label al textarea de CSS generado por CodeMirror para accesibilidad (sof)
    $(editorCss.getWrapperElement()).find('textarea').attr('aria-label', 'Editor de código CSS');

    // Configuración de CodeMirror para JavaScript
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
    // Añadimos un aria-label al textarea de JS generado por CodeMirror para accesibilidad (sof)
    $(editorJs.getWrapperElement()).find('textarea').attr('aria-label', 'Editor de código JavaScript');

    // Evento para actualizar el textarea de HTML
    editorHtml.on('change', function () {
        $("#html-code").val(editorHtml.getValue());
    });

    // Evento para actualizar el textarea de CSS
    editorCss.on('change', function () {
        $("#css-code").val(editorCss.getValue());
    });

    // Evento para actualizar el textarea de JS
    editorJs.on('change', function () {
        $("#js-code").val(editorJs.getValue());
    });

    // Función para dar estilos a las scrollbar de los editores
    function applyScrollBarStyles() {
        // Buscamos los elementos de la scrollbar de CodeMirror
        const vScrollBars = document.querySelectorAll('.CodeMirror-vscrollbar');
        const fillerElements = document.querySelectorAll('.CodeMirror-scrollbar-filler');
        const hScrollBars = document.querySelectorAll('.CodeMirror-hscrollbar');

        // Les añadimos los estilos que queremos a los scrolls para que queden bien
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
    // Llamamos la función nada más empezar para darle el formato que queremos
    applyScrollBarStyles();

    // Bendito sea StackOverflow
    // Creamos un observer para capturar los cambios del body
    const observerScroll = new MutationObserver(function (mutationsList, observerScroll) {
        applyScrollBarStyles();
    });

    // Observamos los cambios en el body y sus descendientes
    observerScroll.observe(document.body, {
        childList: true,
        subtree: true
    });

    // Función para actualizar el contenido del iframe
    function updatePreview() {
        // Recogemos los valores de los editores
        const htmlContent = editorHtml.getValue();
        const cssContent = `<style>${editorCss.getValue()}</style>`;
        const unsanitizedJsContent = editorJs.getValue();
        // Sanitizamos el código JS
        //const sanitizedJsContent = DOMPurify.sanitize(unsanitizedJsContent, {SAFE_FOR_JQUERY: true});
        const jsContent = `<script>${unsanitizedJsContent}</script>`;

        // Creamos el contenido final que le pasaremos al iframe
        const finalContent = `  <html>
                                  <head>${cssContent}</head>
                                  <body>${htmlContent}${jsContent}</body>
                                </html>`;

        // Obtenemos el iframe
        const previewFrame = document.getElementById('my-iframe');
        // Obtenemos el documento interno del iframe
        const innerIframe = previewFrame.contentDocument || previewFrame.contentWindow.document;
        innerIframe.open();
        innerIframe.write(finalContent);
        innerIframe.close();
    }

    // Actualizamos la vista previa al cargar la página
    updatePreview();

    // Detectamos los cambios en los editores y actualizamos la vista previa
    editorHtml.on('change', updatePreview);
    editorCss.on('change', updatePreview);
    editorJs.on('change', updatePreview);

    // Evento para copiar el contenido del editor HTML
    if (document.getElementById("copy-html-button")) {
        document.getElementById("copy-html-button").addEventListener("click", function () {
            const htmlCode = editorHtml.getValue();
            copyCode(htmlCode, this);
        });
    }

    // Evento para copiar el contenido del editor CSS
    if (document.getElementById("copy-css-button")) {
        document.getElementById("copy-css-button").addEventListener("click", function () {
            const cssCode = editorCss.getValue();
            copyCode(cssCode, this);
        });
    }

    // Evento para copiar el contenido del editor JS
    if (document.getElementById("copy-js-button")) {
        document.getElementById("copy-js-button").addEventListener("click", function () {
            const jsCode = editorJs.getValue();
            copyCode(jsCode, this);
        });
    }

    // Función para copiar el texto al portapapeles
    function copyCode(text, button) {
        // Creamos un textarea momentáneo para hacer la copia
        const tempTextArea = document.createElement("textarea");
        tempTextArea.value = text;
        document.body.appendChild(tempTextArea);
        tempTextArea.select();
        document.execCommand("copy");
        document.body.removeChild(tempTextArea);

        // Obtenemos el span dentro del botón
        const iconSpan = button.querySelector("span");
        iconSpan.style.color = "green";
        // Cambiamos la clase del icono 
        iconSpan.classList.remove("fa-copy");
        iconSpan.classList.add("fa-check");

        // Volvemos al estado original tras 1 segundo
        setTimeout(function () {
            iconSpan.style.color = "";
            iconSpan.classList.remove("fa-check");
            iconSpan.classList.add("fa-copy");
        }, 1000);
    }
});
