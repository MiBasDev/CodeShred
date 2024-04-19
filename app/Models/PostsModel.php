<?php

declare(strict_types=1);

namespace CodeShred\Models;

class PostsModel extends \CodeShred\Core\BaseDbModel {

    function getAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM posts ORDER BY id, nombre');
        return $stmt->fetchAll();
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
        $size = count($this->getAll());
        $this->pdo->beginTransaction();
//        $stmt = $this->pdo->prepare('INSERT INTO posts(cif,codigo,nombre,direccion,website,pais,email,telefono) values (?,?,?,?,?,?,?,?)');
//        $stmt->execute([
//            $_POST['cif'], $_POST['codigo'], $_POST['nombre'], $_POST['direccion'], $_POST['website'], $_POST['pais'], $_POST['email'], $_POST['telefono']]
//        );
        $new_size = count($this->getAll());

        if (($size + 1) == $new_size) {
            $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
            $stmtLog->execute([
                'insert', 'proveedor', 'Añadido un nuevo elemento a la tabla de proveedores con los datos: ' . print_r($data, true)
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
        $this->pdo->beginTransaction();
        $stmt = $this->pdo->prepare('UPDATE posts SET cif=?, codigo=?, nombre=?, direccion=?, website=?, pais=?, email=?, telefono=? WHERE id_post=?');
        $stmt->execute([$data['cif'], $data['codigo'], $data['nombre'], $data['direccion'], $data['website'], $data['pais'], $data['email'], $data['telefono'], $cif]);
//        $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
//        $stmtLog->execute([
//            'update', 'proveedor', 'Editado el proveedor con cif=' . $cif . ' a los siguientes valores: '. print_r($data, true)
//        ]);
        $this->pdo->commit();
        return true;
    }
}
