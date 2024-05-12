<?php

declare(strict_types=1);

namespace CodeShred\Controllers;

class ErrorsController extends \CodeShred\Core\BaseController {

    /**
     * Método que controla el error 404.
     * 
     * @return void
     */
    function error404(): void {
        http_response_code(404);
        $data = [];
        $data['title'] = 'Error 404';
        $data['section'] = '/error404';
        $data['text'] = '404. File not found';
        $data['css'] = 'error';

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'error.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Método que controla el error 405.
     * 
     * @return void
     */
    function error405(): void {
        http_response_code(405);
        $data = [];
        $data['title'] = 'Error 404';
        $data['section'] = '/error404';
        $data['text'] = '405. Method not allowed';
        $data['css'] = 'error';

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'error.php', 'templates/footer.view.php'), $data);
    }
}
