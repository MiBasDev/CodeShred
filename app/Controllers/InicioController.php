<?php

namespace CodeShred\Controllers;

class InicioController extends \CodeShred\Core\BaseController {

    public function index() {
        $data = [];
        $data['title'] = 'codeShred | Inicio';
        $data['section'] = '/';
        
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'inicio.view.php', 'templates/footer.view.php'), $data);
    }
}
