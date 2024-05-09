// Función para abrir los tabs de mi cuenta (w3schools)
function openTabOption(evt, sectionName) {
    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(sectionName).style.display = "block";
    evt.currentTarget.className += " active";
}
// Abrimos un tab siempre por defecto
document.getElementById("defaultOpen").click();

// Función que enseña un popup para el borrado de posts
function openDeletePopup(id) {
    var popup = document.getElementById('popup-delete');
    var buttonDelete = document.getElementById('button-my-account-post-delete-popup');

    popup.style.display = 'flex';
    buttonDelete.setAttribute('data', id);
}

// Función que oculta el popup de borrado de posts
function closeDeletePopup() {
    var popup = document.getElementById('popup-delete');

    popup.style.display = 'none';
}

// Función que enseña un popup para el borrado de la cuenta del usuario
function openDeleteAccountPopup() {
    var popup = document.getElementById('popup-delete-account');

    popup.style.display = 'flex';
}

// Función que oculta el popup de borrado de usuario
function closeDeleteAccountPopup() {
    var popup = document.getElementById('popup-delete-account');

    popup.style.display = 'none';
}

// Función que enseña un popup para el borrado de la cuenta de un usuario por un ADMIN
function openDeleteUserPopup(id, name) {
    var popup = document.getElementById('popup-delete-user');
    var buttonDelete = document.getElementById('button-my-account-user-delete-popup');
    var title = document.getElementById('popup-delete-user-title');

    popup.style.display = 'flex';
    buttonDelete.setAttribute('data', id);
    title.innerHTML = '¿Seguro que quieres borrar al usuario "' + name + '"?';
}

// Función que oculta el popup de borrado de un ususario por un ADMIN
function closeDeleteUserPopup() {
    var popup = document.getElementById('popup-delete-user');

    popup.style.display = 'none';
}
