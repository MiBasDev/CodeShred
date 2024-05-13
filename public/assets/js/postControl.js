// Obtenemos los títulos de los shreds
var postTitle = document.getElementById('post-title');
var postTitleTwo = document.getElementById('post-title-two');

// Actualizamos el otro título a la vez
postTitle.addEventListener('input', function () {
    postTitleTwo.value = postTitle.value;
});

// Actualizamos el otro título a la vez
postTitleTwo.addEventListener('input', function () {
    postTitle.value = postTitleTwo.value;
});

// Función para hacer una captura del iframe y mostrarlo en el popup
function saveAndOpenPopup() {
    // Hacemos una captura del iframe
    captureScreenshot();
    // Abrimos el popup
    openPopup();
}

// Función para hacer una captura del contenido del iframe
function captureScreenshot() {
    // Obtenemos el iframe
    const iframe = document.getElementById('my-iframe');
    const screenshotContainer = document.getElementById('popup-image-container');

    // Usamos la librería para capturar el contenido
    html2canvas(iframe.contentDocument.body).then(canvas => {
        // Convertimos la captura de pantalla a una imagen
        const imageDataUrl = canvas.toDataURL('image/png');

        // Creamos un elemento img y establecemos su src con la URL de datos
        const img = document.createElement('img');
        img.src = imageDataUrl;
        img.style.width = '100%';
        img.style.aspectRatio = '16/9';

        // Limpiamos el contenedor y añadimos la imagen
        screenshotContainer.innerHTML = '';
        screenshotContainer.appendChild(img);
    });
}

// Función para abrir el popup de guardado
function openPopup() {
    // Obtenemos el popup y lo ponemos a flex
    var popup = document.getElementById('popup');
    popup.style.display = 'flex';

    if(postTitle !== undefined) {
        postTitle = postTitle.value;
    } else {
        postTitle = postTitleTwo.value;
    }
    var htmlCode = document.getElementById('html-code').value;
    var cssCode = document.getElementById('css-code').value;
    var jsCode = document.getElementById('js-code').value;

    // Función para formatear el texto indentado
    function formatCode(code) {
        // Si el código está vacío, no es necesario formatearlo
        if (!code.trim()) {
            return code;
        }

        // Separamos el código en líneas
        var lines = code.split('\n');

        // Encontramos la longitud del espacio de sangría en la primera línea
        var indentation = 0;
        var firstLine = lines[0];
        while (firstLine[indentation] === ' ') {
            indentation++;
        }

        // Eliminamos la sangría de la primera línea
        lines[0] = firstLine.trim();

        // Aplicamos la misma sangría al resto de las líneas
        for (var i = 1; i < lines.length; i++) {
            lines[i] = lines[i].substring(indentation);
        }

        // Unimos las líneas formateadas nuevamente
        return lines.join('\n');
    }

    // Asigna los valores formateados a los campos del popup
    document.getElementById('shred-title').value = postTitle;
    document.getElementById('shred-html').value = formatCode(htmlCode);
    document.getElementById('shred-css').value = formatCode(cssCode);
    document.getElementById('shred-js').value = formatCode(jsCode);
}

// Función para cerrar el popup de guardado
function closePopup() {
    // Obtenemos el popup y lo ponemos a none
    var popup = document.getElementById('popup');
    popup.style.display = 'none';
}

// Función para abrir el popup de borrado
function openDeletePopup() {
    // Obtenemos el popup y lo ponemos a flex
    var popup = document.getElementById('popup-delete');
    popup.style.display = 'flex';
}

// Función para cerrar el popup de borrado
function closeDeletePopup() {
    // Obtenemos el popup y lo ponemos a none
    var popup = document.getElementById('popup-delete');
    popup.style.display = 'none';
}
