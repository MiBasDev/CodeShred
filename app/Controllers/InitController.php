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
        $data['title'] = 'codeShred | Inicio';
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
        $data['title'] = 'codeShred | Contacto';
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
        $data['title'] = 'codeShred | Contacto';
        $data['section'] = '/contacto';
        $data['css'] = 'contact';

        // Enseñamos la vista de contacto
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'contact.view.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Método que enseña la vista de política de privacidad.
     * 
     * @return void
     */
    public function privacy(): void {
        $data = [];
        // Declaramos los datos necesarios de la vista de política de privacidad
        $data['title'] = 'codeShred | Política de privacidad';
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
        $data['title'] = 'codeShred | Política de cookies';
        $data['section'] = '/politica-de-cookies';
        $data['css'] = 'cookies';

        // Enseñamos la vista de política de cookies
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'cookies.view.php', 'templates/footer.view.php'), $data);
    }
}
