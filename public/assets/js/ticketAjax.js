document.addEventListener('DOMContentLoaded', function () {
    // Asincronismo para los botones de marcar los tickets como resueltos
    document.querySelectorAll('.ticket-resolve').forEach(function (button) {
        button.addEventListener('click', function () {
            // Recogemos los datos que necesitamos del botón
            const ticketId = this.id.split('-')[1];

            // Empezamos la petición
            fetch('/ticket-resolve', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    ticketId: ticketId
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
                            // Cambiamos los estilos del botón
                            if (data.action === 'resolved') {
                                button.classList.remove('button-secondary');
                                button.classList.add('button-success');
                                button.querySelector('span').classList.remove('fa-cog');
                                button.querySelector('span').classList.add('fa-check');
                                button.title = 'Ticket resuelto';
                            }
                        }
                    })
                    // Sacamos los errores
                    .catch(function (error) {
                        console.error('Error:', error);
                    });
        });
    });

    // Asincronismo para los botones de borrado de tickets
    document.querySelectorAll('#popup-button-ticket-delete').forEach(function (button) {
        button.addEventListener('click', function () {
            // Recogemos los datos que necesitamos del botón
            const ticketId = this.getAttribute('data-id');

            // Empezamos la petición
            fetch('/ticket-delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    ticketId: ticketId
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
                                const ticket = document.getElementById('tickets-card-' + ticketId);
                                // Lo quitamos de la vista con una animación
                                if (ticket) {
                                    ticket.style.opacity = 0;
                                    setTimeout(function () {
                                        ticket.remove();
                                    }, 1000);
                                }
                            }
                        }
                        // Pase lo que pase, cerramos el popup
                        var popup = document.getElementById('popup-delete-ticket');
                        popup.style.display = 'none';
                    })
                    // Sacamos los errores
                    .catch(function (error) {
                        console.error('Error:', error);
                    });
        });
    });
});

// Función para abrir el popup de borrado de tickets
function openDeletePopup(id) {
    // Obtenemos el popup y lo ponemos a flex
    const popup = document.getElementById('popup-delete-ticket');
    // Agregamos el id al botón en un atributo data
    const buttonDelete = document.getElementById('popup-button-ticket-delete');

    buttonDelete.setAttribute('data-id', id);
    popup.style.display = 'flex';
}

// Función para cerrar el popup de borrado de tickets
function closeDeletePopup() {
    // Obtenemos el popup y lo ponemos a none
    const popup = document.getElementById('popup-delete-ticket');

    popup.style.display = 'none';
}