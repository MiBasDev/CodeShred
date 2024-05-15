document.addEventListener('DOMContentLoaded', function () {
    // Asincronismo para los botones de like
    document.querySelectorAll('.post-like').forEach(function (button) {
        button.addEventListener('click', function () {
            // Recogemos los datos que necesitamos del botón
            var postId = this.id.split('-')[2];
            // Recogemos el total de lieks del post
            var totalLikes = document.getElementById('post-total-likes-' + postId);

            // Empezamos la petición
            fetch('/post-like', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    postId: postId,
                }),
            })
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error('Respuesta fallida.');
                        }
                        return response.json();
                    })
                    .then(function (data) {
                        // Procesamos la respuesta en el front
                        if (data.success) {
                            if (data.action === 'like') {
                                button.querySelector('span').classList.remove('far');
                                button.querySelector('span').classList.add('fa');
                                button.querySelector('span').classList.add('post-liked');
                                if (totalLikes) {
                                    var currentLikes = parseInt(totalLikes.innerHTML);
                                    var newLikes = currentLikes + 1;
                                    totalLikes.innerHTML = newLikes;
                                }
                            } else {
                                button.querySelector('span').classList.remove('fa');
                                button.querySelector('span').classList.add('far');
                                button.querySelector('span').classList.remove('post-liked');
                                if (totalLikes) {
                                    var currentLikes = parseInt(totalLikes.innerHTML);
                                    var newLikes = currentLikes - 1;
                                    totalLikes.innerHTML = newLikes;
                                }
                            }
                        }
                    })
                    .catch(function (error) {
                        console.error('Error:', error);
                    });
        });
    });

    // Asincronismo para el botón de borrar post de mi cuenta
    document.querySelectorAll('#button-my-account-post-delete-popup').forEach(function (button) {
        button.addEventListener('click', function () {
            // Recogemos los datos que necesitamos del botón
            var postId = this.getAttribute('data-id');

            // Empezamos la petición
            fetch('/post-delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    postId: postId,
                }),
            })
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error('Respuesta fallida.');
                        }
                        return response.json();
                    })
                    .then(function (data) {
                        // Procesamos la respuesta en el front
                        if (data.success) {
                            if (data.action === 'deleted') {
                                // Cogemos el tr padre
                                var trElement = document.getElementById('my-account-table-post-' + postId);
                                // Lo quitamos de la tabla con una animación
                                if (trElement) {
                                    trElement.style.opacity = 0;
                                    setTimeout(function () {
                                        trElement.remove();
                                    }, 1000);
                                }
                            }

                        }
                        // Pase lo que pase, cerramos el popup
                        var popup = document.getElementById('popup-delete');
                        popup.style.display = 'none';
                    })
                    .catch(function (error) {
                        console.error('Error:', error);
                    });
        });
    });
});
