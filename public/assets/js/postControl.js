function sendToIframe() {
    var iframe = document.getElementById("my-iframe");
    var htmlCode = document.getElementById("html-code").value;
    var cssCode = document.getElementById("css-code").value;
    var jsCode = document.getElementById("js-code").value;
    var message = {
        html: htmlCode,
        css: cssCode,
        js: jsCode
    };
    iframe.contentWindow.postMessage(message, "*");
}

document.getElementById("html-code").addEventListener("input", sendToIframe);
document.getElementById("css-code").addEventListener("input", sendToIframe);
document.getElementById("js-code").addEventListener("input", sendToIframe);

function openPopup() {
    var popup = document.getElementById('popup');
    popup.style.display = 'flex';

    var postTitle = document.getElementById('post-title').value;
    var htmlCode = document.getElementById('html-code').value;
    var cssCode = document.getElementById('css-code').value;
    var jsCode = document.getElementById('js-code').value;

    // Función para formatear el texto indentado
    function formatCode(code) {
        // Si el código está vacío, no es necesario formatearlo
        if (!code.trim()) {
            return code;
        }

        // Separa el código en líneas
        var lines = code.split('\n');

        // Encuentra la longitud del espacio de sangría en la primera línea
        var indentation = 0;
        var firstLine = lines[0];
        while (firstLine[indentation] === ' ') {
            indentation++;
        }

        // Elimina la sangría de la primera línea
        lines[0] = firstLine.trim();

        // Aplica la misma sangría al resto de las líneas
        for (var i = 1; i < lines.length; i++) {
            lines[i] = lines[i].substring(indentation);
        }

        // Une las líneas formateadas nuevamente
        return lines.join('\n');
    }

    // Asigna los valores formateados a los campos del popup
    document.getElementById('shred-title').value = postTitle;
    document.getElementById('shred-html').value = formatCode(htmlCode);
    document.getElementById('shred-css').value = formatCode(cssCode);
    document.getElementById('shred-js').value = formatCode(jsCode);
}


function closePopup() {
    var popup = document.getElementById('popup');
    popup.style.display = 'none';
}

function openDeletePopup() {
    var popup = document.getElementById('popup-delete');
    popup.style.display = 'flex';
}

function closeDeletePopup() {
    var popup = document.getElementById('popup-delete');
    popup.style.display = 'none';
}
