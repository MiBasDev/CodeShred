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
// Obtenemos el botón de abrir por defecto
const defaultButton = document.getElementById("defaultOpen");

// Verificamos si el botón existe
if (defaultButton) {
    defaultButton.click();
}

// Función que enseña un popup para el borrado de posts
function openDeletePopup(id) {
    // Obtenemos el popup y lo ponemos a flex
    var popup = document.getElementById('popup-delete');
    // Agregamos el id al botón en un atributo data
    var buttonDelete = document.getElementById('button-my-account-post-delete-popup');

    popup.style.display = 'flex';
    buttonDelete.setAttribute('data-id', id);
}

// Función que oculta el popup de borrado de posts
function closeDeletePopup() {
    // Obtenemos el popup y lo ponemos a none
    var popup = document.getElementById('popup-delete');

    popup.style.display = 'none';
}

// Función que enseña un popup para el borrado de la cuenta del usuario
function openDeleteAccountPopup() {
    // Obtenemos el popup y lo ponemos a flex
    var popup = document.getElementById('popup-delete-account');

    popup.style.display = 'flex';
}

// Función que oculta el popup de borrado de usuario
function closeDeleteAccountPopup() {
    // Obtenemos el popup y lo ponemos a none
    var popup = document.getElementById('popup-delete-account');

    popup.style.display = 'none';
}

// Función que enseña un popup para el borrado de la cuenta de un usuario por un ADMIN
function openDeleteUserPopup(id, name) {
    // Obtenemos el popup y lo ponemos a flex
    var popup = document.getElementById('popup-delete-user');
    // Agregamos el id al botón en un atributo data
    var buttonDelete = document.getElementById('button-my-account-user-delete-popup');
    // Rellenamos el título del popup dinámicamente
    var title = document.getElementById('popup-delete-user-title');

    popup.style.display = 'flex';
    buttonDelete.setAttribute('data-id', id);
    title.innerHTML = '¿Seguro que quieres borrar al usuario "' + name + '"?';
}

// Función que oculta el popup de borrado de un ususario por un ADMIN
function closeDeleteUserPopup() {
    // Obtenemos el popup y lo ponemos a none
    var popup = document.getElementById('popup-delete-user');

    popup.style.display = 'none';
}

// Función que enseña un popup para el borrado de la cuenta de un usuario por un ADMIN
function openUpdateUserPopup(id, name, email, rol) {
    // Obtenemos el popup y lo ponemos a flex
    var popup = document.getElementById('popup-update-user');
    // Agregamos el id al botón en un atributo data
    var buttonUpdate = document.getElementById('update-user-data');
    // Rellenamos el título del popup dinámicamente
    var title = document.getElementById('popup-admin-user-update-title');
    // Rellenamos los inputs dinámicamente
    var inputUser = document.getElementById('user');
    var inputEmail = document.getElementById('email');
    var selectRole = document.getElementById('roles');

    popup.style.display = 'flex';
    buttonUpdate.setAttribute('data-id', id);
    title.innerHTML = 'Datos de "' + name + '"';
    inputUser.value = name;
    inputEmail.value = email;
    selectRole.value = rol;
}

// Función que oculta el popup de borrado de un ususario por un ADMIN
function closeUpdateUserPopup() {
    // Recargamos la paǵina dinámicamente
    location.reload();
}
