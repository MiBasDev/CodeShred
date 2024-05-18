<?php

declare(strict_types=1);

namespace CodeShred\Controllers;

class NotificationsController extends \CodeShred\Core\BaseController {

    /**
     * Método que comprueba si el usuario de la sesión tiene notificaciones nuevas
     * asíncrontamente.
     * 
     * @return void
     */
    public function checkNotifications(): void {
        // Creamos el modelo
        $model = new \CodeShred\Models\NotificationsModel();
        // Obtenemos la notificación del usuario de la sesión
        $notification = $model->getLatestNotificationForUser(intval($_SESSION['user']['id_user']));

        // Enviamos la notificación al front
        echo json_encode(['notification' => $notification]);
    }

    /**
     * Método que marca como leída una notificación asíncronamente.
     * 
     * @return void
     */
    public function setNotificationToRead(): void {
        // Decodificamos los datos enviados en la petición y los guardamos
        $input = json_decode(file_get_contents("php://input"), true);
        $notificationId = intval($input['notificationId']);

        // Creamos el modelo
        $model = new \CodeShred\Models\NotificationsModel();
        // Intentamos marcas como leída la notifiación
        if ($model->markNotificationAsRead($notificationId)) {
            // Enviamos la repsuesta al front
            echo json_encode(['success' => true]);
        } else {
            // Enviamos la repsuesta al front
            echo json_encode(['success' => false]);
        }
    }
}
