<?php

declare(strict_types=1);

namespace CodeShred\Controllers;

class PostsController extends \CodeShred\Core\BaseController {

    public function show(string $id) {
        $data = [];
        $data['title'] = 'codeShred | Shred';
        $data['section'] = '/post';

        $modelo = new \CodeShred\Models\PostsModel();

        $data['post'] = $modelo->loadPost(intval($id));

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
        $modelo = new \CodeShred\Models\PostsModel();
        $data['post'] = $modelo->loadPost(intval($id));
        if (is_null($data['post'])) {
            header('location: /');
        } else {
            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
        }
    }

    public function showAll() {
        $data = [];
        $data['title'] = 'codeShred | Shreds';
        $data['section'] = '/posts';

        $modelo = new \CodeShred\Models\PostsModel();
        $data['posts'] = $modelo->getAll();

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'posts.view.php', 'templates/footer.view.php'), $data);
    }

    public function showMyPosts(): void {
        $data = [];
        $data['title'] = 'codeShred | Mis Shreds';
        $data['section'] = '/mi-cuenta/mis-posts';

        $modelo = new \CodeShred\Models\PostsModel();
        $data['posts'] = $modelo->getMine($_SESSION['user']['id_user']);

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'posts.view.php', 'templates/footer.view.php'), $data);
    }

    public function processAdd(): void {
        $modelo = new \CodeShred\Models\PostsModel();
        $_POST['user_id'] = $_SESSION['user']['id_user'];
        if ($modelo->add($_POST)) {
            $modelo->addTags($_POST);
            header('location: /posts');
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

    public function processEdit(string $id): void {
        $modelo = new \CodeShred\Models\PostsModel;
        $_POST['user_id'] = $_SESSION['user']['id_user'];
        if ($modelo->editPost(intval($id), $_POST)) {
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
        $modelo = new \CodeShred\Models\PostsModel();
        if ($modelo->deletePost(intval($id))) {
            $_SESSION['mensaje_productos'] = array(
                'class' => 'success',
                'texto' => "Producto $id eliminado con éxito");
        } else {
            $_SESSION['mensaje_productos'] = array(
                'class' => 'danger',
                'texto' => 'No se ha logrado eliminar el producto ' . $id);
        }
        header('location: /');
    }
}
