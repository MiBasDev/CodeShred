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

    document.getElementById('shred-title').value = postTitle;
    document.getElementById('shred-html').value = htmlCode;
    document.getElementById('shred-css').value = cssCode;
    document.getElementById('shred-js').value = jsCode;
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