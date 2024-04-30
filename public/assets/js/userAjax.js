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
}); 