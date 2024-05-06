document.addEventListener('DOMContentLoaded', function () {
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
                        } else {
                            // Cambiamos el texto del botón durante 2 segundos
                            button.textContent = 'Fallo al guardar la descripción';
                            setTimeout(function () {
                                button.textContent = originalButtonText;
                            }, 2000);

                            // Pintamos el botón durante 2 segundos
                            button.classList.remove('button-secondary');
                            button.classList.add('button-warning');
                            setTimeout(function () {
                                button.classList.remove('button-warning');
                                button.classList.add('button-secondary');
                            }, 2000);
                        }
                    })
                    .catch(function (error) {
                        console.error('Error:', error);
                    });
        });
    });

    // Asincronismo para el botón de actualizar descripción
    document.querySelectorAll('#update-user-data').forEach(function (button) {
        button.addEventListener('click', function () {
            // Recogemos el valor de los inputs
            var userId = this.getAttribute('data');
            var user = document.getElementById('user').value;
            var userEmail = document.getElementById('email').value;
            var userPass1 = document.getElementById('password1').value;
            var userPass2 = document.getElementById('password1').value;

            // Guardamos el texto original del botón
            var originalButtonText = button.textContent;

            // Empezamos la petición
            fetch('/update-user-data', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    userId: userId,
                    user: user,
                    userEmail: userEmail,
                    userPass1: userPass1,
                    userPass2: userPass2,
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
                            button.textContent = 'Datos actualizados';
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
                        } else {
                            // Cambiamos el texto del botón durante 2 segundos
                            button.textContent = 'Fallo al guardar los datos';
                            setTimeout(function () {
                                button.textContent = originalButtonText;
                            }, 2000);

                            // Pintamos el botón durante 2 segundos
                            button.classList.remove('button-secondary');
                            button.classList.add('button-warning');
                            setTimeout(function () {
                                button.classList.remove('button-warning');
                                button.classList.add('button-secondary');
                            }, 2000);
                        }
                    })
                    .catch(function (error) {
                        console.error('Error:', error);
                    });
        });
    });

    // Asincronismo para los botones de follow
    document.querySelectorAll('.user-follow').forEach(function (button) {
        button.addEventListener('click', function () {
            // Recogemos los datos que necesitamos del botón
            var userId = this.id.split('-')[1];
            var userName = this.getAttribute('data');

            // Empezamos la petición
            fetch('/user-follow', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    userIdToFollow: userId,
                    userName: userName
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
                            if (data.action === 'follow') {
                                button.classList.remove('button-secondary');
                                button.classList.add('button-success');
                                button.querySelector('span').classList.remove('fa-user-plus');
                                button.querySelector('span').classList.add('fa-check');
                            } else {
                                button.classList.remove('button-success');
                                button.classList.add('button-secondary');
                                button.querySelector('span').classList.remove('fa-check');
                                button.querySelector('span').classList.add('fa-user-plus');
                            }
                        }
                    })
                    .catch(function (error) {
                        console.error('Error:', error);
                    });
        });
    });

    // Asincronismo para los botones de follow
    document.querySelectorAll('#button-my-account-user-delete-popup').forEach(function (button) {
        button.addEventListener('click', function () {
            // Recogemos los datos que necesitamos del botón
            var userId = this.getAttribute('data');

            // Empezamos la petición
            fetch('/user-delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    userId: userId
                }),
            })
                    .then(function (response) {
                        console.log('hola');
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
                                var trElement = document.getElementById('my-account-table-user-' + userId);
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
                        var popup = document.getElementById('popup-delete-user');
                        popup.style.display = 'none';
                    })
                    .catch(function (error) {
                        console.error('Error:', error);
                    });
        });
    });
}); 