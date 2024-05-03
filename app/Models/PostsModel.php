<?php

declare(strict_types=1);

namespace CodeShred\Models;

class PostsModel extends \CodeShred\Core\BaseDbModel {

    function getAll(int $userId): ?array {
        $stmt = $this->pdo->prepare('SELECT p.*, u.user, t.*, (SELECT id_like FROM likes WHERE id_post = p.id_post AND id_user = :userId) AS liked FROM posts p LEFT JOIN users u ON p.post_user_id = u.id_user LEFT JOIN tags t ON p.id_post = t.tags_post_id ORDER BY p.id_post DESC');
        $stmt->execute(['userId' => $userId]);

        return $stmt->fetchAll();
    }

    function getAllNotSession(): ?array {
        $stmt = $this->pdo->query('SELECT p.*, u.user, t.* FROM posts p LEFT JOIN users u ON p.post_user_id = u.id_user LEFT JOIN tags t ON p.id_post = t.tags_post_id ORDER BY p.id_post DESC');

        return $stmt->fetchAll();
    }

    function getAllForSize(): ?array {
        $stmt = $this->pdo->query('SELECT * FROM posts');

        return $stmt->fetchAll();
    }

    function getAllIndex(): ?array {
        $stmt = $this->pdo->query('SELECT p.*, u.user, t.* FROM posts p LEFT JOIN users u ON p.post_user_id = u.id_user LEFT JOIN tags t ON p.id_post = t.tags_post_id ORDER BY p.id_post DESC LIMIT 4');

        return $stmt->fetchAll();
    }

    function getUserPosts(int $sessionUserId, int $userId): ?array {
        $stmt = $this->pdo->prepare('SELECT p.*, u.user, t.*, (SELECT id_like FROM likes WHERE id_post = p.id_post AND id_user = :sessionUserId) AS liked FROM posts p LEFT JOIN users u ON p.post_user_id = u.id_user LEFT JOIN tags t ON p.id_post = t.tags_post_id WHERE u.id_user = :userId ORDER BY p.id_post DESC');
        $stmt->execute(['sessionUserId' => $sessionUserId, 'userId' => $userId]);

        return $stmt->fetchAll();
    }

    function getUserLikedPosts(int $userId): ?array {
        $stmt = $this->pdo->prepare('SELECT p.id_post, p.post_title, u.user FROM posts p JOIN likes l ON p.id_post = l.id_post JOIN users u ON p.post_user_id = u.id_user WHERE l.id_user = :userId ORDER BY l.id_like DESC');
        $stmt->execute(['userId' => $userId]);

        return $stmt->fetchAll();
    }

    function size(): int {
        $stmt = $this->pdo->query('SELECT * FROM posts');

        return count($stmt->fetchAll());
    }

    function add(array $data): bool {
        $code = array('html' => $data['shred-html'], 'css' => $data['shred-css'], 'js' => $data['shred-js']);
        $jsonCode = json_encode($code);
        $size = count($this->getAllForSize());
        $this->pdo->beginTransaction();
        $stmt = $this->pdo->prepare('INSERT INTO posts(post_code,post_img,post_user_id,post_title) VALUES (?,?,?,?)');
        $stmt->execute([
            $jsonCode, '-', $data['user_id'], $data['shred-title']
        ]);

        $newSize = count($this->getAllForSize());

        if (($size + 1) == $newSize) {

            $stmtLog = $this->pdo->prepare('INSERT INTO logs (action, detail, user_id) VALUES (?, ?, ?)');
            $stmtLog->execute([
                'insert', 'Nuevo post de ' . $_SESSION["user"]["user"] . ' añadido: ' . $data['shred-title'], $data['user_id']
            ]);

            $this->pdo->commit();
            return true;
        } else {
            return false;
        }
    }

    function addTags(array $data): bool {
        $stmt = $this->pdo->prepare('SELECT id_post FROM posts WHERE post_user_id = ? ORDER BY id_post DESC LIMIT 1');
        $stmt->execute([$data['user_id']]);
        $lastPost = $stmt->fetch();

        if (!$lastPost) {
            return false;
        }

        $tagHtml = !empty($data['shred-html']) ? 1 : 0;
        $tagCss = !empty($data['shred-css']) ? 1 : 0;
        $tagJs = !empty($data['shred-js']) ? 1 : 0;

        try {
            $this->pdo->beginTransaction();

            $stmtTags = $this->pdo->prepare('INSERT INTO tags(tags_post_id,tags_html,tags_css,tags_js) VALUES (?,?,?,?)');
            $stmtTags->execute([
                $lastPost['id_post'], $tagHtml, $tagCss, $tagJs
            ]);

            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    function loadPost(int $idPost): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM posts WHERE id_post=?');
        $stmt->execute([$idPost]);
        if ($row = $stmt->fetch()) {
            return $row;
        } else {
            return null;
        }
    }

    function addViewToPost(int $idPost): ?int {
        $stmt = $this->pdo->prepare('SELECT * FROM views WHERE view_post_id = ?');
        $existingViews = $stmt->execute([$idPost]);
        var_dump($existingViews);

        if ($existingViews) {
            $newCount = $existingViews['view_count'] + 1;
            $stmt = $this->pdo->prepare('UPDATE views SET view_count = ? WHERE view_post_id = ?');
            $stmt->execute([$newCount, $idPost]);
        } else {
            $newCount = 1;
            $stmt = $this->pdo->prepare('INSERT INTO views (view_post_id, view_count) VALUES (?, ?)');
            $stmt->execute([$idPost, $newCount]);
        }

        return $newCount;
    }

    function editPost(int $idPost, array $data): bool {
        $code = array('html' => $data['shred-html'], 'css' => $data['shred-css'], 'js' => $data['shred-js']);
        $jsonCode = json_encode($code);
        $this->pdo->beginTransaction();
        $stmt = $this->pdo->prepare('UPDATE posts SET post_code=?, post_img=?, post_title=? WHERE id_post=?');
        $stmt->execute([
            $jsonCode, '-', $data['shred-title'], $idPost
        ]);
        $stmtLog = $this->pdo->prepare('INSERT INTO logs (action, detail, user_id) VALUES (?, ?, ?)');
        $stmtLog->execute([
            'update', 'Post de ' . $_SESSION["user"]["user"] . ' actualizado: ' . $data['shred-title'], $data['user_id']
        ]);

        $tagHtml = !empty($data['shred-html']) ? 1 : 0;
        $tagCss = !empty($data['shred-css']) ? 1 : 0;
        $tagJs = !empty($data['shred-js']) ? 1 : 0;

        $stmtTags = $this->pdo->prepare('UPDATE tags SET tags_html=?, tags_css=?, tags_js=? WHERE tags_post_id=?');
        $stmtTags->execute([
            $tagHtml, $tagCss, $tagJs, $idPost
        ]);

        $this->pdo->commit();
        return true;
    }

    function deletePost(int $id_post): bool {
        $stmt = $this->pdo->prepare('DELETE FROM posts WHERE id_post=?');
        return $stmt->execute([$id_post]);
    }
}
