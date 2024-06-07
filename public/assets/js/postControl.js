// Obtenemos los títulos de los shreds
const postTitle = document.getElementById('post-title');
const postTitleTwo = document.getElementById('post-title-two');

// Actualizamos los títulos a la vez
postTitle.addEventListener('input', function () {
    postTitleTwo.value = postTitle.value;
});

// Actualizamos los títulos a la vez
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
        // const img = document.createElement('img');
        // img.src = imageDataUrl;
        // img.alt = 'Preview Shred';
        // img.style.width = '100%';
        // img.style.aspectRatio = '16/9';
        // Establecemos la captura de pantalla como fondo del contenedor
        screenshotContainer.style.background = `url(${imageDataUrl}) no-repeat 50% 50% / cover`;

        // Limpiamos el contenido del contenedor
        screenshotContainer.innerHTML = '';
        // screenshotContainer.appendChild(img);

        // Guardamos la imagen en el input hidden
        document.getElementById('post-img-data').value = imageDataUrl;
    });
}

// Función para abrir el popup de guardado
function openPopup() {
    // Obtenemos el popup y lo ponemos a flex
    const popup = document.getElementById('popup');
    popup.style.display = 'flex';

    // Obtenemos los valores de los inputs del post
    const postTitle = document.getElementById('post-title').value;
    const htmlCode = document.getElementById('html-code').value;
    const cssCode = document.getElementById('css-code').value;
    const jsCode = document.getElementById('js-code').value;

    // Función para formatear el texto indentado
    function formatCode(code) {
        // Si el código está vacío, no es necesario formatearlo
        if (!code.trim()) {
            return code;
        }

        // Separamos el código en líneas
        const lines = code.split('\n');

        // Encontramos la longitud del espacio de sangría en la primera línea
        let indentation = 0;
        const firstLine = lines[0];
        while (firstLine[indentation] === ' ') {
            indentation++;
        }

        // Eliminamos la sangría de la primera línea
        lines[0] = firstLine.trim();

        // Aplicamos la misma sangría al resto de las líneas
        for (let i = 1; i < lines.length; i++) {
            lines[i] = lines[i].substring(indentation);
        }

        // Unimos las líneas formateadas nuevamente
        return lines.join('\n');
    }

    // Asignamos los valores formateados a los campos del popup
    // para guardarlos así en la base de datos
    document.getElementById('shred-title').value = postTitle;
    document.getElementById('shred-html').value = formatCode(htmlCode);
    document.getElementById('shred-css').value = formatCode(cssCode);
    document.getElementById('shred-js').value = formatCode(jsCode);

    // Seleccionamos el botón de guardar dentro del popup y le damos el foco (accesibilidad)
    const saveButton = popup.querySelector('.button-primary');
    if (saveButton) {
        saveButton.focus();
    }
}

// Función para cerrar el popup de guardado
function closePopup() {
    // Obtenemos el popup y lo ponemos a none
    const popup = document.getElementById('popup');

    popup.style.display = 'none';
}

// Función para abrir el popup de borrado
function openDeletePopup() {
    // Obtenemos el popup y lo ponemos a flex
    const popup = document.getElementById('popup-delete');

    // Seleccionamos el botón de cerrar dentro del popup y le damos el foco (accesibilidad)
    const closeButton = popup.querySelector('.button-secondary');
    if (closeButton) {
        closeButton.focus();
    }

    popup.style.display = 'flex';
}

// Función para cerrar el popup de borrado
function closeDeletePopup() {
    // Obtenemos el popup y lo ponemos a none
    const popup = document.getElementById('popup-delete');

    popup.style.display = 'none';
}