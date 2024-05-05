<?php

declare(strict_types=1);

namespace CodeShred\Models;

use \PDOException;

class UsersModel extends \CodeShred\Core\BaseDbModel {

    public function login(string $name, string $password): ?array {
        //$stmt = $this->pdo->prepare("SELECT usuario_sistema.*, aux_rol.nombre_rol FROM usuario_sistema LEFT JOIN aux_rol ON aux_rol.id_rol = usuario_sistema.id_rol WHERE dni=? and baja=0");
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_name = :user_name");
        $stmt->execute(['user_name' => $name]);
        if ($stmt->rowCount() == 1) {
            $userData = $stmt->fetch();
            if (password_verify($password, $userData['user_pass'])) {
                unset($userData['user_pass']);
                return $userData;
            }
        }
        return NULL;
    }

    public function registerCheck(string $name): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_name = :user_name");
        $stmt->execute(['user_name' => $name]);
        if ($stmt->rowCount() == 1) {
            $userData = $stmt->fetch();
            return $userData;
        }
        return NULL;
    }

    public function register(array $data): ?bool {
        $stmt = $this->pdo->prepare('INSERT INTO users(user, user_pass, user_name, user_surname, user_email, user_rol) values (:user, :pass, :name, :surname, :email, :rol)');
        $pass = password_hash($data['pass'], PASSWORD_DEFAULT);

        return $stmt->execute(['user' => $data['user'], 'pass' => $pass, 'name' => $data['name'], 'surname' => $data['surname'], 'email' => $data['email'], 'rol' => $data['rol']]);
    }

    function getUserByUser(string $user): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE user = :user');
        $stmt->execute(['user' => $user]);

        return $stmt->fetch();
    }

    public function updateLoginData(int $idUser): bool {
        $stmt = $this->pdo->prepare('UPDATE users SET user_last_login=NOW() WHERE id_user = :id_user');

        return $stmt->execute(['id_user' => $idUser]);
    }

    function getAll(int $id): ?array {
        $stmt = $this->pdo->prepare('SELECT u.*, f.user_id_following FROM users u LEFT JOIN follows f ON u.id_user = f.user_id_following AND f.user_id = :follows_user_id WHERE u.id_user != :user_user_id AND u.user_rol = :user_rol');
        $stmt->execute(['follows_user_id' => $id, 'user_user_id' => $id, 'user_rol' => \CodeShred\Controllers\UsersController::USER]);

        return $stmt->fetchAll();
    }

    function getAllAdmin(): ?array {
        $stmt = $this->pdo->prepare('SELECT id_user, user, user_description, user_rol FROM users WHERE user_rol != :user_rol ORDER BY user_rol');
        $stmt->execute(['user_rol' => \CodeShred\Controllers\UsersController::ADMIN]);

        return $stmt->fetchAll();
    }

    function getUser(int $id): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id_user = :id');
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }

    function getFollowing(int $id): ?array {
        $stmt = $this->pdo->prepare('SELECT u.id_user, u.user, u.user_description FROM users u JOIN follows f ON u.id_user = f.user_id_following WHERE f.user_id = :id');
        $stmt->execute(['id' => $id]);

        return $stmt->fetchAll();
    }

    function delete(int $id): bool {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id_user = :id');
        $stmt->execute(['id' => $id]);
        return ($stmt->rowCount() == 1);
    }

    //////
    function baja(string $id): bool {
        $prev = $this->pdo->prepare('SELECT baja FROM usuario_sistema WHERE id_usuario=?');
        $prev->execute([$id]);
        $actual = $prev->fetchAll();
        $baja = $actual[0];
        $stmt = $this->pdo->prepare('UPDATE usuario_sistema SET baja=? WHERE id_usuario=?');
        if ($baja['baja'] == 0) {
            return $stmt->execute(['1', $id]);
        } else {
            return $stmt->execute(['0', $id]);
        }
    }

    function loadUsuario(string $id): array {
        $stmt = $this->pdo->prepare('SELECT usuario_sistema.*, aux_rol.nombre_rol FROM usuario_sistema LEFT JOIN aux_rol ON aux_rol.id_rol = usuario_sistema.id_rol WHERE id_usuario=?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    function insert(array $data): bool {
        $stmt = $this->pdo->prepare('INSERT INTO usuario_sistema(id_rol, email, contrasinal, nombre_completo, dni, idioma, ultimo_acceso, baja) values (:id_rol, :email, :contrasinal, :nombre_completo, :dni, :idioma, null, 0)');
        $pass = password_hash($data['pass'], PASSWORD_DEFAULT);
        return $stmt->execute(['id_rol' => $data['id_rol'], 'email' => $data['email'], 'contrasinal' => $pass, 'nombre_completo' => $data['nombre_completo'], 'dni' => $data['dni'], 'idioma' => $data['idioma']]);
    }

    function update(array $data, int $id): bool {
        $stmt = $this->pdo->prepare('UPDATE usuario_sistema SET id_rol=?, email=?, idioma=?, nombre_completo=?, dni=? WHERE id_usuario=?');
        return $stmt->execute([$data['id_rol'], $data['email'], $data['idioma'], $data['nombre_completo'], $data['dni'], $id]);
    }

    function updatePass(int $idUsuario, string $pass): bool {
        $stmt = $this->pdo->prepare('UPDATE usuario_sistema SET contrasinal=? WHERE id_usuario=?');
        $passEnc = password_hash($pass, PASSWORD_DEFAULT);
        return $stmt->execute([$passEnc, $idUsuario]);
    }

    function updateUserDescription(int $idUser, string $description): bool {
        $stmt = $this->pdo->prepare('UPDATE users SET user_description=? WHERE id_user=?');
        return $stmt->execute([$description, $idUser]);
    }

    function countByEmailNotUser(string $email, int $id_user): int {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM usuario_sistema WHERE email = ? AND id_usuario != ?');
        $stmt->execute([$email, $id_user]);
        return $stmt->fetchColumn(0);
    }

    function findByDni(string $dni): ?array {
        $stmt = $this->pdo->prepare('SELECT usuario_sistema.*, aux_rol.nombre_rol FROM usuario_sistema LEFT JOIN aux_rol ON aux_rol.id_rol = usuario_sistema.id_rol WHERE dni=?');
        $stmt->execute([$dni]);
        if ($row = $stmt->fetch()) {
            return $row;
        } else {
            return null;
        }
    }

    /////

    public function followCheck(int $userId, int $userIdToFollow): bool {
        $stmt = $this->pdo->prepare("SELECT * FROM follows WHERE user_id = :user_id AND user_id_following = :user_id_following");
        $stmt->execute(['user_id' => $userId, 'user_id_following' => $userIdToFollow]);

        $rowCount = $stmt->rowCount();

        return ($rowCount > 0);
    }

    public function follow(int $userId, int $userIdToFollow): bool {
        $stmt = $this->pdo->prepare('INSERT INTO follows(user_id, user_id_following) values(:user_id, :user_id_following)');

        return $stmt->execute(['user_id' => $userId, 'user_id_following' => $userIdToFollow]);
    }

    public function unfollow(int $userId, int $userIdToFollow): bool {
        $stmt = $this->pdo->prepare('DELETE FROM follows WHERE user_id = :user_id AND user_id_following = :user_id_following');

        return $stmt->execute(['user_id' => $userId, 'user_id_following' => $userIdToFollow]);
    }
}
