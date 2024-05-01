<?php

declare(strict_types=1);

namespace CodeShred\Controllers;

class ErrorsController extends \CodeShred\Core\BaseController {

    function error404(): void {
        http_response_code(404);
        $data = ['title' => 'Error 404'];
        $data['text'] = '404. File not found';
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'error.php', 'templates/footer.view.php'), $data);
    }

    function error405(): void {
        http_response_code(405);
        $data = ['$model' => 'Error 405'];
        $data['text'] = '405. Method not allowed';

        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'error.php', 'templates/footer.view.php'), $data);
    }
}
