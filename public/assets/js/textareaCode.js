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

    // Estilos del editor de codigo
    // Función para aplicar o quitar estilos a los números
    function applyOrRemoveStyle(lineNumberElement, applyStyle) {
        if (applyStyle) {
            lineNumberElement.style.left = '-27px';
        } else {
            lineNumberElement.style.left = '';
        }
    }

    // Función para aplicar o quitar estilos a los números hijos del editor
    function applyOrRemoveStyles() {
        // Buscamos todos los elementos 
        var codeMirrorCodeElements = document.querySelectorAll('.CodeMirror-code');

        // Iteramos sobre cada elemento
        codeMirrorCodeElements.forEach(function (codeMirrorCodeElement) {
            var lineNumberElement = codeMirrorCodeElement.parentElement.querySelector('.CodeMirror-linenumber.CodeMirror-gutter-elt');

            if (codeMirrorCodeElement.children.length === 1) {
                applyOrRemoveStyle(lineNumberElement, true);
            } else {
                applyOrRemoveStyle(lineNumberElement, false);
            }
        });
    }

    applyOrRemoveStyles();

    // Bendito sea StackOverflow
    var observer = new MutationObserver(function (mutationsList, observer) {
        observer.disconnect();
    });

    // Observamos los cambios en el nodo body y sus descendientes
    observer.observe(document.body, {
        childList: true,
        subtree: true
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

    // Función para eliminar transiciones de un elemento y sus descendientes de forma recursiva
    function removeTransitionsRecursively(element) {
        // Elimina la propiedad de transición de este elemento
        element.style.transition = 'none';

        // Selecciona y elimina las transiciones de los hijos de este elemento
        var children = element.children;
        for (var i = 0; i < children.length; i++) {
            removeTransitionsRecursively(children[i]);
        }
    }

    // Función para eliminar transiciones de los elementos CodeMirror y sus descendientes
    function removeTransitionsFromCodeMirror() {
        // Selecciona todos los elementos CodeMirror
        var codeMirrorElements = document.querySelectorAll('.CodeMirror');

        // Itera sobre cada elemento CodeMirror
        codeMirrorElements.forEach(function (codeMirrorElement) {
            // Elimina las transiciones de este elemento y sus descendientes
            removeTransitionsRecursively(codeMirrorElement);
        });
    }

    // Elimina las transiciones al cargar la página
    removeTransitionsFromCodeMirror();

    // Observador de mutaciones para detectar cambios en el DOM
    var observerTransitions = new MutationObserver(function (mutationsList, observerTransitions) {
        // Elimina las transiciones después de cualquier cambio en el DOM
        removeTransitionsFromCodeMirror();
    });

    // Observa cambios en el nodo body y sus descendientes
    observerTransitions.observe(document.body, {
        childList: true,
        subtree: true
    });
});