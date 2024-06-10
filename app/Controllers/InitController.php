<?php

namespace CodeShred\Controllers;

class InitController extends \CodeShred\Core\BaseController {

    /**
     * Método que enseña la vista de inicio de la paǵina.
     * 
     * @return void
     */
    public function index(): void {
        $data = [];
        // Declaramos los datos necesarios de la vista de inicio de la página
        $data['title'] = 'CodeShred | Inicio';
        $data['section'] = '/';
        $data['css'] = 'index';

        // Obtenemos los posts
        $model = new \CodeShred\Models\PostsModel();
        $data['posts'] = $model->getAllIndex();

        // Enseñamos la vista del index
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'index.view.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Método que enseña la vista de contacto.
     * 
     * @return void
     */
    public function contact(): void {
        $data = [];
        // Declaramos los datos necesarios de la vista de contacto
        $data['title'] = 'CodeShred | Contacto';
        $data['section'] = '/contacto';
        $data['css'] = 'contact';

        // Enseñamos la vista de contacto
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'contact.view.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Método que procesa el formulario de la vista de contacto.
     * 
     * @return void
     */
    public function contactForm(): void {
        $data = [];
        // Declaramos los datos necesarios de la vista de contacto
        $data['title'] = 'CodeShred | Contacto';
        $data['section'] = '/contacto';
        $data['css'] = 'contact';

        $errors = [];
        if (!isset($_SESSION['user'])) {
            // Input email
            if (isset($_POST['email']) && !empty($_POST['email'])) {
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = 'El email es incorrecto';
                }
            } else {
                $errors['email'] = 'Campo obligatorio';
            }

            // Input name
            if (isset($_POST['name'])) {
                if (!empty($_POST['name'])) {
                    if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ ]{2,20}$/', $_POST['name'])) {
                        $errors['name'] = 'El nombre sólo permite letras y espacios. Longitud entre 2 y 20 caracteres';
                    }
                } else {
                    $errors['name'] = 'Campo obligatorio';
                }
            }

            // Input surname
            if (isset($_POST['surname'])) {
                if (!empty($_POST['surname'])) {
                    if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ ]{2,80}$/', $_POST['surname'])) {
                        $errors['surname'] = 'Los apellidos sólo permiten letras y espacios. Longitud entre 2 y 80 caracteres';
                    }
                } else {
                    $errors['surname'] = 'Campo obligatorio';
                }
            }
        }

        // Input subject
        if (isset($_POST['subject']) && !empty($_POST['subject'])) {
            if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,\'!?()_-]{5,50}$/', $_POST['subject'])) {
                $errors['subject'] = 'El asunto no permite el uso de ciertos caracteres especiales. Longitud entre 5 y 50 caracteres';
            }
        } else {
            $errors['subject'] = 'Campo obligatorio';
        }

        // Input message
        if (isset($_POST['message']) && !empty($_POST['message'])) {
            if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,\'!?()_-]{5,255}$/', $_POST['message'])) {
                $errors['message'] = 'El mensaje no permite el uso de ciertos caracteres especiales. Longitud entre 5 y 255 caracteres';
            }
        } else {
            $errors['message'] = 'Campo obligatorio';
        }

        if (count($errors) == 0) {
            if (isset($_SESSION['user'])) {
                $_POST['email'] = $_SESSION['user']['user_email'];
            }
            // Obtenemos los posts
            $model = new \CodeShred\Models\TicketsModel();
            if ($model->createTicket($_POST)) {
                if ($_SESSION['user']) {
                    // Creamos una notificación
                    $notificationModel = new \CodeShred\Models\NotificationsModel();
                    $notificationModel->addNotification(intval($_SESSION['user']['id_user']), 'ticket', 'Has enviado un ticket.');
                }
                // Enviamos al inicio
                header('location: /');
            } else {
                $data['errors']['message'] = 'Error indeterminado al enviar el formulario.';
                // Saneamos los datos recibidos
                $data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
                $data['surname'] = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_SPECIAL_CHARS);
                $data['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $data['subject'] = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_SPECIAL_CHARS);
                $data['message'] = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);

                // Enseñamos la vista de contacto
                $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'contact.view.php', 'templates/footer.view.php'), $data);
            }
        } else {
            $data['errors'] = $errors;
            // Saneamos los datos recibidos
            $data['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['surname'] = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $data['subject'] = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_SPECIAL_CHARS);
            $data['message'] = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);

            // Enseñamos la vista de contacto
            $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'contact.view.php', 'templates/footer.view.php'), $data);
        }
    }

    /**
     * Método que enseña la vista de política de privacidad.
     * 
     * @return void
     */
    public function privacy(): void {
        $data = [];
        // Declaramos los datos necesarios de la vista de política de privacidad
        $data['title'] = 'CodeShred | Política de privacidad';
        $data['section'] = '/politica-de-privacidad';
        $data['css'] = 'privacity';

        // Enseñamos la vista de política de privacidad
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'privacity.view.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Método que enseña la vista de política de cookies.
     * 
     * @return void
     */
    public function cookies(): void {
        $data = [];
        // Declaramos los datos necesarios de la vista de política de cookies
        $data['title'] = 'CodeShred | Política de cookies';
        $data['section'] = '/politica-de-cookies';
        $data['css'] = 'cookies';

        // Enseñamos la vista de política de cookies
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'cookies.view.php', 'templates/footer.view.php'), $data);
    }
}
