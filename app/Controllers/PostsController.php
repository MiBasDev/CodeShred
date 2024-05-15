<?php

declare(strict_types=1);

namespace CodeShred\Controllers;

class PostsController extends \CodeShred\Core\BaseController {

    /**
     * Método que enseña la vista de un post con un id pasado como parámetro.
     * 
     * @param string $id Número identificativo del post a enseñar.
     * @return void
     */
    public function show(string $id): void {
        $data = [];
        // Declaramos los datos necesarios de la vista de post
        $data['title'] = 'codeShred | Shred';
        $data['section'] = '/post';
        $data['css'] = 'post';

        // Creamos el modelo
        $model = new \CodeShred\Models\PostsModel();
        // Obtenemos los datos del post
        $data['post'] = $model->loadPost(intval($id));
        // Añadimos una view al post
        $model->addViewToPost(intval($id));

        // Enseñamos la vista del post con los datos obtenidos
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Método que enseña la vista para añadir un post.
     * 
     * @return void
     */
    public function showAdd(): void {
        $data = [];
        // Declaramos los datos necesarios de la vista de añadir post
        $data['title'] = 'codeShred | Crear Shred';
        $data['section'] = '/post/add';
        $data['css'] = 'post';

        // Enseñamos la vista de añadir un post
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Método que enseña la vista para editar un post.
     * 
     * @param string $id Número identificativo del post a editar.
     * @return void
     */
    public function showEdit(string $id): void {
        $data = [];
        // Declaramos los datos necesarios de la vista de editar post
        $data['title'] = 'codeShred | Editar Shred';
        $data['section'] = '/post/edit';
        $data['css'] = 'post';

        // Creamos el modelo
        $model = new \CodeShred\Models\PostsModel();
        // Obtenemos los posts del usuario con ese id
        $userPosts = $model->getUserPosts($_SESSION['user']['id_user'], $_SESSION['user']['id_user']);
        $idFromUser = false;

        // Comprobamos que el post pertenezca al usuario
        foreach ($userPosts as $userPost) {
            if ($userPost['id_post'] == $id) {
                $idFromUser = true;
            }
        }

        // Si el post pertenece al usuario o el usuario de la sesión es un ADMIN
        if ($idFromUser || $_SESSION['user']['user_rol'] == UsersController::ADMIN) {
            // Obtenemos los datos del post
            $data['post'] = $model->loadPost(intval($id));
            // Si no se Obtienen
            if (is_null($data['post'])) {
                // Redirigimos a la vista de posts
                header('location: /posts');
            } else { // si se obtienen
                // Enseñamos la vista de editar un post
                $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
            }
        } else {
            // Redirigimos a la vista de posts
            header('location: /posts');
        }
    }

    /**
     * Método que enseña la vista de todos los posts.
     * 
     * @return void
     */
    public function showAll(): void {
        $data = [];
        // Declaramos los datos necesarios de la vista de posts
        $data['title'] = 'codeShred | Shreds';
        $data['section'] = '/posts';
        $data['css'] = 'posts';

        // Creamos el modelo
        $model = new \CodeShred\Models\PostsModel();
        // Si existe un ususario de sesión
        if (isset($_SESSION['user']['id_user'])) {
            // Obtneemos todos los posts con los datos referentes al usuario
            $data['posts'] = $model->getAll($_SESSION['user']['id_user']);
        } else { // Si no existe
            // Obtenemos todos los posts
            $data['posts'] = $model->getAllNotSession();
        }

        // Enseñamos la vista de todos los posts
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'posts.view.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Método que enseña la vista de los posts del usuario de la sesión.
     * 
     * @return void
     */
    public function showMyPosts(): void {
        $data = [];
        // Declaramos los datos necesarios de la vista de los posts del usuario de la sesión.
        $data['title'] = 'codeShred | Mis Shreds';
        $data['section'] = '/mi-cuenta/mis-posts';
        $data['css'] = 'posts';

        // Creamos el modelo
        $model = new \CodeShred\Models\PostsModel();
        // Obtenemos todos los posts del usuario
        $data['posts'] = $model->getUserPosts($_SESSION['user']['id_user'], $_SESSION['user']['id_user']);

        // Enseñamos la vista de los posts del usuario de sesión
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'posts.view.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Método que procesa la vista de añadir post.
     * 
     * @return void
     */
    public function processAdd(): void {
        // Creamos el modelo
        $model = new \CodeShred\Models\PostsModel();
        // Declaramos el id de usuario del post
        $_POST['user_id'] = $_SESSION['user']['id_user'];
        // Si se añade el post
        if ($model->add($_POST)) {
            // Añadimos los tags del post
            $model->addTags($_POST);
            // Redirigimos a la vista de posts
            header('location: /posts');
        } else { // Si no se añade
            $data = [];
            // Declaramos los datos necesarios de la vista de añadir un post
            $data['title'] = 'codeShred | Shred';
            $data['section'] = '/post';
            $data['css'] = 'post';

            // Declaramos los errores
            $data['errors']['title'] = filter_input(INPUT_POST, 'shred-title', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['errors']['html'] = $_POST['shred-html'];
            $data['errors']['css'] = $_POST['shred-css'];
            $data['errors']['js'] = $_POST['shred-js'];
            $data['errors']['error'] = 'Error indeterminado al realizar el guardado.';

            // Enseñamos la vista de añadir un post
            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
        }
    }

    /**
     * Método que procesa la edición del post con el id pasado como parámetro.
     * 
     * @param string $id Número identificativo del post a editar.
     * @return void
     */
    public function processEdit(string $id): void {
        // Creamos el modelo
        $model = new \CodeShred\Models\PostsModel();
        // Declaramos el id de usuario del post
        $_POST['user_id'] = $_SESSION['user']['id_user'];
        // Si se edita el post
        if ($model->editPost(intval($id), $_POST)) {
            // Redirigimos a la vista de posts
            header('location: /posts');
        } else { // Si no se edita
            $data = [];
            // Declaramos los datos necesarios de la vista de editar un post
            $data['title'] = 'codeShred | Editar Shred';
            $data['section'] = '/post';
            $data['css'] = 'post';

            // Declaramos los errores
            $data['errors']['title'] = filter_input(INPUT_POST, 'shred-title', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['errors']['html'] = $_POST['shred-html'];
            $data['errors']['css'] = $_POST['shred-css'];
            $data['errors']['js'] = $_POST['shred-js'];
            $data['errors']['error'] = 'Error indeterminado al realizar el guardado.';

            // Enseñamos la vista de editar un post
            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
        }
    }

    /**
     * Método que procesa el borrado del post con el id pasado como parámetro.
     * 
     * @param string $id Número identificativo del post a editar.
     * @return void
     */
    public function deletePost(string $id): void {
        $model = new \CodeShred\Models\PostsModel();
        if ($model->deletePost(intval($id))) {
            header('location: /posts');
        } else {
            $data = [];
            // Declaramos los datos necesarios de la vista de editar un post
            $data['title'] = 'codeShred | Editar Shred';
            $data['section'] = '/post';
            $data['css'] = 'post';

            // Declaramos los errores
            $data['errors']['title'] = filter_input(INPUT_POST, 'shred-title', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['errors']['html'] = $_POST['shred-html'];
            $data['errors']['css'] = $_POST['shred-css'];
            $data['errors']['js'] = $_POST['shred-js'];
            $data['errors']['error'] = 'Error indeterminado al realizar el borrado.';

            // Enseñamos la vista de editar un post
            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
        }
    }

    /**
     * Método que procesa un me gusta de manera asíncrona.
     * 
     * @return void
     */
    public function likeProcess(): void {
        // Decodificamos los datos enviados en la petición
        $postData = file_get_contents("php://input");
        $data = json_decode($postData, true);

        // Guardamos las variables
        $userId = intval($_SESSION['user']['id_user']);
        $postId = intval($data['postId']);

        // Variables por defecto para la respuesta
        $success = false;
        $action = '';

        // Comprobamos el like
        $model = new \CodeShred\Models\LikesModel();
        $isLiked = $model->likeCheck($userId, $postId);

        // Ejecutamos un método u otro en función del follow
        if ($isLiked) {
            $success = $model->unlike($userId, $postId);
        } else {
            $success = $model->like($userId, $postId);
        }

        // Creamos un log de lo ocurrido
        $logModel = new \CodeShred\Models\LogsModel();
        $action = $isLiked ? 'unlike' : 'like';
        $logModel->insertLog($action, "El usuario " . $_SESSION['user']['user'] . " ha " . ($isLiked ? "quitado el like" : "dado like") . " al post con ID " . $postId . ".", $_SESSION['user']['id_user']);

        // Enviamos el resultado al front
        echo json_encode(['success' => $success, 'action' => $action]);
    }

    /**
     * Método que procesa el borrado de un post de manera asíncrona.
     * 
     * @return void
     */
    public function tablePostDeleteProcess(): void {
        // Decodificamos los datos enviados en la petición
        $postData = file_get_contents("php://input");
        $data = json_decode($postData, true);

        // Guardamos las variables
        $postId = intval($data['postId']);

        // Comprobamos si el post es del usuario
        $model = new \CodeShred\Models\PostsModel();
        $userPosts = $model->getUserPosts($_SESSION['user']['id_user'], $_SESSION['user']['id_user']);
        $idFromUser = false;

        foreach ($userPosts as $userPost) {
            if ($userPost['id_post'] === $postId) {
                $idFromUser = true;
            }
        }

        if ($idFromUser || $_SESSION['user']['user_rol'] != UsersController::USER) {
            // Borramos el post
            $isDeleted = $model->deletePost($postId);

            // Creamos un log de lo ocurrido
            $logModel = new \CodeShred\Models\LogsModel();
            $action = $isDeleted ? 'deleted' : 'not deleted';
            $logModel->insertLog($action, "El usuario " . $_SESSION['user']['user'] . " ha " . ($isDeleted ? "borrado" : "intentado borrar") . " al post con ID " . $postId . ".", $_SESSION['user']['id_user']);

            // Enviamos el resultado al front
            echo json_encode(['success' => $isDeleted, 'action' => $action]);
        } else {
            // Enviamos el resultado al front
            echo json_encode(['success' => false, 'action' => 'Intento de hackeo']);
        }
    }
}
