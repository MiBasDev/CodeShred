document.addEventListener('DOMContentLoaded', function () {
    // Asincronismo para el botón de actualizar descripción
    const updateDescriptionButton = document.getElementById('update-description');
    if (updateDescriptionButton) {
        updateDescriptionButton.addEventListener('click', function () {
            // Recogemos el valor del textarea
            const userDescription = document.getElementById('user-description').value;
            // Guardamos el texto original del botón
            const originalButtonText = this.textContent;

            // Comprobamos que el texto sea válido
            const regex = /^[a-zA-Z0-9\s.,'!?()_-]*$/;
            if (regex.test(userDescription)) {
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
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error('Respuesta fallida.');
                            }
                            return response.json();
                        })
                        .then((data) => {
                            // Procesamos la respuesta en el front
                            if (data.action === 'updated') {
                                // Cambiamos el texto del botón durante 2 segundos
                                this.textContent = 'Descripción guardada';
                                setTimeout(() => {
                                    this.textContent = originalButtonText;
                                }, 2000);

                                // Pintamos el botón durante 2 segundos
                                this.classList.remove('button-secondary');
                                this.classList.add('button-success');
                                setTimeout(() => {
                                    this.classList.remove('button-success');
                                    this.classList.add('button-secondary');
                                }, 2000);
                            } else {
                                // Cambiamos el texto del botón durante 2 segundos
                                this.textContent = 'Fallo al guardar la descripción';
                                setTimeout(() => {
                                    this.textContent = originalButtonText;
                                }, 2000);

                                // Pintamos el botón durante 2 segundos
                                this.classList.remove('button-secondary');
                                this.classList.add('button-warning');
                                setTimeout(() => {
                                    this.classList.remove('button-warning');
                                    this.classList.add('button-secondary');
                                }, 2000);
                            }
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                        });
            } else {
                // Cambiamos el texto del botón durante 2 segundos
                this.textContent = 'Descripción no válida';
                setTimeout(() => {
                    this.textContent = originalButtonText;
                }, 2000);

                // Pintamos el botón durante 2 segundos
                this.classList.remove('button-secondary');
                this.classList.add('button-warning');
                setTimeout(() => {
                    this.classList.remove('button-warning');
                    this.classList.add('button-secondary');
                }, 2000);
            }
        });
    }

    // Asincronismo para el botón de actualizar datos del usuario
    const updateUserDataButton = document.getElementById('update-user-data');
    if (updateUserDataButton) {
        updateUserDataButton.addEventListener('click', function () {
            // Recogemos el valor de los inputs
            const userId = this.getAttribute('data-id');
            const user = document.getElementById('user').value;
            const email = document.getElementById('email').value;
            const currentPassword = document.getElementById('current-password') ? document.getElementById('current-password').value : '';
            const userPass1 = document.getElementById('password1').value;
            const userPass2 = document.getElementById('password2').value;
            const select = document.getElementById('roles');
            const rol = select ? select.value : '';

            // Guardamos los posibles elementos de error
            const userError = document.getElementById('errorUser');
            const emailError = document.getElementById('errorEmail');
            const currentPassError = document.getElementById('errorCurrentPass');
            const pass1Error = document.getElementById('errorPass1');
            const pass2Error = document.getElementById('errorPass2');
            const globalError = document.getElementById('errorGlobal');

            userError.style.display = 'none';
            emailError.style.display = 'none';
            if (currentPassError)
                currentPassError.style.display = 'none';
            pass1Error.style.display = 'none';
            pass2Error.style.display = 'none';
            globalError.style.display = 'none';

            // Guardamos el texto original del botón
            const originalButtonText = this.textContent;

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
                    currentPassword: currentPassword,
                    password1: userPass1,
                    password2: userPass2,
                }),
            })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Respuesta fallida.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Procesamos la respuesta en el front
                        if (data.action === 'updated') {
                            // Cambiamos el texto del botón durante 2 segundos
                            this.textContent = 'Datos actualizados';
                            setTimeout(() => {
                                this.textContent = originalButtonText;
                            }, 2000);

                            // Pintamos el botón durante 2 segundos
                            this.classList.remove('button-primary');
                            this.classList.add('button-success');
                            setTimeout(() => {
                                this.classList.remove('button-success');
                                this.classList.add('button-primary');
                            }, 2000);

                            if (document.getElementById('current-password')) {
                                document.getElementById('current-password').value = '';
                            }
                            document.getElementById('password1').value = '';
                            document.getElementById('password2').value = '';

                        } else {
                            // Cambiamos el texto del botón durante 2 segundos
                            this.textContent = data.errors ? 'Error al guardar los datos' : 'Son los mismos datos';
                            setTimeout(() => {
                                this.textContent = originalButtonText;
                            }, 2000);

                            // Pintamos el botón durante 2 segundos
                            this.classList.remove('button-primary');
                            this.classList.add('button-warning');
                            setTimeout(() => {
                                this.classList.remove('button-warning');
                                this.classList.add('button-primary');
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
                                if (currentPassError && data.errors.currentPassword) {
                                    currentPassError.innerHTML = data.errors.currentPassword;
                                    currentPassError.style.display = 'block';
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
                    .catch(error => {
                        console.error('Error:', error);
                    });
        });
    }

    // Asincronismo para los botones de follow
    document.querySelectorAll('.user-follow').forEach(function (button) {
        button.addEventListener('click', function () {
            // Recogemos los datos que necesitamos del botón
            const userId = this.id.split('-')[1];
            const userName = this.getAttribute('data-name');

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
                    // Sacamos los errores
                    .catch(function (error) {
                        console.error('Error:', error);
                    });
        });
    });

    // Asincronismo para el botón de borrado de usuarios en el admin
    const deleteUserButton = document.getElementById('button-my-account-user-delete-popup');
    if (deleteUserButton) {
        deleteUserButton.addEventListener('click', function () {
            // Recogemos los datos que necesitamos del botón
            const userId = this.getAttribute('data-id');

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
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Respuesta fallida.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Procesamos la respuesta en el front
                        if (data.success) {
                            if (data.action === 'deleted') {
                                // Cogemos el tr padre
                                const trElement = document.getElementById('my-account-table-user-' + userId);
                                // Lo quitamos de la tabla con una animación
                                if (trElement) {
                                    trElement.style.opacity = 0;
                                    setTimeout(() => {
                                        trElement.remove();
                                    }, 1000);
                                }
                            }
                        }
                        // Pase lo que pase, cerramos el popup
                        const popup = document.getElementById('popup-delete-user');
                        popup.style.display = 'none';
                    })
                    // Sacamos los errores
                    .catch(error => {
                        console.error('Error:', error);
                    });
        });
    }
});