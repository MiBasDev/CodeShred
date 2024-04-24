<?php

declare(strict_types=1);

namespace CodeShred\Models;

class PostsModel extends \CodeShred\Core\BaseDbModel {

    function getAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM posts ORDER BY id_post');
        return $stmt->fetchAll();
    }

    function getMine(int $id_user): array {
        $stmt = $this->pdo->prepare('SELECT * FROM posts WHERE post_user_id=? ORDER BY id_post');
        $stmt->execute([$id_user]);
        $result = $stmt->fetchAll();
        if (!empty($result)) {
            return $result;
        } else {
            return array();
        }
    }

    function size(): int {
        $stmt = $this->pdo->query('SELECT * FROM posts');
        return count($stmt->fetchAll());
    }

    function delete(int $id_post): int {
        $stmt = $this->pdo->prepare('DELETE FROM posts WHERE id_post=?');
        $stmt->execute([$id_post]);
        return $stmt->rowCount() == 1;
    }

    function add(array $data): bool {
        $code = array('html' => $_POST['html-code'], 'css' => $_POST['css-code'], 'js' => $_POST['js-code']);
        $jsonCode = json_encode($code);
        $size = count($this->getAll());
        $this->pdo->beginTransaction();
        $stmt = $this->pdo->prepare('INSERT INTO posts(post_code,post_img,post_user_id,post_title) values (?,?,?,?)');
        $stmt->execute([
            $jsonCode, $_POST['img'], $_SESSION["id_user"], $_POST['tilte']]
        );
        $new_size = count($this->getAll());

        if (($size + 1) == $new_size) {
            $stmtLog = $this->pdo->prepare('INSERT INTO log (action,detail) VALUES (?,?)');
            $stmtLog->execute([
                'insert', 'Nuevo post de ' . $_SESSION["user"] . ' añadido: ' . print_r($data, true)
            ]);
            $this->pdo->commit();
            return true;
        } else {
            return false;
        }
    }

    function loadPost(int $id_post): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM posts WHERE id_post=?');
        $stmt->execute([$id_post]);
        if ($row == $stmt->fetch()) {
            return $row;
        } else {
            return null;
        }
    }

    function edit(int $id_post, array $data): bool {
        $code = array('html' => $_POST['html-code'], 'css' => $_POST['css-code'], 'js' => $_POST['js-code']);
        $jsonCode = json_encode($code);
        $this->pdo->beginTransaction();
        $stmt = $this->pdo->prepare('UPDATE posts SET post_code=?, post_img=?, post_title=? WHERE id_post=?');
        $stmt->execute([$jsonCode, $data['post_img'], $data['title'], $id_post]);
        $stmtLog = $this->pdo->prepare('INSERT INTO log (action,detail) VALUES (?,?)');
        $stmtLog->execute([
            'update', 'Editado el post ' . $id_post . ' a los siguientes valores: ' . print_r($data, true)
        ]);
        $this->pdo->commit();
        return true;
    }
}
