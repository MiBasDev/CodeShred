// Obtenemos el botón de enseñar y ocultar el aside
const asideHider = document.getElementById('aside-hider');

// Le agregamos el evento para ocultar o enseñar todos los elementos que queremos
// a la vez
asideHider.addEventListener('click', () => {
    const aside = document.querySelector('aside');
    const main = document.querySelector('main');
    const footer = document.querySelector('footer');
    const navLinkPs = document.querySelectorAll('aside .nav-link p');

    aside.classList.toggle('folded-aside');
    main.classList.toggle('folded-others');
    footer.classList.toggle('folded-others');
    asideHider.classList.toggle('aside-hider-folded');

    navLinkPs.forEach(p => {
        p.classList.toggle('folded-nav-link');
    });

    if (aside.classList.contains('folded-aside')) {
        setCookie("foldedCookie", "1", 30);
        console.log();
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

// Función para el menú hamburguesa
document.addEventListener('DOMContentLoaded', function () {
    var aside = document.querySelector('aside');
    var toggleAside = document.getElementById('toggle-menu');

    toggleAside.addEventListener('click', function () {
        aside.classList.toggle('open');
        toggleAside.classList.toggle('open');
    });

    document.addEventListener('click', function (event) {
        if (!aside.contains(event.target) && event.target !== toggleAside) {
            aside.classList.remove('open');
            toggleAside.classList.remove('open');
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
// de priemras
tables.forEach(function (table, index) {
    showRows(index, 0);
    paginationButtons[index].setAttribute('data-page', 0);
    updatePaginationButtons(index, 0);
});