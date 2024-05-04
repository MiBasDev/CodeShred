<?php

declare(strict_types=1);

namespace CodeShred\Models;

class PostsModel extends \CodeShred\Core\BaseDbModel {

    function getAll(int $userId): ?array {
        $stmt = $this->pdo->prepare('SELECT p.*, u.user, t.*, (SELECT id_like FROM likes WHERE id_post = p.id_post AND id_user = :userId) AS liked, (SELECT view_count FROM views WHERE view_post_id = p.id_post) AS views FROM posts p LEFT JOIN users u ON p.post_user_id = u.id_user LEFT JOIN tags t ON p.id_post = t.tags_post_id ORDER BY p.id_post DESC');
        $stmt->execute(['userId' => $userId]);

        return $stmt->fetchAll();
    }

    function getAllNotSession(): ?array {
        $stmt = $this->pdo->query('SELECT p.*, u.user, t.*, (SELECT view_count FROM views WHERE view_post_id = p.id_post) AS views FROM posts p LEFT JOIN users u ON p.post_user_id = u.id_user LEFT JOIN tags t ON p.id_post = t.tags_post_id ORDER BY p.id_post DESC');

        return $stmt->fetchAll();
    }

    function getAllAdmin(): ?array {
        $stmt = $this->pdo->query('SELECT p.*, u.user FROM posts p LEFT JOIN users u ON p.post_user_id = u.id_user ORDER BY p.id_post DESC');

        return $stmt->fetchAll();
    }

    function getAllForSize(): ?array {
        $stmt = $this->pdo->query('SELECT * FROM posts');

        return $stmt->fetchAll();
    }

    function getAllIndex(): ?array {
        $stmt = $this->pdo->query('SELECT p.*, u.user, t.*, (SELECT view_count FROM views WHERE view_post_id = p.id_post) AS views FROM posts p LEFT JOIN users u ON p.post_user_id = u.id_user LEFT JOIN tags t ON p.id_post = t.tags_post_id ORDER BY p.id_post DESC LIMIT 4');

        return $stmt->fetchAll();
    }

    function getUserPosts(int $sessionUserId, int $userId): ?array {
        $stmt = $this->pdo->prepare('SELECT p.*, u.user, t.*, (SELECT id_like FROM likes WHERE id_post = p.id_post AND id_user = :sessionUserId) AS liked, (SELECT view_count FROM views WHERE view_post_id = p.id_post) AS views FROM posts p LEFT JOIN users u ON p.post_user_id = u.id_user LEFT JOIN tags t ON p.id_post = t.tags_post_id WHERE u.id_user = :userId ORDER BY p.id_post DESC');
        $stmt->execute(['sessionUserId' => $sessionUserId, 'userId' => $userId]);

        return $stmt->fetchAll();
    }

    function getUserLikedPosts(int $userId): ?array {
        $stmt = $this->pdo->prepare('SELECT p.id_post, p.post_title, u.user FROM posts p JOIN likes l ON p.id_post = l.id_post JOIN users u ON p.post_user_id = u.id_user WHERE l.id_user = :userId ORDER BY l.id_like DESC');
        $stmt->execute(['userId' => $userId]);

        return $stmt->fetchAll();
    }

    function add(array $data): bool {
        $code = array('html' => $data['shred-html'], 'css' => $data['shred-css'], 'js' => $data['shred-js']);
        $jsonCode = json_encode($code);
        $size = count($this->getAllForSize());

        $this->pdo->beginTransaction();
        $stmt = $this->pdo->prepare('INSERT INTO posts(post_code,post_img,post_user_id,post_title) VALUES (:post_code, :post_img, :post_user_id, :post_title)');
        $stmt->execute(['post_code' => $jsonCode, 'post_img' => '-', 'post_user_id' => $data['user_id'], 'post_title' => $data['shred-title']]);
        $postId = $this->pdo->lastInsertId();

        $newSize = count($this->getAllForSize());

        if (($size + 1) == $newSize) {
            $stmtView = $this->pdo->prepare('INSERT INTO views (view_post_id, view_count) VALUES (:view_post_id, :view_count)');
            $stmtView->execute(['view_post_id' => $postId, 'view_count' => 0]);

            $stmtLog = $this->pdo->prepare('INSERT INTO logs (action, detail, user_id) VALUES (:action, :detail, :user_id)');
            $stmtLog->execute(['action' => 'insert', 'detail' => 'Nuevo post de ' . $_SESSION["user"]["user"] . ' añadido: ' . $data['shred-title'], 'user_id' => $data['user_id']]);

            $this->pdo->commit();
            return true;
        } else {
            return false;
        }
    }

