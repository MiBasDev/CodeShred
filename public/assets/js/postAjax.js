document.addEventListener('DOMContentLoaded', function () {
    // Asincronismo para los botones de like
    document.querySelectorAll('.post-like').forEach(function (button) {
        button.addEventListener('click', function () {
            // Recogemos los datos que necesitamos del botón
            var postId = this.id.split('-')[2];

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
                            } else {
                                button.querySelector('span').classList.remove('fa');
                                button.querySelector('span').classList.add('far');
                                button.querySelector('span').classList.remove('post-liked');
                            }
                        }
                    })
                    .catch(function (error) {
                        console.error('Error:', error);
                    });
        });
    });

    // Asincronismo para el botón de actualizar descripción
    document.querySelectorAll('#update-description').forEach(function (button) {
        button.addEventListener('click', function () {
            // Recogemos el valor del textarea
            var userDescription = document.getElementById('user-description').value;
            // Guardamos el texto original del botón
            var originalButtonText = button.textContent;

            // Empezamos la petición
            fetch('/update-description', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    userDescription: userDescription,
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
                        if (data.action === 'updated') {
                            // Cambiamos el texto del botón durante 2 segundos
                            button.textContent = 'Descripción guardada';
                            setTimeout(function () {
                                button.textContent = originalButtonText;
                            }, 2000);

                            // Pintamos el botón durante 2 segundos
                            button.classList.remove('button-secondary');
                            button.classList.add('button-success');
                            setTimeout(function () {
                                button.classList.remove('button-success');
                                button.classList.add('button-secondary');
                            }, 2000);
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
            var postId = this.getAttribute('data');

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
                                        trElement.style.display = 'none';
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