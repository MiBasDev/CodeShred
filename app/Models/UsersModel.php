<?php

declare(strict_types=1);

namespace CodeShred\Models;

use \PDOException;

class UsersModel extends \CodeShred\Core\BaseDbModel {

    /**
     * Método que busca un usuario con un nombre de usuario pasado como parámetro, 
     * obtiene sus datos y comprueba si su contraseña es igual que la que ha recuperado.
     * 
     * @param string $user Nombre de la cuenta del usuario a buscar.
     * @param string $password Contraseña del ususario.
     * @return array|null Datos del usuario si los obtiene, null si no.
     */
    public function login(string $user, string $password): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE user = :user");
        $stmt->execute(['user' => $user]);
        if ($stmt->rowCount() == 1) {
            $userData = $stmt->fetch();
            // Comprobamos que las contraseñas sean iguales
            if (password_verify($password, $userData['user_pass'])) {
                unset($userData['user_pass']);
                return $userData;
            }
        }
        return NULL;
    }

    /**
     * Método que obtiene o no un usuario con el nombre de usuario pasado como
     * parámetro.
     * 
     * @param string $user Nombre de la cuenta del usuario a buscar.
     * @return array|null Datos del usuario si los obtiene, null si no.
     */
    public function registerCheck(string $user): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE user = :user");
        $stmt->execute(['user' => $user]);
        if ($stmt->rowCount() == 1) {
            $userData = $stmt->fetch();
            return $userData;
        }
        return NULL;
    }

    /**
     * Método que obtiene o no un usuario con ese email pasado como parámetro.
     * 
     * @param string $email Email del usuario a buscar.
     * @return array|null Datos del usuario si los obtiene, null si no.
     */
    public function emailCheck(string $email): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_email = :user_email");
        $stmt->execute(['user_email' => $email]);
        if ($stmt->rowCount() == 1) {
            $userData = $stmt->fetch();
            return $userData;
        }
        return NULL;
    }

    /**
     * Método que almacena los datos de un usuario recibidos como parámetro en el
     * sistema.
     * 
     * @param array $data Datos del ususario a almacenar.
     * @return bool True si inserta los datos, false si no.
     */
    public function register(array $data): bool {
        $stmt = $this->pdo->prepare('INSERT INTO users(user, user_pass, user_name, user_surname, user_email, user_rol, user_gravatar) values (:user, :pass, :name, :surname, :email, :rol, :gravatar)');
        $pass = password_hash($data['pass'], PASSWORD_DEFAULT);

        return $stmt->execute(['user' => $data['user'], 'pass' => $pass, 'name' => $data['name'], 'surname' => $data['surname'], 'email' => $data['email'], 'rol' => $data['rol'], 'gravatar' => $data['gravatar']]);
    }

    /**
     * Método que obtiene un usuario por su nombre de usuario, pasado como parámetro.
     * 
     * @param string $user Nombre de la cuenta del usuario a buscar.
     * @return array|null Datos del usuario si los obtiene, null si no.
     */
    function getUserByUser(string $user): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE user = :user');
        $stmt->execute(['user' => $user]);

        return $stmt->fetch();
    }

    /**
     * Método que actualiza los datos de login de un usuario, pasado su id como 
     * parámetro.
     * 
     * @param int $idUser Número identificativo del usuario a actualizar.
     * @return bool True si lo actualiza, false si no.
     */
    public function updateLoginData(int $idUser): bool {
        $stmt = $this->pdo->prepare('UPDATE users SET user_last_login=NOW() WHERE id_user = :id_user');

        return $stmt->execute(['id_user' => $idUser]);
    }

    /**
     * Método que obtiene todos los usuarios del sistema junto con los follows 
     * asociados al id de usuario pasado como parámetro.
     * 
     * @param int $id Número identificativo del usuario a buscar.
     * @return array|null Datos de los usuarios si los obtiene, null si no.
     */
    function getAll(int $id): ?array {
        $stmt = $this->pdo->prepare('SELECT u.*, f.user_id_following FROM users u LEFT JOIN follows f ON u.id_user = f.user_id_following AND f.user_id = :follows_user_id WHERE u.id_user != :user_user_id AND u.user_rol != :user_rol');
        $stmt->execute(['follows_user_id' => $id, 'user_user_id' => $id, 'user_rol' => \CodeShred\Controllers\UsersController::ADMIN]);

        return $stmt->fetchAll();
    }

    /**
     * Método que obtiene todos los usuarios del sistema que tenga un rol menor
     * que el rol del usuario de la sesión.
     * 
     * @return array|null Datos de los usuarios si los obtiene, null si no.
     */
    function getAllAdmin(): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE user_rol > :user_rol ORDER BY user_rol');
        $stmt->execute(['user_rol' => $_SESSION['user']['user_rol']]);

        return $stmt->fetchAll();
    }

    /**
     * Método que obtiene los datos de el usuario con el id pasado como parámetro.
     * 
     * @param int $id Número identificativo del usuario a buscar.
     * @return array|null Datos del usuario si los obtiene, null si no.
     */
    function getUser(int $id): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id_user = :id');
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }

    /**
     * Método que obtiene todos los usuarios del sistema a los que sigue el usuario 
     * con el id pasado como parámetro.
     * 
     * @param int $id Número identificativo del usuario.
     * @return array|null Datos de los usuarios si los obtiene, null si no.
     */
    function getFollowing(int $id): ?array {
        $stmt = $this->pdo->prepare('SELECT u.id_user, u.user, u.user_description, u.user_gravatar FROM users u JOIN follows f ON u.id_user = f.user_id_following WHERE f.user_id = :id');
        $stmt->execute(['id' => $id]);

        return $stmt->fetchAll();
    }

    /**
     * Método que elimina el usuario con el id pasado como parámetro del sistema.
     * 
     * @param int $id Número identificativo del usuario a borrar.
     * @return bool True si lo elimina, false si no.
     */
    function delete(int $id): bool {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id_user = :id');
        $stmt->execute(['id' => $id]);

        return ($stmt->rowCount() == 1);
    }

    /**
     * Método que actualiza la descripción del usuario con el id pasado como parámetro.
     * 
     * @param int $idUser Número identificativo del usuario a actualizar.
     * @param string $description Descripción del ususario para actualizar.
     * @return bool True si la actualiza, false si no.
     */
    function updateUserDescription(int $idUser, string $description): bool {
        $stmt = $this->pdo->prepare('UPDATE users SET user_description = :user_description WHERE id_user = :id_user');

        return $stmt->execute(['user_description' => $description, 'id_user' => $idUser]);
    }

    /**
     * Método que actualiza el nombre de usuario del usuario con el id pasado como 
     * parámetro.
     * 
     * @param int $idUser Número identificativo del usuario a actualizar.
     * @param string $user Nombre de cuenta del usuario para actualizar.
     * @return bool True si lo actualiza, false si no.
     */
    function updateUserUser(int $idUser, string $user): bool {
        $stmt = $this->pdo->prepare('UPDATE users SET user = :user WHERE id_user = :id_user');

        return $stmt->execute(['user' => $user, 'id_user' => $idUser]);
    }

    /**
     * Método que actualiza el email del usuario con el id pasado como parámetro.
     * 
     * @param int $idUser Número identificativo del usuario a actualizar.
     * @param string $email Email del usuario para actualizar.
     * @return bool  True si lo actualiza, false si no.
     */
    function updateUserEmail(int $idUser, string $email): bool {
        $stmt = $this->pdo->prepare('UPDATE users SET user_email = :user_email WHERE id_user = :id_user');

        return $stmt->execute(['user_email' => $email, 'id_user' => $idUser]);
    }

    /**
     * Método que actualiza el rol del usuario con el id pasado como parámetro.
     * 
     * @param int $idUser Número identificativo del usuario a actualizar.
     * @param string $rol Rol del usuario para actualizar.
     * @return bool  True si lo actualiza, false si no.
     */
    function updateUserRol(int $idUser, int $rol): bool {
        $stmt = $this->pdo->prepare('UPDATE users SET user_rol = :user_rol WHERE id_user = :id_user');

        return $stmt->execute(['user_rol' => $rol, 'id_user' => $idUser]);
    }

    /**
     * Método que comprueba si un usuario sigue a otro usuario en el sistema, ambos 
     * ids de usuario pasados como parámetro.
     * 
     * @param int $userId Número identificativo del usuario que sigue.
     * @param int $userIdToFollow Número identificativo del usuario que es seguido.
     * @return bool True si lo sigue, false si no.
     */
    public function followCheck(int $userId, int $userIdToFollow): bool {
        $stmt = $this->pdo->prepare("SELECT * FROM follows WHERE user_id = :user_id AND user_id_following = :user_id_following");
        $stmt->execute(['user_id' => $userId, 'user_id_following' => $userIdToFollow]);

        $rowCount = $stmt->rowCount();

        return ($rowCount > 0);
    }

    /**
     * Método que almacena un follow en la base de datos de un usuario a otro, ambos 
     * ids de usuario pasados como parámetro.
     * 
     * @param int $userId Número identificativo del usuario.
     * @param int $userIdToFollow Número identificativo del usuario al que quiere seguir.
     * @return bool True si lo almacena, false si no.
     */
    public function follow(int $userId, int $userIdToFollow): bool {
        $stmt = $this->pdo->prepare('INSERT INTO follows(user_id, user_id_following) values(:user_id, :user_id_following)');

        return $stmt->execute(['user_id' => $userId, 'user_id_following' => $userIdToFollow]);
    }

    /**
     * Método que elimina un follow en la base de datos de un usuario a otro, ambos 
     * ids de usuario pasados como parámetro.
     * 
     * @param int $userId  Número identificativo del usuario.
     * @param int $userIdToFollow Número identificativo del usuario al que quiere dejar de seguir.
     * @return bool  True si lo elimina, false si no.
     */
    public function unfollow(int $userId, int $userIdToFollow): bool {
        $stmt = $this->pdo->prepare('DELETE FROM follows WHERE user_id = :user_id AND user_id_following = :user_id_following');

        return $stmt->execute(['user_id' => $userId, 'user_id_following' => $userIdToFollow]);
    }
}
