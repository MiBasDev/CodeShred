<?php

declare(strict_types=1);

namespace CodeShred\Models;

class NotificationsModel extends \CodeShred\Core\BaseDbModel {

    /**
     * Método que obtiene la última notificación del ususario pasado como parámetro.
     * 
     * @param int $userId Número identificativo del usuario.
     * @return array Colección con la última notificación.
     */
    public function getLatestNotificationForUser(int $userId): array {
        $stmt = $this->pdo->prepare("SELECT * FROM notifications WHERE notification_user = :userId AND notification_read_status = :status ORDER BY id_notification DESC LIMIT 1");
        $stmt->execute(['userId' => $userId, 'status' => false]);

        return $stmt->fetchAll();
    }

    /**
     * Método que almacena una notificación en el sistema.
     * 
     * @param int $userId Número identificativo del usuario.
     * @param string $type Tipo de notificación.
     * @param string $message Mensaje de la notificación.
     * @return bool True si la almacena, false si no.
     */
    public function addNotification(int $userId, string $type, string $message): bool {
        $stmt = $this->pdo->prepare('INSERT INTO notifications (notification_user, notification_type, notification_message) VALUES(:user_id, :type, :message)');

        return $stmt->execute(['user_id' => $userId, 'type' => $type, 'message' => $message]);
    }

    /**
     * Método que marca una notificación como leída.
     * 
     * @param int $notificationId Número identificativo de la notificación.
     * @return bool True si la actualiza, false si no.
     */
    public function markNotificationAsRead(int $notificationId): bool {
        $stmt = $this->pdo->prepare('UPDATE notifications SET notification_read_status = :notification_shown WHERE id_notification = :id_notification');

        return $stmt->execute(['notification_shown' => true, 'id_notification' => $notificationId]);
    }
}
