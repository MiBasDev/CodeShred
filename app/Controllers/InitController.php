<?php

namespace CodeShred\Controllers;

class InitController extends \CodeShred\Core\BaseController {

    public function index(): void {
        $data = [];
        $data['title'] = 'codeShred | Inicio';
        $data['section'] = '/';
        
        $model = new \CodeShred\Models\PostsModel();
        $data['posts'] = $model->getAllIndex();
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'index.view.php', 'templates/footer.view.php'), $data);
    }

    public function contact(): void {
        $data = [];
        $data['title'] = 'codeShred | Contacto';
        $data['section'] = '/contacto';

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'contact.view.php', 'templates/footer.view.php'), $data);
    }

    public function contactForm(): void {
        $data = [];
        $data['title'] = 'codeShred | Contacto';
        $data['section'] = '/contacto';

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'contacto.view.php', 'templates/footer.view.php'), $data);
    }

    public function privacy(): void {
        $data = [];
        $data['title'] = 'codeShred | Política de privacidad';
        $data['section'] = '/politica-de-privacidad';

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'privacity.view.php', 'templates/footer.view.php'), $data);
    }

    public function cookies(): void {
        $data = [];
        $data['title'] = 'codeShred | Política de cookies';
        $data['section'] = '/politica-de-cookies';

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'cookies.view.php', 'templates/footer.view.php'), $data);
    }
}
