<?php

declare(strict_types=1);

namespace CodeShred\Models;

class LikesModel extends \CodeShred\Core\BaseDbModel {

    /**
     * Método que comprueba si a un usuario le gusta un post.
     * 
     * @param int $userId Número identificativo del usuario.
     * @param int $postId Número identificativo del post.
     * @return bool True si le gusta, false si no.
     */
    public function likeCheck(int $userId, int $postId): bool {
        $stmt = $this->pdo->prepare("SELECT * FROM likes WHERE id_user = :id_user AND id_post = :id_post");
        $stmt->execute(['id_user' => $userId, 'id_post' => $postId]);

        $rowCount = $stmt->rowCount();

        return ($rowCount > 0);
    }

    /**
     * Método que almacena un me gusta en un post por parte de un usuario.
     * 
     * @param int $userId Número identificativo del usuario.
     * @param int $postId Número identificativo del post.
     * @return bool True si lo almacena, false si no.
     */
    public function like(int $userId, int $postId): bool {
        $stmt = $this->pdo->prepare('INSERT INTO likes(id_user, id_post) values(:id_user, :id_post)');

        return $stmt->execute(['id_user' => $userId, 'id_post' => $postId]);
    }

    /**
     * Método que elimina un me gusta en un post hecho por un usuario.
     * @param int $userId Número identificativo del usuario.
     * @param int $postId Número identificativo del post.
     * @return bool True si lo elimina, false si no.
     */
    public function unlike(int $userId, int $postId): bool {
        $stmt = $this->pdo->prepare('DELETE FROM likes WHERE id_user = :id_user AND id_post = :id_post');

        return $stmt->execute(['id_user' => $userId, 'id_post' => $postId]);
    }
}
