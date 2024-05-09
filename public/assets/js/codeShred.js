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
        p.style.display = aside.classList.contains('folded-aside') ? 'none' : 'block';
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
