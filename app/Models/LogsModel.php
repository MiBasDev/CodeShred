<?php

declare(strict_types=1);

namespace CodeShred\Models;

class LogsModel extends \CodeShred\Core\BaseDbModel {
    
    public function insertLog(string $operacion, string $detalle) : bool{
        $stmt = $this->pdo->prepare('INSERT INTO logs (action, detail, date) VALUES(:action, :detail, NOW())');
        return $stmt->execute([$operacion, $detalle]);
    }
}