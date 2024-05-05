document.addEventListener('DOMContentLoaded', function () {
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