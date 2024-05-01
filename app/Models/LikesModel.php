<?php

declare(strict_types=1);

namespace CodeShred\Models;

class LikesModel extends \CodeShred\Core\BaseDbModel {

    public function likeCheck(int $userId, int $postId): ?bool {
        $stmt = $this->pdo->prepare("SELECT * FROM likes WHERE id_user=? AND id_post=?");
        $stmt->execute([$userId, $postId]);

        $result = $stmt->fetch();

        if ($result !== false) {
            return true;
        } else {
            return false;
        }
    }

    public function like(int $userId, int $postId): ?bool {
        $stmt = $this->pdo->prepare('INSERT INTO likes(id_user, id_post) values(:id_user, :id_post)');
        return $stmt->execute(['id_user' => $userId, 'id_post' => $postId]);
    }

    public function unlike(int $userId, int $postId): ?bool {
        $stmt = $this->pdo->prepare('DELETE FROM likes WHERE id_user=? AND id_post=?');
        return $stmt->execute([$userId, $postId]);
    }
}
