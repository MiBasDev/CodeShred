<?php

declare(strict_types=1);

namespace CodeShred\Controllers;

//use Illuminate\Http\Request;

class UsersController extends \CodeShred\Core\BaseController {

    // Posibles roles de los usuarios
    const ADMIN = 1;
    const MOD = 2;
    const USER = 3;

    /**
     * Método que enseña la vista de login.
     * 
     * @return void 
     */
    public function login(): void {
        $data = [];
        // Declaramos los datos necesarios de la vista de login
        $data['title'] = 'codeShred | Login';
        $data['section'] = '/login';
        // Enseñamos la vista de login los datos necesarios
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'login.view.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Método que procesa los datos de login, creando una sesión de usuario si son
     * correctos o enviando los errores al front si no lo son.
     * 
     * @return void 
     */
    public function loginProcess(): void {
        $model = new \CodeShred\Models\UsersModel;
        $data = [];
        // Declaramos los datos necesarios de la vista de login
        $data['title'] = 'codeShred | Login';
        $data['section'] = '/login';
        // Comprobamos que existen los datos y no están vacíos
        if (isset($_POST['user']) && isset($_POST['pass']) && !empty($_POST['user']) && !empty($_POST['pass'])) {
            // Intentamos logear
            $user = $model->login($_POST['user'], $_POST['pass']);
            // Si no logea
            if (is_null($user)) {
                // Resgitramos el error
                $data['loginError'] = 'Datos de acceso incorrectos';
                // Saneamos el nombre que nos pasan de usuario
                $data['user'] = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
                // Enseñamos la vista de login de nuevo con los datos recogidos
                $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'login.view.php', 'templates/footer.view.php'), $data);
            } else { // Si logea
                // Creamos un usuario de sesión
                $_SESSION['user'] = $user;
                // Actualizamos los datos del login
                $model->updateLoginData($user['id_user']);
                // Creamos un log de lo ocurrido
                $logModel = new \CodeShred\Models\LogsModel;
                $logModel->insertLog('login', "El usuario '$user[user]' accede al sistema.", $user['id_user']);
                // Enviamos al inicio
                header('location: /');
            }
        } else {
            // Resgitramos el error
            $data['loginError'] = 'Datos de acceso incorrectos';
            // Saneamos el nombre que nos pasan de usuario
            $data['user'] = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
            // Enseñamos la vista de login de nuevo con los datos recogidos
            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'login.view.php', 'templates/footer.view.php'), $data);
        }
    }

    /**
     * Método que enseña la vista de registro.
     * 
     * @return void
     */
    public function register(): void {
        $data = [];
        // Declaramos los datos necesarios de la vista de registro
        $data['title'] = 'codeShred | Registro';
        $data['section'] = '/registro';
        // Enseñamos la vista de registro los datos necesarios
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'register.view.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Método que procesa los datos de registro, creando una sesión de usuario si 
     * son correctos o enviando los errores al front si no lo son.
     * 
     * @return void
     */
    public function registerProcess(): void {
        $model = new \CodeShred\Models\UsersModel;
        $data = [];
        // Declaramos los datos necesarios de la vista de registro
        $data['title'] = 'codeShred | Registro';
        $data['section'] = '/registro';
        // Checkeamos los datos del formulario
        $data['errors'] = $this->checkForm($_POST);
        // Si los datos son correctos
        if (count($data['errors']) == 0) {
            $user = $model->registerCheck($_POST['user']);
            // Creamos un array con los datos necesarios para el registro
            $data = ['user' => $_POST['user'], 'pass' => $_POST['password1'], 'name' => $_POST['name'], 'surname' => $_POST['surname'], 'email' => $_POST['email'], 'rol' => self::USER];
            // Intentamos registrar al usuario con esos datos
            $userOk = $model->register($data);
            // Si hay registro
            if ($userOk) {
                // Creamos un usuario de sesión
                $_SESSION['user'] = $model->getUserByUser($_POST['user']);
                // Actualizamos los datos del login
                $model->updateLoginData($_SESSION['user']['id_user']);
                // Creamos un log de lo ocurrido
                $logModel = new \CodeShred\Models\LogsModel;
                $logModel->insertLog('registro', "El usuario " . $_SESSION['user']['user'] . " se ha registrado en el sistema.", $_SESSION['user']['id_user']);
                // Enviamos al inicio
                header('location: /');
            } else { // Si no hay registro
                // Registramos el error
                $data['errors']['globalError'] = 'Error en la creación del usuario';
                // Saneamos los datos recibidos
                $data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
                $data['surname'] = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_SPECIAL_CHARS);
                $data['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $data['user'] = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
                // Enseñamos la vista de registro con los datos necesarios y recibidos
                $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'register.view.php', 'templates/footer.view.php'), $data);
            }
        } else { // Si los datos no son correctos
            // Saneamos los datos recibidos
            $data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['surname'] = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $data['user'] = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
            // Enseñamos la vista de registro con los datos necesarios y recibidos
            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'register.view.php', 'templates/footer.view.php'), $data);
        }
    }

    /**
     * Método que destruye la sesión del usuario y lo envía al inicio.
     * 
     * @return void 
     */
    public function logout(): void {
        // Destruímos la sesión
        session_destroy();
        // Enviamos al inicio
        header('location: /');
    }

    /**
     * Método que enseña la vista de mi cuenta, obteniendo diferentes datos en 
     * función de si el usuarios de la sesión tiene el rol de admin o no.
     * 
     * @return void
     */
    public function myAccount(): void {
        $data = [];
        // Declaramos los datos necesarios de la vista de mi cuenta
        $data['title'] = 'codeShred | Mi cuenta';
        $data['section'] = '/mi-cuenta';
        //$data['notification']['message'] = 'Hemos vuelto chavales';
        $dataUser = $this->myAccountData();
        $data = array_merge($data, $dataUser);
        // Enseñamos la vista de mi cuenta con los datos obtenidos
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'account.view.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Método que obtiene todos los usuarios del sistema y enseña la vista de 
     * usuarios.
     * 
     * @return void
     */
    public function showAll(): void {
        // Comprobamos que el rol del usuario sea diferente de ADMIN
        if ($_SESSION['user']['user_rol'] != UsersController::ADMIN) {
            $data = [];
            // Declaramos los datos necesarios de la vista de usuarios
            $data['title'] = 'codeShred | Usuarios';
            $data['section'] = '/usuarios';
            // Obtenemos todos los usuarios del sistema
            $model = new \CodeShred\Models\UsersModel();
            $data['users'] = $model->getAll(intval($_SESSION['user']['id_user']));
            // Enseñamos la vista de usuarios con los datos obtenidos
            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'users.view.php', 'templates/footer.view.php'), $data);
        } else { // Si es ADMIN
            // Enviamos al inicio
            header('location: /');
        }
    }

    /**
     * Método que obtiene todos los usuarios seguidos por el usuario de la sesión
     * y enseña la vista de usuarios seguidos.
     * 
     * @return void
     */
    public function showFollowing(): void {
        // Comprobamos que el rol del usuario sea diferente de ADMIN
        if ($_SESSION['user']['user_rol'] != UsersController::ADMIN) {
            $data = [];
            // Declaramos los datos necesarios de la vista de usuarios seguidos
            $data['title'] = 'codeShred | Siguiendo';
            $data['section'] = '/siguiendo';

            // Obtenemos los ususario seguidos
            $model = new \CodeShred\Models\UsersModel();
            $followingUsers = $model->getFollowing($_SESSION['user']['id_user']);

            // Obtenemos los posts de cada susuario y los metemos en su array
            $postModel = new \CodeShred\Models\PostsModel();
            foreach ($followingUsers as &$user) {
                $userId = $user['id_user'];
                $user['posts'] = $postModel->getUserPosts($_SESSION['user']['id_user'], $userId);
            }
            // Guardamos los ususarios en el array de la vista
            $data['users'] = $followingUsers;
            // Enseñamos la vista de usuarios seguidos con los datos obtenidos
            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'following.view.php', 'templates/footer.view.php'), $data);
        } else {
            // Enviamos al inicio
            header('location: /');
        }
    }

    /**
     * Método que elimina al ususario de la sesión del sisitema.
     * 
     * @return void
     */
    public function myAccountDelete(string $id): void {
        $data = [];
        // Declaramos los datos necesarios de la vista de mi cuenta
        $data['title'] = 'codeShred | Mi cuenta';
        $data['section'] = '/mi-cuenta';
        $model = new \CodeShred\Models\UsersModel();
        if ($_SESSION['user']['id_user'] == $id) {
            $isDeleted = $model->delete(intval($_SESSION['user']['id_user']));
            if ($isDeleted) {
                // Desconectamos al usuario de la sesión
                $this->logout();
            } else {
                // Declaramos el error
                $data['errorDelete'] = 'Error inesperado al borrar el usuario.';
                $dataUser = $this->myAccountData();
                $data = array_merge($data, $dataUser);
                // Enseñamos la vista de mi cuenta con los datos obtenidos
                $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'account.view.php', 'templates/footer.view.php'), $data);
            }
        } else {
            // Declaramos el error
            $data['errorDelete'] = 'No puedes borrar a otra persona que no seas tú.';
            $dataUser = $this->myAccountData();
            $data = array_merge($data, $dataUser);
            // Enseñamos la vista de mi cuenta con los datos obtenidos
            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'account.view.php', 'templates/footer.view.php'), $data);
        }
    }

    /**
     * Método que obtiene y devuelve los datos referentes al usuario de la sesión.
     * 
     * @return array Datos referentes al usuario de la sesión.
     */
    private function myAccountData(): array {
        $data = [];
        // Comprobamos que el rol del usuario de la sesión sea USER
        if ($_SESSION['user']['user_rol'] == UsersController::USER) {
            // Obtenemos los datos del usuario y los usuarios que sigue
            $model = new \CodeShred\Models\UsersModel();
            $data['userData'] = $model->getUser($_SESSION['user']['id_user']);
            $data['userFollowing'] = $model->getFollowing($_SESSION['user']['id_user']);
            // Obtenemos los posts del usuario y los posts que les ha dado like
            $model = new \CodeShred\Models\PostsModel();
            $data['userPosts'] = $model->getUserPosts($_SESSION['user']['id_user'], $_SESSION['user']['id_user']);
            $data['userLikedPosts'] = $model->getUserLikedPosts($_SESSION['user']['id_user']);
        } else { // Si no lo es
            // Obtenemos todos los usuarios del sistema
            $model = new \CodeShred\Models\UsersModel();
            $data['usersData'] = $model->getAllAdmin();
            // Obtenemos todos los posts del sistema
            $model = new \CodeShred\Models\PostsModel();
            $data['usersPosts'] = $model->getAllAdmin();
        }
        return $data;
    }

    /**
     * Método que valida los inputs de un formulario, devolviendo los errores, si 
     * los hay, de los mismos.
     * 
     * @param array $post Colección con los datos del formulario.
     * @param bool $isAjax Es una llamada de AJAX o no.
     * @return array Colección de errores si los hay, sino colección vacía.
     */
    private function checkForm(array $post, bool $isAjax = false): array {
        $errors = [];
        $userModel = new \CodeShred\Models\UsersModel();

        // Input user
        if (isset($post['user']) && !empty($post['user'])) {
            if (!preg_match('/^[a-zA-Z0-9]{5,20}$/', $post['user'])) {
                $errors['user'] = 'El nombre de usuario sólo permite letras y números. Longitud entre 5 y 20 caracteres';
            } else {
                $user = $userModel->registerCheck($post['user']);
                if (!is_null($user)) {
                    if ((isset($_SESSION['user']) && $_SESSION['user']['user'] != $post['user']) || !isset($_SESSION['user'])) {
                        $errors['user'] = 'Ya existe un usuario con el nombre ' . $post['user'];
                    }
                }
            }
        } else {
            $errors['user'] = 'Campo obligatorio';
        }

        // Input email
        if (isset($post['email']) && !empty($post['email'])) {
            if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'El email es incorrecto';
            } else {
                $user = $userModel->emailCheck($post['email']);
                if (!is_null($user)) {
                    if ((isset($_SESSION['user']) && $_SESSION['user']['user_email'] != $post['email']) || !isset($_SESSION['user'])) {
                        $errors['user'] = 'Ya existe un usuario con este email';
                    }
                }
            }
        } else {
            $errors['email'] = 'Campo obligatorio';
        }

        // Input password1
        if (isset($post['password1']) && !empty($post['password1'])) {
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $post['password1'])) {
                $errors['password1'] = "La contraseña debe contener una mayúscula, una minúscula, un número y tener una longitud mínima de 8 caracteres.";
            }
        } else {
            if (!isset($_SESSION['user'])) {
                $errors['password1'] = "Campo obligatorio";
            }
        }

        // Input password2
        if (isset($post['password2']) && empty($post['password2'])) {
            // if(!isset($_SESSION['user'])) {
            $errors['password2'] = "Campo obligatorio";
            // }
        }

        // Inputs password1 y password2
        if (isset($post['password1']) && !empty($post['password1']) && isset($post['password2']) && !empty($post['password2']) && $post['password1'] != $post['password2']) {
            $errors['globalError'] = 'Las contraseñas no coinciden';
        }

        // Input name
        if (isset($post['name'])) {
            if (!empty($post['name'])) {
                if (!preg_match('/^[a-zA-Z ]{2,20}$/', $post['name'])) {
                    $errors['name'] = 'El nombre sólo permite letras y espacios. Longitud entre 2 y 20 caracteres';
                }
            } else {
                $errors['name'] = 'Campo obligatorio';
            }
        }

        // Input surname
        if (isset($post['surname'])) {
            if (!empty($post['surname'])) {
                if (!preg_match('/^[a-zA-Z ]{2,80}$/', $post['surname'])) {
                    $errors['surname'] = 'Los apellidos sólo permiten letras y espacios. Longitud entre 2 y 80 caracteres';
                }
            } else {
                $errors['surname'] = 'Campo obligatorio';
            }
        }
        return $errors;
    }

    /**
     * Método que actualiza la descripción del usuario de la sesión de manera 
     * asíncrona.
     * 
     * @return void
     */
    public function updateDescription(): void {
        // Decodificamos los datos enviados en la petición
        $postData = file_get_contents("php://input");
        $data = json_decode($postData, true);

        // Guardamos las variables
        $userId = intval($_SESSION['user']['id_user']);
        $userDescription = $data['userDescription'];

        // Ejecutamos la query
        $model = new \CodeShred\Models\UsersModel();
        $descriptionUpdated = $model->updateUserDescription($userId, $userDescription);

        // Creamos un log de lo ocurrido
        $logModel = new \CodeShred\Models\LogsModel();
        $action = $descriptionUpdated ? 'updated' : 'error upating';
        $logModel->insertLog($action, "El usuario " . $_SESSION['user']['user'] . " ha " . ($descriptionUpdated ? "actualizado" : "no actualizado") . " su descripción.", $_SESSION['user']['id_user']);

        // Enviamos el resultado al front
        echo json_encode(['success' => $descriptionUpdated, 'action' => $action]);
    }

    /**
     * Método que procesa un follow del usuario de la sesión  a otro usuario de 
     * manera asíncrona.
     * 
     * @return void
     */
    public function followProcess(): void {
        // Decodificamos los datos enviados en la petición
        $postData = file_get_contents("php://input");
        $data = json_decode($postData, true);

        // Guardamos las variables
        $userId = intval($_SESSION['user']['id_user']);
        $userIdToFollow = intval($data['userIdToFollow']);

        // Variables por defecto para la respuesta
        $success = false;
        $action = '';

        //Comprobamos que no sean el mismo id (por si nos quieren hackear)
        if ($userId !== $userIdToFollow) {
            $userName = $data['userName'];

            // Comprobamos si el usuario de la sesión sigue o no al usuario en cuestión
            $model = new \CodeShred\Models\UsersModel();
            $isFollowing = $model->followCheck($userId, $userIdToFollow);

            // Ejecutamos un método u otro en función del follow
            if ($isFollowing) {
                $success = $model->unfollow($userId, $userIdToFollow);
            } else {
                $success = $model->follow($userId, $userIdToFollow);
            }

            // Creamos un log de lo ocurrido
            $logModel = new \CodeShred\Models\LogsModel();
            $action = $isFollowing ? 'unfollow' : 'follow';
            $logModel->insertLog($action, "El usuario " . $_SESSION['user']['user'] . " ha " . ($isFollowing ? "dejado de seguir" : "seguido") . " a " . $userName . ".", $_SESSION['user']['id_user']);
        }
        // Enviamos el resultado al front
        echo json_encode(['success' => $success, 'action' => $action]);
    }

    /**
     * Método que elimina un usuario del sistema de manera asíncrona.
     * @return void
     */
    public function tableUserDeleteProcess(): void {
        // Decodificamos los datos enviados en la petición
        $userData = file_get_contents("php://input");
        $data = json_decode($userData, true);

        // Guardamos las variables
        $userId = intval($data['userId']);

        // Comprobamos si es un usuario válido
        if ($_SESSION['user']['id_user'] != $userId) {
            // Borramos el post
            $model = new \CodeShred\Models\UsersModel();
            $isDeleted = $model->delete($userId);

            // Creamos un log de lo ocurrido
            $logModel = new \CodeShred\Models\LogsModel();
            $action = $isDeleted ? 'deleted' : 'not deleted';
            $logModel->insertLog($action, "El usuario " . $_SESSION['user']['user'] . " ha " . ($isDeleted ? "borrado" : "intentado borrar") . " al ususario con ID " . $userId . ".", $_SESSION['user']['id_user']);

            // Enviamos el resultado al front
            echo json_encode(['success' => $isDeleted, 'action' => $action]);
        } else {
            // Enviamos el resultado al front
            echo json_encode(['success' => false, 'action' => 'No se puede borrar a uno mismo']);
        }
    }

    /**
     * Método que actualiza los datos del usuario de la sesión de manera asíncrona.
     * 
     * @return void
     */
    public function updateUserData(): void {
        // Decodificamos los datos enviados en la petición
        $postData = file_get_contents("php://input");
        $data = json_decode($postData, true);

        // Guardamos las variables
        $sessionUserId = intval($_SESSION['user']['id_user']);
        $userId = intval($data['userId']);
        $userUpdated = false;
        $action = [];
        // Miramos que sea el usuario de la sesión
        if ($sessionUserId == $userId) {
            // Checkeamos los inputs
            $errors = $this->checkForm($data);
            // Si los datos son correctos
            if (count($errors) == 0) {
                // Si quiere cambiar el nombre de usuario
                if (isset($data['user']) && $_SESSION['user']['user'] != $data['user']) {
                    // Actualizamos el nombre de usuario
                    $model = new \CodeShred\Models\UsersModel();
                    $userUpdated = $model->updateUserUser($sessionUserId, $data['user']);
                    // Creamos un log de lo ocurrido
                    $logModel = new \CodeShred\Models\LogsModel();
                    $action = $userUpdated ? 'updated' : 'error upating';
                    $logModel->insertLog($action, "El usuario " . $_SESSION['user']['user'] . " ha " . ($userUpdated ? "actualizado" : "no actualizado") . " su nombre de usuario.", $_SESSION['user']['id_user']);
                    // Actualizamos la sesión
                    $_SESSION['user']['user'] = $data['user'];
                }
                // Si quiere cambiar el email
                if (isset($data['email']) && $_SESSION['user']['email'] != $data['email']) {
                    // Actualizamos el email
                    $model = new \CodeShred\Models\UsersModel();
                    $userUpdated = $model->updateUserEmail($sessionUserId, $data['email']);
                    // Creamos un log de lo ocurrido
                    $logModel = new \CodeShred\Models\LogsModel();
                    $action = $userUpdated ? 'updated' : 'error upating';
                    $logModel->insertLog($action, "El usuario " . $_SESSION['user']['user'] . " ha " . ($userUpdated ? "actualizado" : "no actualizado") . " su email.", $_SESSION['user']['id_user']);
                    // Actualizamos la sesión
                    $_SESSION['user']['email'] = $data['email'];
                }

                // Enviamos el resultado al front
                echo json_encode(['success' => $userUpdated, 'action' => $action]);
            } else {
                // Enviamos el resultado al front
                echo json_encode(['success' => $userUpdated, 'action' => 'error upating', 'errors' => $errors]);
            }
        } else {
            echo json_encode(['success' => $userUpdated, 'action' => 'intento de hackeo']);
        }
    }
}
