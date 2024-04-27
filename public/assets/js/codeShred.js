const asideHider = document.getElementById('aside-hider');

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

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function deleteCookie(cname) {
    document.cookie = cname + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

//const htmlCodeTx = document.getElementById('html-code');
//const cssCodeTx = document.getElementById('css-code');
//const jsCodeTx = document.getElementById('js-code');
//const finalCode = document.getElementById('final-code');
//
//htmlCodeTx.addEventListener('input', mostrarResultado);
//cssCodeTx.addEventListener('input', mostrarResultado);
//jsCodeTx.addEventListener('input', mostrarResultado);
//
//function mostrarResultado() {
//    const iframe = document.createElement('iframe');
//    iframe.style.width = '100%';
//    iframe.style.height = '100%';
//
//    iframe.sandbox = 'allow-scripts';
//
//    const htmlCode = htmlCodeTx.value;
//    const cssCode = '<style>' + cssCodeTx.value + '</style>';
//    const jsCode = '<script>' + jsCodeTx.value + '</script>';
//    const allCode = htmlCode + cssCode + jsCode;
//
//    const saveCode = DOMPurify.sanitize(allCode);
//
//    const doc = iframe.contentDocument;
//    if (doc) {
//        doc.open();
//        doc.write(saveCode);
//        doc.close();
//
//        finalCode.innerHTML = '';
//        finalCode.appendChild(iframe);
//    } else {
//        console.error('El iframe no se ha creado correctamente.');
//    }
//}

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();