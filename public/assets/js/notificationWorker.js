// Worker para las notificaciones
self.addEventListener('message', function (event) {
    // Obtenemos el id del usuario de la sesión
    const userId = event.data.userId;
    // Si existe
    if (userId) {
        // Declaramos el intervalo de checko del worker
        setInterval(() => {
            // Petición para obtener las notificaciones
            fetch('/check-notifications')
                    .then(response => response.json())
                    .then(data => {
                        if (data.notification && data.notification.length > 0) {
                            // Enviamos la notificación al front
                            self.postMessage(data.notification);
                            // Petición para marcar la notificación como leída
                            fetch('/notification-read', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({notificationId: data.notification[0].id_notification})
                            })
                                    // Sacamos los errores
                                    .catch(error => console.error('Error al marcar la notificación como leída:', error));
                        }
                    })
                    // Sacamos los errores
                    .catch(error => console.error('Error obteniendo las notificaciones:', error));
        }, 500);
    }
});