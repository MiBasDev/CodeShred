<?php

declare(strict_types=1);

namespace CodeShred\Controllers;

//use Illuminate\Http\Request;

class UsersController extends \CodeShred\Core\BaseController {

    const ADMIN = 1;
    const MOD = 2;
    const USER = 3;

    public function login(): void {
        $data = [];
        $data['title'] = 'codeShred | Login';
        $data['section'] = '/login';
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'login.view.php', 'templates/footer.view.php'), $data);
    }

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
                $_SESSION['permisos'] = $this->getPermissions($user['user_rol']);
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

    public function register(): void {
        $data = [];
        $data['title'] = 'codeShred | Registro';
        $data['section'] = '/registro';
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'register.view.php', 'templates/footer.view.php'), $data);
    }

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
                    $_SESSION['permisos'] = $this->getPermissions($_SESSION['user']['user_rol']);
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

    public function logout(): void {
        session_destroy();
        header('location: /');
    }

    private function getPermissions(int $idRol): array {
        $permisos = array(
            'categorias' => '',
            'proveedores' => '',
            'productos' => '',
            'usuarios_sistema' => '');

        if (self::ADMIN == $idRol) {
            $permisos['categorias'] = 'rwd';
            $permisos['proveedores'] = 'rwd';
            $permisos['productos'] = 'rwd';
            $permisos['usuarios_sistema'] = 'rwd';
        } else if (self::MOD == $idRol) {
            $permisos['categorias'] = 'r';
            $permisos['proveedores'] = 'r';
            $permisos['productos'] = 'r';
            $permisos['usuarios_sistema'] = 'r';
        } else if (self::USER == $idRol) {
            $permisos['proveedores'] = 'rd';
            $permisos['productos'] = 'rd';
            $permisos['categorias'] = 'rd';
        }

        return $permisos;
    }

    function myAccount(): void {
        $data = [];
        $data['title'] = 'codeShred | Mi cuenta';
        $data['section'] = '/mi-cuenta';
        //$data['notification']['message'] = 'Hemos vuelto chavales';

        $model = new \CodeShred\Models\UsersModel();
        $data['userData'] = $model->getUser($_SESSION['user']['id_user']);
        $data['userFollowing'] = $model->getFollowing($_SESSION['user']['id_user']);
        $model = new \CodeShred\Models\PostsModel();
        $data['userPosts'] = $model->getUserPosts($_SESSION['user']['id_user'], $_SESSION['user']['id_user']);

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'account.view.php', 'templates/footer.view.php'), $data);
    }

    function updateDescription(): void {
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

    function showAll(): void {
        $data = [];
        $data['title'] = 'codeShred | Usuarios';
        $data['section'] = '/usuarios';

        $model = new \CodeShred\Models\UsersModel();
        $data['users'] = $model->getAll(intval($_SESSION['user']['id_user']));

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'users.view.php', 'templates/footer.view.php'), $data);
    }

    function showFollowing(): void {
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
    }

    function delete(string $id): void {
        if ($_SESSION['usuario']['id_usuario'] == $id) {
            $_SESSION['mensajeUsuarios'] = array(
                'class' => 'warning',
                'texto' => 'No está permitido eliminarse a uno mismo.'
            );
            header('Location: /usuarios-sistema');
        } else {
            $model = new \Com\Daw2\Models\UsuarioSistemaModel();
            $result = $model->delete($id);
            if ($result) {
                header('Location: /usuarios-sistema');
            } else {
                $_SESSION['mensajeUsuarios'] = array(
                    'class' => 'danger',
                    'texto' => 'No se ha logrado borrar el registro.'
                );
                header('Location: /usuarios-sistema');
            }
        }
    }

    function baja(string $id): void {
        if ($_SESSION['usuario']['id_usuario'] == $id) {
            $_SESSION['mensajeUsuarios'] = array(
                'class' => 'warning',
                'texto' => 'No está permitido darse de baja a uno mismo.'
            );
            header('Location: /usuarios-sistema');
        } else {
            $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
            $result = $modelo->baja($id);
            if ($result) {
                header('Location: /usuarios-sistema');
            } else {
                $_SESSION['mensajeUsuarios'] = array(
                    'class' => 'danger',
                    'text' => 'Error indeterminado al cambiar el estado.'
                );
            }
        }
    }

    function view(string $id): void {
        $data = [];
        $data['titulo'] = 'Usuario del sistema ' . $id;
        $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
        $data['usuario'] = $modelo->loadUsuario($id);

        $this->view->showViews(array('templates/header.view.php', 'detail.usuario_sistema.view.php', 'templates/footer.view.php'), $data);
    }

    function mostrarAdd(): void {
        $data = [];
        $data['titulo'] = 'Nuevo usuario del sistema';
        $data['tituloDiv'] = "Alta usuario";
        $data['seccion'] = '/usuarios-sistema/add';
        $modeloRol = new \Com\Daw2\Models\AuxRolModel();
        $data['roles'] = $modeloRol->getAll();
        $this->view->showViews(array('templates/header.view.php', 'edit.usuario_sistema.view.php', 'templates/footer.view.php'), $data);
    }

    public function add(): void {
        $errores = $this->checkForm($_POST);
        if (count($errores) == 0) {
            $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
            if ($modelo->insert($_POST)) {
                header('location: /usuarios-sistema');
            } else {
                $data = [];
                $input = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
                $data['titulo'] = 'Alta usuario';
                $data['tituloDiv'] = "Alta usuario";
                $rolesModel = new \Com\Daw2\Models\AuxRolModel();
                $data['roles'] = $rolesModel->getAll();
                $data['seccion'] = '/usuarios-sistema/add';
                $data['input'] = $input;
                $data['errores'] = ['nombre' => 'Error indeterminado al guardar'];

                $this->view->showViews(array('templates/header.view.php', 'edit.usuario_sistema.view.php', 'templates/footer.view.php'), $data);
            }
        } else {
            $data = [];
            $input = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $data['titulo'] = 'Alta usuario';
            $data['tituloDiv'] = "Alta usuario";
            $rolesModel = new \Com\Daw2\Models\AuxRolModel();
            $data['roles'] = $rolesModel->getAll();
            $data['seccion'] = '/usuarios-sistema/add';
            $data['input'] = $input;
            $data['errores'] = $errores;

            $this->view->showViews(array('templates/header.view.php', 'edit.usuario_sistema.view.php', 'templates/footer.view.php'), $data);
        }
    }

    function mostrarEdit($id) {
        $data = [];
        $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
        $user = $modelo->loadUsuario($id);
        $data['titulo'] = 'Usuario ' . $user['nombre_completo'];
        $data['tituloDiv'] = "Editando $user[nombre_completo]";
        $rolesModel = new \Com\Daw2\Models\AuxRolModel();
        $data['roles'] = $rolesModel->getAll();
        $data['seccion'] = '/usuarios-sistema/edit/' . $id;

        $data['input'] = $user;

        $this->view->showViews(array('templates/header.view.php', 'edit.usuario_sistema.view.php', 'templates/footer.view.php'), $data);
    }

    function edit(int $id): void {
        $errores = $this->checkForm($_POST, false, $id);
        if (count($errores) == 0) {
            $modelo = new \Com\Daw2\Models\UsuarioSistemaModel();
            if ($modelo->update($_POST, $id)) {
                if ($_POST['pass'] != '') {
                    $modelo->updatePass($id, $_POST['pass']);
                }
                header('location: /usuarios-sistema');
            } else {
                $data = [];
                $input = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
                $data['titulo'] = 'Usuario ' . $input['nombre'] . ' con ID: ' . $id;
                $rolesModel = new \Com\Daw2\Models\AuxRolModel();
                $data['roles'] = $rolesModel->getAll();
                $data['seccion'] = '/usuarios-sistema/edit/' . $id;
                $data['input'] = $input;
                $data['errores'] = ['nombre' => 'Error indeterminado al guardar'];

                $this->view->showViews(array('templates/header.view.php', 'edit.usuario_sistema.view.php', 'templates/footer.view.php'), $data);
            }
        } else {
            $data = [];
            $input = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $data['titulo'] = 'Usuario ' . $input['nombre_completo'] . ' con ID: ' . $id;
            $rolesModel = new \Com\Daw2\Models\AuxRolModel();
            $data['roles'] = $rolesModel->getAll();
            $data['seccion'] = '/usuarios-sistema/edit/' . $id;
            $data['input'] = $input;
            $data['errores'] = $errores;

            $this->view->showViews(array('templates/header.view.php', 'edit.usuario_sistema.view.php', 'templates/footer.view.php'), $data);
        }
    }

    function checkForm(array $post, bool $esAlta = true, int $id = 0): array {
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
            $rolModel = new \Com\Daw2\Models\AuxRolModel();
            $rol = $rolModel->loadRol((int) $post['id_rol']);
            if (is_null($rol)) {
                $errores['id_rol'] = 'Seleccione un rol válido';
            }
        }

        if (empty($post['idioma'])) {
            $errores['idioma'] = "Campo obligatorio";
        } else if (array_search($post['idioma'], self::IDIOMAS) === false) {
            $errores['idioma'] = "Idioma inválido";
        }

        return $errores;
    }

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
}
