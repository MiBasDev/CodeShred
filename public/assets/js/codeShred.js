// Obtenemos el botón de enseñar y ocultar el aside
const asideHider = document.getElementById('aside-hider');

// Le agregamos el evento para ocultar o enseñar todos los elementos que queremos
// a la vez
asideHider.addEventListener('click', () => {
    const header = document.querySelector('header');
    const aside = document.querySelector('aside');
    const main = document.querySelector('main');
    const footer = document.querySelector('footer');
    const navLinkPs = document.querySelectorAll('aside .nav-link p');

    header.classList.toggle('folded');
    aside.classList.toggle('folded-aside');
    main.classList.toggle('folded-others');
    footer.classList.toggle('folded-others');
    asideHider.classList.toggle('aside-hider-folded');

    navLinkPs.forEach(p => {
        p.classList.toggle('folded-nav-link');
    });

    if (aside.classList.contains('folded-aside')) {
        setCookie("foldedCookie", "1", 30);
    } else {
        deleteCookie("foldedCookie");
    }
});

// Función para crear una cookie, de forma que la posición del aside sea persistente
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

// Función para eliminar la cookie del aside
function deleteCookie(cname) {
    document.cookie = cname + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

// Función para enseñar y ocultar el menú hamburguesa
document.addEventListener('DOMContentLoaded', function () {
    var aside = document.getElementById('aside');
    var toggleAside = document.getElementById('toggle-menu');
    var overlay = document.getElementById('overlay');

    toggleAside.addEventListener('click', function () {
        aside.classList.toggle('open');
        toggleAside.classList.toggle('open');
        overlay.classList.toggle('active');
    });

    document.addEventListener('click', function (event) {
        if (!aside.contains(event.target) && event.target !== toggleAside) {
            aside.classList.remove('open');
            toggleAside.classList.remove('open');
            overlay.classList.remove('active');
        }
    });
});


// Obtenemos todas las tablas y sus respectivas filas
var tables = document.querySelectorAll('.my-account-table');
var paginationButtons = document.querySelectorAll('.pagination-buttons');
var rowsPerPage = 8;

// Función para mostrar las filas de una página específica de la tabla
function showRows(tableIndex, pageIndex) {
    var table = tables[tableIndex];
    var tableRows = table.querySelectorAll('tbody tr');
    var startIndex = pageIndex * rowsPerPage;
    var endIndex = startIndex + rowsPerPage;

    tableRows.forEach(function (row, index) {
        if (index >= startIndex && index < endIndex) {
            row.style.display = 'table-row';
        } else {
            row.style.display = 'none';
        }
    });
}

// Función para enseñar la página anterior de la tabla
function previousPage(tableIndex) {
    var currentPage = parseInt(paginationButtons[tableIndex].getAttribute('data-page'));
    if (currentPage > 0) {
        currentPage--;
        paginationButtons[tableIndex].setAttribute('data-page', currentPage);
        showRows(tableIndex, currentPage);
    }
    updatePaginationButtons(tableIndex, currentPage);
}

// Función para enseñar la página siguiente de la tabla
function nextPage(tableIndex) {
    var currentPage = parseInt(paginationButtons[tableIndex].getAttribute('data-page'));
    var tableRows = tables[tableIndex].querySelectorAll('tbody tr');
    var totalPages = Math.ceil(tableRows.length / rowsPerPage);
    if (currentPage < totalPages - 1) {
        currentPage++;
        paginationButtons[tableIndex].setAttribute('data-page', currentPage);
        showRows(tableIndex, currentPage);
    }
    updatePaginationButtons(tableIndex, currentPage);
}

// Función para actualizar la visibilidad de los botones de paginación
function updatePaginationButtons(tableIndex, currentPage) {
    var tableRows = tables[tableIndex].querySelectorAll('tbody tr');
    var totalPages = Math.ceil(tableRows.length / rowsPerPage);
    var prevButton = paginationButtons[tableIndex].querySelector('.prev');
    var nextButton = paginationButtons[tableIndex].querySelector('.next');
    // Enseñamos o escondemos los botones en función de la página
    if (currentPage === 0) {
        prevButton.style.display = 'none';
        nextButton.style.display = 'inline-block';
    } else if (currentPage === totalPages - 1) {
        prevButton.style.display = 'inline-block';
        nextButton.style.display = 'none';
    } else {
        prevButton.style.display = 'inline-block';
        nextButton.style.display = 'inline-block';
    }
}

// Función para mostrar las filas de la primera página para todas las tablas 
// de primeras
tables.forEach(function (table, index) {
    showRows(index, 0);
    if (paginationButtons[index]) {
        paginationButtons[index].setAttribute('data-page', 0);
        updatePaginationButtons(index, 0);
    }
});

// Función para el contador de caracteres del textarea de contacto (sof)
document.addEventListener('DOMContentLoaded', function () {
    var textarea = document.getElementById('message');
    var charCount = document.getElementById('charCount');

    if (textarea) {
        textarea.addEventListener('input', function () {
            var currentLength = textarea.value.length;
            charCount.textContent = `${currentLength}/255`;
        });
    }
});

// Función para obtener el valor de una cookie por su nombre (sof)
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) {
        return parts.pop().split(';').shift();
    } else {
        return null;
    }
}

