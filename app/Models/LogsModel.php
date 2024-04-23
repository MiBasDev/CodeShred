<?php

declare(strict_types=1);

namespace CodeShred\Models;

class LogsModel extends \CodeShred\Core\BaseDbModel {
    
    public function insertLog(string $operacion, string $detalle, int $userId) : bool{
        $stmt = $this->pdo->prepare('INSERT INTO logs (action, detail, date, user_id) VALUES(:action, :detail, NOW(), :user_id)');
        return $stmt->execute([$operacion, $detalle, $userId]);
    }
}