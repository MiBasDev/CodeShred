<?php

declare(strict_types=1);

namespace CodeShred\Models;

class LogsModel extends \CodeShred\Core\BaseDbModel {

    /**
     * Método que almacena un log en el sistema.
     * 
     * @param string $action Acción que describa el log.
     * @param string $detail Descripción al detalle de lo sucedido en la acción.
     * @param int $userId Número identificativo del usuario al que hace referencia el log.
     * @return bool True si lo almacena, false si no.
     */
    public function insertLog(string $action, string $detail, int $userId): bool {
        $stmt = $this->pdo->prepare('INSERT INTO logs (action, detail, date, user_id) VALUES(:action, :detail, NOW(), :user_id)');
        return $stmt->execute(['action' => $action, 'detail' => $detail, 'user_id' => $userId]);
    }
}
