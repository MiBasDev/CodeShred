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
        $data['title'] = 'CodeShred | Shred';
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
        $data['title'] = 'CodeShred | Crear Shred';
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
        $data['title'] = 'CodeShred | Editar Shred';
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
        if ($idFromUser || $_SESSION['user']['user_rol'] != UsersController::USER) {
            // Obtenemos los datos del post
            $data['post'] = $model->loadPost(intval($id));
            // Si no se Obtienen
            if (is_null($data['post'])) {
                // Enviamos a la vista de mis posts
                header('location: /mi-cuenta/mis-posts');
            } else { // si se obtienen
                // Enseñamos la vista de editar un post
                $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
            }
        } else {
            // Enviamos a la vista de mis posts
            header('location: /mi-cuenta/mis-posts');
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
        $data['title'] = 'CodeShred | Shreds';
        $data['section'] = '/posts';
        $data['css'] = 'posts';

        // Creamos el modelo
        $model = new \CodeShred\Models\PostsModel();
        // Si existe un usuario de sesión
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
        $data['title'] = 'CodeShred | Mis Shreds';
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

        // Comprobamos que sea un título válido
        if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,\'!?()_-]{0,100}$/', $_POST['shred-title'])) {
            //Comprobamos si ya tiene un post con ese nombre
            $isRepeated = $model->getUserPostByName($_POST['shred-title'], $_SESSION['user']['id_user']);

            if (!$isRepeated) {
                // Ponemos la imagen por defecto
                $_POST['post_img'] = 'assets/img/cs-logo-color.png';

                // Declaramos el post y obtenemos su id
                $postId = $model->add($_POST);
                if (!is_null($postId)) {
                    // Comprobamos si quiere incluir la imagen
                    $includeImg = isset($_POST['include-img']) && $_POST['include-img'] == 'on';
                    // Procesamos la imagen si existe
                    if (!empty($_POST['post-img-data'] && $includeImg)) {
                        $imageData = $_POST['post-img-data'];
                        $imageData = str_replace('data:image/png;base64,', '', $imageData);
                        $imageData = str_replace(' ', '+', $imageData);
                        $imageData = base64_decode($imageData);

                        // Redimensionamos la imagen (no usar por ahora)
                        $resizedImageData = $this->resizeImage($imageData, 500, 282);

                        $directory = 'assets/img/' . $_POST['user_id'];
                        if (!is_dir($directory)) {
                            mkdir($directory, 0777, true);
                        }

                        // Nombrar el archivo basado en el ID del post
                        $filePath = $directory . '/' . $postId . '.png';

                        if (file_put_contents($filePath, $imageData)) {
                            // Actualiza el post con el nombre de la imagen
                            $model->updateImg($filePath, $postId);
                        }
                    }

                    // Añadir tags al post
                    $model->addTags($_POST);

                    // Creamos una notificación
                    $notificationModel = new \CodeShred\Models\NotificationsModel();
                    $notificationModel->addNotification($_SESSION['user']['id_user'], 'create', 'Shred "' . $_POST['shred-title'] . '" creado.');

                    // Enviamos a la vista de mis posts
                    header('location: /mi-cuenta/mis-posts');
                } else { // Si no se añade
                    // Obtenemos los datos necesarios para la vista
                    $data = $this->fillPostViewData($_POST, 'CodeShred | Shred', '/post/add', 'Error indeterminado al realizar el guardado.');

                    // Rellenamos el título para mandar a la vista
                    $data['post']['post_title'] = filter_input(INPUT_POST, 'shred-title', FILTER_SANITIZE_SPECIAL_CHARS);

                    // Enseñamos la vista de añadir un post
                    $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
                }
            } else {
                // Obtenemos los datos necesarios para la vista
                $data = $this->fillPostViewData($_POST, 'CodeShred | Shred', '/post/add', 'Ya tienes un Shred con ese nombre.');

                // Rellenamos el título para mandar a la vista
                $data['post']['post_title'] = filter_input(INPUT_POST, 'shred-title', FILTER_SANITIZE_SPECIAL_CHARS);

                // Enseñamos la vista de añadir un post
                $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
            }
        } else {
            // Obtenemos los datos necesarios para la vista
            $data = $this->fillPostViewData($_POST, 'CodeShred | Shred', '/post/add', 'El título no permite el uso de ciertos caracteres especiales. Longitud entre 0 y 100 caracteres');

            // Rellenamos el título para mandar a la vista
            $data['post']['post_title'] = filter_input(INPUT_POST, 'shred-title', FILTER_SANITIZE_SPECIAL_CHARS);

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

        // Declaramos la imagen por defecto
        $_POST['post_img'] = 'assets/img/cs-logo-color.png';

        // Comprobamos que sea un título válido
        if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,\'!?()_-]{0,100}$/', $_POST['shred-title'])) {

            //Comprobamos si ya tiene un post con ese nombre
            $isRepeated = $model->getUserPostByName($_POST['shred-title'], $_SESSION['user']['id_user']);

            if (!$isRepeated || $isRepeated['id_post'] == $id) {
                // Almacenamos el post y obtenemos su id
                if ($model->editPost(intval($id), $_POST)) {
                    // Comprobamos si quiere incluir la imagen
                    $includeImg = isset($_POST['include-img']) && $_POST['include-img'] == 'on';
                    // Procesamos la imagen si existe
                    if (!empty($_POST['post-img-data'] && $includeImg)) {
                        $imageData = $_POST['post-img-data'];
                        $imageData = str_replace('data:image/png;base64,', '', $imageData);
                        $imageData = str_replace(' ', '+', $imageData);
                        $imageData = base64_decode($imageData);

                        // Redimensionamos la imagen (no usar por ahora)
                        $resizedImageData = $this->resizeImage($imageData, 500, 282);

                        $directory = 'assets/img/' . $_POST['user_id'];
                        if (!is_dir($directory)) {
                            mkdir($directory, 0777, true);
                        }

                        // Nombrar el archivo basado en el ID del post
                        $filePath = $directory . '/' . $id . '.png';

                        if (file_put_contents($filePath, $imageData)) {
                            // Actualiza el post con el nombre de la imagen
                            $model->updateImg($filePath, intval($id));
                        }
                    }

                    // Creamos una notificación
                    $notificationModel = new \CodeShred\Models\NotificationsModel();
                    $notificationModel->addNotification($_SESSION['user']['id_user'], 'create', 'Shred "' . $_POST['shred-title'] . '" modificado.');

                    // Enviamos a la vista de mis posts
                    header('location: /mi-cuenta/mis-posts');
                } else { // Si no se edita
                    $data = $this->fillPostViewData($_POST, 'CodeShred | Editar Shred', '/post/edit', 'Error indeterminado al realizar el guardado.');

                    // Rellenamos el título y el id del post para mandar a la vista
                    $data['post']['post_title'] = filter_input(INPUT_POST, 'shred-title', FILTER_SANITIZE_SPECIAL_CHARS);
                    $data['post']['id_post'] = $id;

                    // Enseñamos la vista de editar un post
                    $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
                }
            } else {
                // Obtenemos los datos necesarios para la vista
                $data = $this->fillPostViewData($_POST, 'CodeShred | Editar Shred', '/post/edit', 'Ya tienes un Shred con ese nombre.');

                // Rellenamos el título y el id del post para mandar a la vista
                $data['post']['post_title'] = filter_input(INPUT_POST, 'shred-title', FILTER_SANITIZE_SPECIAL_CHARS);
                $data['post']['id_post'] = $id;

                // Enseñamos la vista de editar un post
                $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
            }
        } else {
            // Obtenemos los datos necesarios para la vista
            $data = $this->fillPostViewData($_POST, 'CodeShred | Editar Shred', '/post/edit', 'El título no permite el uso de ciertos caracteres especiales. Longitud entre 0 y 100 caracteres');

            // Rellenamos el título y el id del post para mandar a la vista
            $data['post']['post_title'] = filter_input(INPUT_POST, 'shred-title', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['post']['id_post'] = $id;

            // Enseñamos la vista de editar un post
            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
        }
    }

    /**
     * Método que rellena los datos necesarios para la vista de post.
     * 
     * @param array $post Colección con los datos de los inputs.
     * @param string $title Título de la vista a enseñar.
     * @param string $section Sección a la que pertenece la vista.
     * @param string $notification Texto de la notificación a enseñar.
     * @return array Colección con los datos necesarios para la vista.
     */
    private function fillPostViewData(array $post, string $title, string $section, string $notification): array {
        // Declaramos los datos necesarios de la vista un post
        $data['title'] = $title;
        $data['section'] = $section;
        $data['css'] = 'post';

        // Rellenamos el data para mandar a la vista
        $code = array('html' => $post['shred-html'], 'css' => $post['shred-css'], 'js' => $post['shred-js']);
        $data['post']['post_code'] = json_encode($code);

        // Creamos una notificación con el error
        $notificationModel = new \CodeShred\Models\NotificationsModel();
        $notificationModel->addNotification($_SESSION['user']['id_user'], 'warning', $notification);

        // Devolvemos los datos
        return $data;
    }

    /**
     * Método para ajustar el tamaño de la imagen pasada como parámetro.
     * 
     * @param string $imageData Datos de la imagen.
     * @param int $width Anchura deseada de la imagen.
     * @param int $height Altura deseada de la imagen.
     * @return string Datos de la imagen reajustada.
     */
    private function resizeImage(string $imageData, int $width, int $height): string {
        // Creamos una imagen desde los datos de la imagen
        $src = imagecreatefromstring($imageData);
        if (!$src) {
            throw new Exception('No se pudo crear la imagen desde los datos proporcionados.');
        }

        // Obtenemos las dimensiones de la imagen original
        $srcWidth = imagesx($src);
        $srcHeight = imagesy($src);

        // Calculamos el aspect ratio de la imagen original
        $aspectRatio = $srcWidth / $srcHeight;

        // Calculamos las nuevas dimensiones para mantener el aspect ratio deseado
        if ($width / $height > $aspectRatio) {
            $newWidth = intval(round($height * $aspectRatio));
            $newHeight = intval($height);
        } else {
            $newWidth = intval($width);
            $newHeight = intval(round($width / $aspectRatio));
        }

        // Creamos una nueva imagen con las dimensiones calculadas
        $dst = imagecreatetruecolor($newWidth, $newHeight);
        if (!$dst) {
            throw new Exception('No se pudo crear la nueva imagen.');
        }

        // Redimensionamos la imagen original a la nueva imagen
        if (!imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $srcWidth, $srcHeight)) {
            throw new Exception('Error al redimensionar la imagen.');
        }

        // Obtenemos los datos de la imagen redimensionada como una cadena
        ob_start();
        imagepng($dst);
        $resizedImageData = ob_get_clean();

        // Liberamos memoria
        imagedestroy($src);
        imagedestroy($dst);

        return $resizedImageData;
    }

    /**
     * Método que procesa el borrado del post con el id pasado como parámetro.
     * 
     * @param string $id Número identificativo del post a borrar.
     * @return void
     */
    public function deletePost(string $id): void {
        $model = new \CodeShred\Models\PostsModel();

        // Obtenemos la información del post para obtener la ruta de la imagen
        $post = $model->loadPost(intval($id));

        if ($post) {
            // Intentamos borrar la imagen
            if (file_exists($post['post_img']) && $post['post_img'] != 'assets/img/cs-logo-color.png') {
                unlink($post['post_img']);
            }

            // Borramos el post
            if ($model->deletePost(intval($id))) {
                // Creamos una notificación
                $notificationModel = new \CodeShred\Models\NotificationsModel();
                $notificationModel->addNotification($_SESSION['user']['id_user'], 'delete', 'Shred #' . $id . ' eliminado.');

                // Redirigimos a la vista de mis posts
                header('location: /mi-cuenta/mis-posts');
            } else {
                $data = [];
                // Declaramos los datos necesarios de la vista de editar un post
                $data['title'] = 'CodeShred | Editar Shred';
                $data['section'] = '/post';
                $data['css'] = 'post';

                // Declaramos los errores
                $data['errors']['title'] = filter_input(INPUT_POST, 'shred-title', FILTER_SANITIZE_SPECIAL_CHARS);
                $data['errors']['html'] = $_POST['shred-html'];
                $data['errors']['css'] = $_POST['shred-css'];
                $data['errors']['js'] = $_POST['shred-js'];
                $data['errors']['error'] = 'Error indeterminado al realizar el borrado.';

                // Creamos una notificación
                $notificationModel = new \CodeShred\Models\NotificationsModel();
                $notificationModel->addNotification($_SESSION['user']['id_user'], 'warning', 'Error indeterminado al realizar el borrado.');

                // Mostramos la vista de editar un post
                $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'post.view.php', 'templates/footer.view.php'), $data);
            }
        } else {
            // Si no se encuentra el post, redirigimos con un error
            $notificationModel = new \CodeShred\Models\NotificationsModel();
            $notificationModel->addNotification($_SESSION['user']['id_user'], 'warning', 'El post no existe.');

            header('location: /mi-cuenta/mis-posts');
        }
    }

    /**
     * Método que enseña la view de admin de usuarios.
     * 
     * @return void 
     */
    public function adminPosts(): void {
        // Comprobamos que el rol del usuario de la sesión no sea USER
        if ($_SESSION['user']['user_rol'] != UsersController::USER) {
            $data = [];
            // Declaramos los datos necesarios de la vista de usuarios
            $data['title'] = 'CodeShred - Admin | Shreds';
            $data['section'] = '/admin/posts';
            $data['css'] = 'account';

            // Obtenemos todos los posts del sistema
            $model = new \CodeShred\Models\PostsModel();
            $data['usersPosts'] = $model->getAllAdmin();
            // Enseñamos la vista de usuarios con los datos obtenidos
            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'admin/posts.view.php', 'templates/footer.view.php'), $data);
        } else { // Si es USER
            // Enviamos al inicio
            header('location: /');
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
            // Creamos una notificación
            $notificationModel = new \CodeShred\Models\NotificationsModel();
            $notificationModel->addNotification($_SESSION['user']['id_user'], 'delete', 'Le has quitado el like a un Shred.');
        } else {
            $success = $model->like($userId, $postId);
            // Creamos una notificación
            $notificationModel = new \CodeShred\Models\NotificationsModel();
            $notificationModel->addNotification($_SESSION['user']['id_user'], 'create', 'Le has dado like a un Shred.');
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
        $postImg = '';
        foreach ($userPosts as $userPost) {
            if ($userPost['id_post'] === $postId) {
                $idFromUser = true;
                $postImg = $userPost['post_img'];
            }
        }

        if ($idFromUser || $_SESSION['user']['user_rol'] != UsersController::USER) {
            // Borramos el post
            $isDeleted = $model->deletePost($postId);

            // Intentamos borrar la imagen
            if (file_exists($postImg) && $postImg != 'assets/img/cs-logo-color.png') {
                unlink($postImg);
            }

            // Creamos un log de lo ocurrido
            $logModel = new \CodeShred\Models\LogsModel();
            $action = $isDeleted ? 'deleted' : 'not deleted';
            $logModel->insertLog($action, "El usuario " . $_SESSION['user']['user'] . " ha " . ($isDeleted ? "borrado" : "intentado borrar") . " al post con ID " . $postId . ".", $_SESSION['user']['id_user']);

            // Creamos una notificación
            $notificationModel = new \CodeShred\Models\NotificationsModel();
            $notificationModel->addNotification($_SESSION['user']['id_user'], 'delete', 'Shred #' . $postId . ' eliminado.');

            // Enviamos el resultado al front
            echo json_encode(['success' => $isDeleted, 'action' => $action]);
        } else {
            // Enviamos el resultado al front
            echo json_encode(['success' => false, 'action' => 'Intento de hackeo']);
        }
    }
}
