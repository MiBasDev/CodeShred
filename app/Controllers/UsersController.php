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
     * @return void Enseña la vista de login.
     */
    public function login(): void {
        $data = [];
        $data['title'] = 'codeShred | Login';
        $data['section'] = '/login';
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'login.view.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Método que procesa los datos de login, creando una sesión de usuario si son
     * correctos o enviando los errores al front si no lo son.
     * 
     * @return void Logea o no al usuario.
     */
    public function loginProcess(): void {
        $model = new \CodeShred\Models\UsersModel;
        $data = [];
        if (isset($_POST['user']) && isset($_POST['pass']) && !empty($_POST['user']) && !empty($_POST['pass'])) {
            $user = $model->login($_POST['user'], $_POST['pass']);
            if (is_null($user)) {
                $data['loginError'] = 'Datos de acceso incorrectos';
                $data['user'] = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
                $data['title'] = 'codeShred | Login';
                $data['section'] = '/login';
                $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'login.view.php', 'templates/footer.view.php'), $data);
            } else {
                $_SESSION['user'] = $user;
                $model->updateLoginData($user['id_user']);
                $logModel = new \CodeShred\Models\LogsModel;
                $logModel->insertLog('login', "El usuario '$user[user]' accede al sistema.", $user['id_user']);
                header('location: /');
            }
        } else {
            $data['loginError'] = 'Datos de acceso incorrectos';
            $data['user'] = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['title'] = 'codeShred | Login';
            $data['section'] = '/login';
            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'login.view.php', 'templates/footer.view.php'), $data);
        }
    }

    /**
     * Método que enseña la vista de registro.
     * 
     * @return void Enseña la vista de registro.
     */
    public function register(): void {
        $data = [];
        $data['title'] = 'codeShred | Registro';
        $data['section'] = '/registro';
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'register.view.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Método que procesa los datos de registro, creando una sesión de usuario si 
     * son correctos o enviando los errores al front si no lo son.
     * 
     * @return void Resgitra o no al usuario.
     */
    public function registerProcess(): void {
        $model = new \CodeShred\Models\UsersModel;
        $data = [];
        $doQuery = true;
        $bothPass = true;
        if (isset($_POST['name']) && empty($_POST['name'])) {
            $data['loginErrorName'] = 'Campo obligatorio';
            $doQuery = false;
        }
        if (isset($_POST['surname']) && empty($_POST['surname'])) {
            $data['loginErrorSurname'] = 'Campo obligatorio';
            $doQuery = false;
        }
        if (isset($_POST['email']) && empty($_POST['email'])) {
            $data['loginErrorEmail'] = 'Campo obligatorio';
            $doQuery = false;
        }
        if (isset($_POST['user']) && empty($_POST['user'])) {
            $data['loginErrorUser'] = 'Campo obligatorio';
            $doQuery = false;
        }
        if (isset($_POST['password1']) && empty($_POST['password1'])) {
            $data['loginErrorPass1'] = 'Campo obligatorio';
            $doQuery = false;
            $bothPass = false;
        }
        if (isset($_POST['password2']) && empty($_POST['password2'])) {
            $data['loginErrorPass2'] = 'Campo obligatorio';
            $doQuery = false;
            $bothPass = false;
        }
        if ($bothPass == true && $_POST['password1'] != $_POST['password2']) {
            $data['loginError'] = 'Las contraseñas no coinciden';
            $doQuery = false;
        }
        if ($doQuery == true) {
            $user = $model->registerCheck($_POST['user']);
            if (!is_null($user)) {
                $data['loginError'] = 'Ya existe un usuario con ese nombre';
                $data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
                $data['surname'] = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_SPECIAL_CHARS);
                $data['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $data['user'] = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
                $data['title'] = 'codeShred | Registro';
                $data['section'] = '/registro';
                $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'register.view.php', 'templates/footer.view.php'), $data);
            } else {
                $data = ['user' => $_POST['user'], 'pass' => $_POST['password1'], 'name' => $_POST['name'], 'surname' => $_POST['surname'], 'email' => $_POST['email'], 'rol' => self::USER];
                $userOk = $model->register($data);
                if ($userOk === true) {
                    $_SESSION['user'] = $model->getUserByUser($_POST['user']);
                    $model->updateLoginData($_SESSION['user']['id_user']);
                    $logModel = new \CodeShred\Models\LogsModel;
                    $logModel->insertLog('registro', "El usuario " . $_SESSION['user']['user'] . " se ha registrado en el sistema.", $_SESSION['user']['id_user']);
                    header('location: /');
                } else {
                    $data['loginError'] = 'Error en la creación del usuario';
                    $data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
                    $data['surname'] = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_SPECIAL_CHARS);
                    $data['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                    $data['user'] = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
                    $data['title'] = 'codeShred | Registro';
                    $data['section'] = '/registro';
                    $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'register.view.php', 'templates/footer.view.php'), $data);
                }
            }
        } else {
            $data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['surname'] = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $data['user'] = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['title'] = 'codeShred | Registro';
            $data['section'] = '/registro';
            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'register.view.php', 'templates/footer.view.php'), $data);
        }
    }

    /**
     * Método que destruye la sesión del usuario y lo envía al inicio.
     * 
     * @return void 
     */
    public function logout(): void {
        session_destroy();
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
        $data['title'] = 'codeShred | Mi cuenta';
        $data['section'] = '/mi-cuenta';
        //$data['notification']['message'] = 'Hemos vuelto chavales';

        if ($_SESSION['user']['user_rol'] == UsersController::USER) {
            $model = new \CodeShred\Models\UsersModel();
            $data['userData'] = $model->getUser($_SESSION['user']['id_user']);
            $data['userFollowing'] = $model->getFollowing($_SESSION['user']['id_user']);
            $model = new \CodeShred\Models\PostsModel();
            $data['userPosts'] = $model->getUserPosts($_SESSION['user']['id_user'], $_SESSION['user']['id_user']);
            $data['userLikedPosts'] = $model->getUserLikedPosts($_SESSION['user']['id_user']);
        } else {
            $model = new \CodeShred\Models\UsersModel();
            $data['usersData'] = $model->getAllAdmin();
            $model = new \CodeShred\Models\PostsModel();
            $data['usersPosts'] = $model->getAllAdmin();
        }
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'account.view.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Método que obtiene todos los usuarios del sistema y enseña la vista de 
     * usuarios.
     * 
     * @return void
     */
    public function showAll(): void {
        if ($_SESSION['user']['user_rol'] != UsersController::ADMIN) {
            $data = [];
            $data['title'] = 'codeShred | Usuarios';
            $data['section'] = '/usuarios';

            $model = new \CodeShred\Models\UsersModel();
            $data['users'] = $model->getAll(intval($_SESSION['user']['id_user']));

            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'users.view.php', 'templates/footer.view.php'), $data);
        } else {
            header('location: /');
        }
    }

    /**
     * Método que obtiene todos los usuarios seguidos por el usuarios de la sesión
     * y enseña la vista de usuarios seguidos.
     * 
     * @return void
     */
    public function showFollowing(): void {
        if ($_SESSION['user']['user_rol'] != UsersController::ADMIN) {
            $data = [];
            $data['title'] = 'codeShred | Siguiendo';
            $data['section'] = '/siguiendo';

            // Obtenemos los ususario seguidos
            $model = new \CodeShred\Models\UsersModel();
            $followingUsers = $model->getFollowing($_SESSION['user']['id_user']);

            // Obtenemos los posts de cada susuario
            $postModel = new \CodeShred\Models\PostsModel();
            foreach ($followingUsers as &$user) {
                $userId = $user['id_user'];
                $user['posts'] = $postModel->getUserPosts($_SESSION['user']['id_user'], $userId);
            }

            $data['users'] = $followingUsers;

            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'following.view.php', 'templates/footer.view.php'), $data);
        } else {
            header('location: /');
        }
    }

    /**
     * Método que elimina al ususario de la sesión del sisitema.
     * 
     * @return void
     */
    public function myAccountDelete(): void {
        $model = new \CodeShred\Models\UsersModel();

        $this->logout();
    }

    /**
     * Método que valida los inputs de un formulario, devolviendo los errores, si 
     * los hay, de los mismos.
     * 
     * @param array $post Colección con los datos del formulario.
     * @param int $id Número identificativo del usuario.
     * @return array Colección de errores si los hay, sino devuelve una colección vacía.
     */
    private function checkForm(array $post, int $id = 0): array {
        $errores = [];
        $userModel = new \CodeShred\Models\UsersModel();

        if (!preg_match('/^[a-zA-Z ]{5,70}$/', $post['nombre_completo'])) {
            $errores['nombre_completo'] = 'El nombre sólo permite letras y espacios. Longitud entre 5 y 70 caracteres';
        }

        if (!preg_match('/^[0-9]{7,8}[A-Z]$/', $post['dni'])) {
            $errores['dni'] = 'El dni debe estar formado por 7 u 8 dígitos seguidos de una letra mayúscula.';
        } else {
            $user = $userModel->findByDni($post['dni']);
            if (!is_null($user)) {
                if ($esAlta) {
                    $errores['dni'] = 'Dni en uso por el siguiente <a href="/usuarios-sistema/edit/' . $user['id_usuario'] . '">usuario</a>';
                } else if ($user['id_usuario'] != $id) {
                    $errores['dni'] = 'Dni en uso por el siguiente <a href="/usuarios-sistema/edit/' . $user['id_usuario'] . '">usuario</a>';
                }
            }
        }

        if ($esAlta || $post['pass'] != '') {
            if (empty($post['pass'])) {
                $errores['pass'] = "Campo obligatorio";
            } else if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/', $post['pass'])) {
                $errores['pass'] = "El password debe contener una mayúscula, una minúscula y un número y tener una longitud mínima de 8 caracteres.";
            } else if ($post['pass'] != $post['pass2']) {
                $errores['pass'] = 'Los passwords no coinciden';
            }
        }

        if (empty($post['email'])) {
            $errores['email'] = "Campo obligatorio";
        } else if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'Inserte un email válido';
        } else {
            if ($userModel->countByEmailNotUser($post['email'], $id) > 0) {
                $errores['email'] = 'El email seleccionado ya está en uso';
            }
        }

        if (empty($post['id_rol'])) {
            $errores['id_rol'] = "Campo obligatorio";
        } else if (!filter_var($post['id_rol'], FILTER_VALIDATE_INT)) {
            $errores['id_rol'] = 'Inserte un rol válido';
        } else {
            // $rolModel = new \Com\Daw2\Models\AuxRolModel();
            // $rol = $rolModel->loadRol((int) $post['id_rol']);
            // if (is_null($rol)) {
            //     $errores['id_rol'] = 'Seleccione un rol válido';
            // }
        }

        // if (empty($post['idioma'])) {
        //     $errores['idioma'] = "Campo obligatorio";
        // } else if (array_search($post['idioma'], self::IDIOMAS) === false) {
        //     $errores['idioma'] = "Idioma inválido";
        // }

        return $errores;
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
        $logModel = new \CodeShred\Models\LogsModel;
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
            $logModel = new \CodeShred\Models\LogsModel;
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
            $logModel = new \CodeShred\Models\LogsModel;
            $action = $isDeleted ? 'deleted' : 'not deleted';
            $logModel->insertLog($action, "El usuario " . $_SESSION['user']['user'] . " ha " . ($isDeleted ? "borrado" : "intentado borrar") . " al ususario con ID " . $userId . ".", $_SESSION['user']['id_user']);

            // Enviamos el resultado al front
            echo json_encode(['success' => $isDeleted, 'action' => $action]);
        } else {
            // Enviamos el resultado al front
            echo json_encode(['success' => false, 'action' => 'No se puede borrar a uno mismo']);
        }
    }
}
