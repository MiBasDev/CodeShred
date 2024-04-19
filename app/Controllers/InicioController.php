<?php

namespace CodeShred\Controllers;

class InicioController extends \CodeShred\Core\BaseController {

    public function index() {
        $data = [];
        $data['title'] = 'codeShred | Inicio';
        $data['section'] = '/';

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'inicio.view.php', 'templates/footer.view.php'), $data);
    }

    public function contact() {
        $data = [];
        $data['title'] = 'codeShred | Contacto';
        $data['section'] = '/contacto';

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'contacto.view.php', 'templates/footer.view.php'), $data);
    }

    public function contactForm() {
        $data = [];
        $data['title'] = 'codeShred | Contacto';
        $data['section'] = '/contacto';

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'contacto.view.php', 'templates/footer.view.php'), $data);
    }
}