// Obtenemos el userId desde la cookie
const userId = getCookie('userId');

// Hablamos con el worker para que trabaje (si hay sesión)
if (typeof (Worker) !== "undefined" && userId !== null) {
    const worker = new Worker('assets/js/notificationWorker.js');
    // Enviamos el trabajo al worker
    worker.postMessage({userId: userId});

    // Tratamos el mensaje recibido
    worker.onmessage = function (event) {
        const notification = event.data;
        // Obtenemos el div de notificaciones
        const notificationElement = document.getElementById('user-notificactions');
        // Obtenemos el elemento de mensaje de la notificación
        const notificationMessage = document.getElementById('notification-message');

        // Rellenamos el párrafo con el mensaje
        notificationMessage.innerText = notification[0].notification_message;
        // Enseñamos la notificación
        notificationElement.classList.add('show');

        // Quitamos la clase de estilos
        if (notification[0].notification_type === 'warning') {
            notificationElement.classList.add('warning');
        } else if (notification[0].notification_type === 'create') {
            notificationElement.classList.add('create');
        } else if (notification[0].notification_type === 'delete') {
            notificationElement.classList.add('delete');
        } else {
            notificationElement.classList.add('unset');
        }

        // A los 3 segundos, la enscondemos
        setTimeout(() => {
            notificationElement.classList.remove('show');

            // Quitamos la clase de estilos
            if (notification[0].notification_type === 'warning') {
                notificationElement.classList.remove('warning');
            } else if (notification[0].notification_type === 'create') {
                notificationElement.classList.remove('create');
            } else if (notification[0].notification_type === 'delete') {
                notificationElement.classList.remove('delete');
            } else {
                notificationElement.classList.remove('unset');
            }
        }, 3000);
    };
} else {
    console.error('Web Workers no soportados o el id no existe');
}

// Función para enseñar los tabs de la vista de post en responsive
function showCodeEditor(tabName) {
    const html = document.getElementById('html');
    const css = document.getElementById('css');
    const js = document.getElementById('js');
    if (tabName === 'css') {
        if (html.classList.contains('active')) {
            html.classList.remove('active');
        }
        if (js.classList.contains('active')) {
            js.classList.remove('active');
        }
    } else if (tabName === 'html') {
        if (css.classList.contains('active')) {
            css.classList.remove('active');
        }
        if (js.classList.contains('active')) {
            js.classList.remove('active');
        }
    } else {
        if (html.classList.contains('active')) {
            html.classList.remove('active');
        }
        if (css.classList.contains('active')) {
            css.classList.remove('active');
        }
    }
    document.getElementById(tabName).classList.add('active');
}