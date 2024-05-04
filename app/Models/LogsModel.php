<?php

declare(strict_types=1);

namespace CodeShred\Models;

class LogsModel extends \CodeShred\Core\BaseDbModel {

    public function insertLog(string $action, string $detail, int $userId): bool {
        $stmt = $this->pdo->prepare('INSERT INTO logs (action, detail, date, user_id) VALUES(:action, :detail, NOW(), :user_id)');
        return $stmt->execute(['action' => $action, 'detail' => $detail, 'user_id' => $userId]);
    }
}
