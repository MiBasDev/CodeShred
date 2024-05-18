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

    // Asincronismo para el botón de actualizar datos del ususario
    document.querySelectorAll('#update-user-data').forEach(function (button) {
        button.addEventListener('click', function () {
            // Recogemos el valor de los inputs
            var userId = this.getAttribute('data-id');
            var user = document.getElementById('user').value;
            var email = document.getElementById('email').value;
            var userPass1 = document.getElementById('password1').value;
            var userPass2 = document.getElementById('password1').value;
            var select = document.getElementById('roles');
            if (select) {
                var rol = select.value;
            }

            // Guardamos los posibles elementos de error
            var userError = document.getElementById('errorUser');
            var emailError = document.getElementById('errorEmail');
            var pass1Error = document.getElementById('errorPass1');
            var pass2Error = document.getElementById('errorPass2');
            var globalError = document.getElementById('errorGlobal');

            userError.style.display = 'none';
            emailError.style.display = 'none';
            pass1Error.style.display = 'none';
            pass2Error.style.display = 'none';
            globalError.style.display = 'none';

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
                    email: email,
                    rol: rol,
                    //password1: userPass1,
                    //password2: userPass2,
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
                            button.classList.remove('button-primary');
                            button.classList.add('button-success');
                            setTimeout(function () {
                                button.classList.remove('button-success');
                                button.classList.add('button-primary');
                            }, 2000);
                        } else {
                            // Cambiamos el texto del botón durante 2 segundos
                            button.textContent = (data.errors ? 'Error al guardar los datos' : 'Son los mismos datos');
                            setTimeout(function () {
                                button.textContent = originalButtonText;
                            }, 2000);

                            // Pintamos el botón durante 2 segundos
                            button.classList.remove('button-primary');
                            button.classList.add('button-warning');
                            setTimeout(function () {
                                button.classList.remove('button-warning');
                                button.classList.add('button-primary');
                            }, 2000);

                            if (data.errors) {
                                if (data.errors.user) {
                                    userError.innerHTML = data.errors.user;
                                    userError.style.display = 'block';
                                }
                                if (data.errors.email) {
                                    emailError.innerHTML = data.errors.email;
                                    emailError.style.display = 'block';
                                }
                                if (data.errors.password1) {
                                    pass1Error.innerHTML = data.errors.password1;
                                    pass1Error.style.display = 'block';
                                }
                                if (data.errors.password2) {
                                    pass2Error.innerHTML = data.errors.password2;
                                    pass2Error.style.display = 'block';
                                }
                                if (data.errors.globalError) {
                                    globalError.innerHTML = data.errors.globalError;
                                    globalError.style.display = 'block';
                                }
                            }
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
            var userName = this.getAttribute('data-user');

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
                                button.querySelector('span').classList.add('fa-user-check');
                            } else {
                                button.classList.remove('button-success');
                                button.classList.add('button-secondary');
                                button.querySelector('span').classList.remove('fa-user-check');
                                button.querySelector('span').classList.add('fa-user-plus');
                            }
                        }
                    })
                    .catch(function (error) {
                        console.error('Error:', error);
                    });
        });
    });

    // Asincronismo para los botones de borrado de usuarios en el admin
    document.querySelectorAll('#button-my-account-user-delete-popup').forEach(function (button) {
        button.addEventListener('click', function () {
            // Recogemos los datos que necesitamos del botón
            var userId = this.getAttribute('data-id');

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
                                        trElement.remove();
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