    function addTags(array $data): bool {
        $stmt = $this->pdo->prepare('SELECT id_post FROM posts WHERE post_user_id = :post_user_id ORDER BY id_post DESC LIMIT 1');
        $stmt->execute(['post_user_id' => $data['user_id']]);
        $lastPost = $stmt->fetch();

        if (!$lastPost) {
            return false;
        }

        $tagHtml = !empty($data['shred-html']) ? 1 : 0;
        $tagCss = !empty($data['shred-css']) ? 1 : 0;
        $tagJs = !empty($data['shred-js']) ? 1 : 0;

        try {
            $this->pdo->beginTransaction();

            $stmtTags = $this->pdo->prepare('INSERT INTO tags(tags_post_id,tags_html,tags_css,tags_js) VALUES (:tags_post_id, :tags_html, :tags_css, :tags_js)');
            $stmtTags->execute(['tags_post_id' => $lastPost['id_post'], 'tags_html' => $tagHtml, 'tags_css' => $tagCss, 'tags_js' => $tagJs]);

            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    function loadPost(int $idPost): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM posts WHERE id_post = :id_post');
        $stmt->execute(['id_post' => $idPost]);
        if ($row = $stmt->fetch()) {
            return $row;
        } else {
            return null;
        }
    }

    function addViewToPost(int $idPost): bool {
        $stmt = $this->pdo->prepare('UPDATE views SET view_count = view_count + 1 WHERE view_post_id = :view_post_id');

        return $stmt->execute(['view_post_id' => $idPost]);
    }

    function editPost(int $idPost, array $data): bool {
        $code = array('html' => $data['shred-html'], 'css' => $data['shred-css'], 'js' => $data['shred-js']);
        $jsonCode = json_encode($code);
        $this->pdo->beginTransaction();

        $stmt = $this->pdo->prepare('UPDATE posts SET post_code = :post_code, post_img = :post_img, post_title = :post_title WHERE id_post = :id_post');
        $stmt->execute(['post_code' => $jsonCode, 'post_img' => '-', 'post_title' => $data['shred-title'], 'id_post' => $idPost]);

        $stmtLog = $this->pdo->prepare('INSERT INTO logs (action, detail, user_id) VALUES (:action, :detail, :user_id)');
        $stmtLog->execute(['action' => 'update', 'detail' => 'Post de ' . $_SESSION["user"]["user"] . ' actualizado: ' . $data['shred-title'], 'user_id' => $data['user_id']]);

        $tagHtml = !empty($data['shred-html']) ? 1 : 0;
        $tagCss = !empty($data['shred-css']) ? 1 : 0;
        $tagJs = !empty($data['shred-js']) ? 1 : 0;

        $stmtTags = $this->pdo->prepare('UPDATE tags SET tags_html = :tags_html, tags_css = :tags_css, tags_js = :tags_js WHERE tags_post_id = :tags_post_id');
        $stmtTags->execute(['tags_html' => $tagHtml, 'tags_css' => $tagCss, 'tags_js' => $tagJs, 'tags_post_id' => $idPost]);

        $this->pdo->commit();
        return true;
    }

    function deletePost(int $id_post): bool {
        $stmt = $this->pdo->prepare('DELETE FROM posts WHERE id_post = :id_post');
        return $stmt->execute(['id_post' => $id_post]);
    }
}
