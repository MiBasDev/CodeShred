<?php

declare(strict_types=1);

namespace CodeShred\Controllers;

class PostsController extends \CodeShred\Core\BaseController {

    public function show(string $id) {
        $data = [];
        $data['title'] = 'codeShred | Shred';
        $data['section'] = '/post';

        $model = new \CodeShred\Models\PostsModel();

        $data['post'] = $model->loadPost(intval($id));

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
    }

    public function showAdd() {
        $data = [];
        $data['title'] = 'codeShred | Crear Shred';
        $data['section'] = '/post/add';

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
    }

    public function showEdit(string $id) {
        $data = [];
        $data['title'] = 'codeShred | Editar Shred';
        $data['section'] = '/post/edit';

        $model = new \CodeShred\Models\PostsModel();
        $userPosts = $model->getUserPosts($_SESSION['user']['id_user'], $_SESSION['user']['id_user']);
        $idFromUser = false;

        foreach ($userPosts as $userPost) {
            if ($userPost['id_post'] == $id) {
                $idFromUser = true;
            }
        }

        if ($idFromUser || $_SESSION['user']['user_rol'] == UsersController::ADMIN) {
            $data['post'] = $model->loadPost(intval($id));
            if (is_null($data['post'])) {
                header('location: /');
            } else {
                $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
            }
        } else {
            header('location: /');
        }
    }

    public function showAll() {
        $data = [];
        $data['title'] = 'codeShred | Shreds';
        $data['section'] = '/posts';

        $model = new \CodeShred\Models\PostsModel();
        if (isset($_SESSION['user']['id_user'])) {
            $data['posts'] = $model->getAll($_SESSION['user']['id_user']);
        } else {
            $data['posts'] = $model->getAllNotSession();
        }

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'posts.view.php', 'templates/footer.view.php'), $data);
    }

    public function showMyPosts(): void {
        $data = [];
        $data['title'] = 'codeShred | Mis Shreds';
        $data['section'] = '/mi-cuenta/mis-posts';

        $model = new \CodeShred\Models\PostsModel();
        $data['posts'] = $model->getUserPosts($_SESSION['user']['id_user'], $_SESSION['user']['id_user']);

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'posts.view.php', 'templates/footer.view.php'), $data);
    }

    public function processAdd(): void {
        $model = new \CodeShred\Models\PostsModel();
        $_POST['user_id'] = $_SESSION['user']['id_user'];
        if ($model->add($_POST)) {
            $model->addTags($_POST);
            header('location: /posts');
        } else {
            $data = [];

            $data['errors']['title'] = $_POST['shred-title'];
            $data['errors']['html'] = $_POST['shred-html'];
            $data['errors']['css'] = $_POST['shred-css'];
            $data['errors']['js'] = $_POST['shred-js'];
            $data['title'] = 'codeShred | Shred';
            $data['section'] = '/post';

            $data['errors']['error'] = 'Error indeterminado al realizar el guardado.';

            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
        }
    }

    public function processEdit(string $id): void {
        $model = new \CodeShred\Models\PostsModel;
        $_POST['user_id'] = $_SESSION['user']['id_user'];
        if ($model->editPost(intval($id), $_POST)) {
            header('location: /');
        } else {
            $data = [];

            $data['errors']['title'] = $_POST['shred-title'];
            $data['errors']['html'] = $_POST['shred-html'];
            $data['errors']['css'] = $_POST['shred-css'];
            $data['errors']['js'] = $_POST['shred-js'];

            $data['errors']['error'] = 'Error indeterminado al realizar el guardado.';

            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
        }
    }

    public function deletePost(string $id): void {
        $model = new \CodeShred\Models\PostsModel();
        if ($model->deletePost(intval($id))) {
            
        } else {
            
        }
        header('location: /');
    }

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
        $logModel = new \CodeShred\Models\LogsModel;
        $action = $isLiked ? 'unlike' : 'like';
        $logModel->insertLog($action, "El usuario " . $_SESSION['user']['user'] . " ha " . ($isLiked ? "quitado el like" : "dado like") . " al post con ID " . $postId . ".", $_SESSION['user']['id_user']);

        // Enviamos el resultado al front
        echo json_encode(['success' => $success, 'action' => $action]);
    }

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

        if ($idFromUser || $_SESSION['user']['user_rol'] == UsersController::ADMIN) {
            // Borramos el post
            $isDeleted = $model->deletePost($postId);

            // Creamos un log de lo ocurrido
            $logModel = new \CodeShred\Models\LogsModel;
            $action = $isDeleted ? 'deleted' : 'not deleted';
            $logModel->insertLog($action, "El usuario " . $_SESSION['user']['user'] . " ha " . ($isDeleted ? "borrado" : "intentado borrar") . " al post con ID " . $postId . ".", $_SESSION['user']['id_user']);

            // Enviamos el resultado al front
            echo json_encode(['success' => $isDeleted, 'action' => $action]);
        } else {
            echo json_encode(['success' => false, 'action' => 'Intento de hackeo']);
        }
    }
}
