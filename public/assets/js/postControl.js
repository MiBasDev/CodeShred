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

// Event listener para enviar los mensajes cuando hay cambios en los textareas
document.getElementById("html-code").addEventListener("input", sendToIframe);
document.getElementById("css-code").addEventListener("input", sendToIframe);
document.getElementById("js-code").addEventListener("input", sendToIframe);