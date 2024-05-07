// Función para capturar el iframe y mostrarlo en el popup
function saveAndOpenPopup() {
    // Capturamos el iframe
    captureScreenshot();
    // Abrimos el popup
    openPopup();
}

// Función para capturar una screenshot del contenido del iframe
function captureScreenshot() {
    const iframe = document.getElementById('my-iframe');
    const screenshotContainer = document.getElementById('popup-image-container');

    html2canvas(iframe.contentDocument.body).then(canvas => {
        // Convertir la captura de pantalla a una imagen
        const imageDataUrl = canvas.toDataURL('image/png');
        
        // Crear un elemento img y establecer su src con la URL de datos
        const img = document.createElement('img');
        img.src = imageDataUrl;
        img.style.width = '100%';
        img.style.aspectRatio = '16/9';
        
        // Limpiar el contenedor y agregar la imagen
        screenshotContainer.innerHTML = '';
        screenshotContainer.appendChild(img);
    });
}

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
