function openTabOption(evt, cityName) {
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
document.getElementById("defaultOpen").click();


function openDeletePopup(id) {
    var popup = document.getElementById('popup-delete');
    var buttonDelete = document.getElementById('button-my-account-post-delete-popup');

    popup.style.display = 'flex';
    buttonDelete.setAttribute('data', id);
}

function closeDeletePopup() {
    var popup = document.getElementById('popup-delete');
    popup.style.display = 'none';
}

function openDeleteUserPopup(id, name) {
    var popup = document.getElementById('popup-delete-user');
    var buttonDelete = document.getElementById('button-my-account-user-delete-popup');
    var title = document.getElementById('popup-delete-user-title');

    popup.style.display = 'flex';
    buttonDelete.setAttribute('data', id);
    title.innerHTML = '¿Seguro que quieres borrar al usuario "' + name + '"?';
}

function closeDeleteUserPopup() {
    var popup = document.getElementById('popup-delete-user');
    popup.style.display = 'none';
}