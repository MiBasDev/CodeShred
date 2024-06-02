<?php

declare(strict_types=1);

namespace CodeShred\Controllers;

class ErrorsController extends \CodeShred\Core\BaseController {

    /**
     * Método que maneja el error 404.
     * 
     * @return void
     */
    function error404(): void {
        http_response_code(404);
        // Declaramos los datos necesarios de la vista de inicio de la página
        $data = [];
        $data['title'] = 'CodeShred | Error 404';
        $data['section'] = '/error404';
        $data['text'] = '¡Oups! Hemos buscado en 404 Shreds pero no hemos encontrado lo que estabas buscando...';
        $data['text2'] = 'Quizás te interese alguno de estos Shreds:';
        $data['css'] = 'error';

        // Obtenemos los posts destacados
        $model = new \CodeShred\Models\PostsModel();
        $data['posts'] = $model->getAllIndex();

        // Enseñamos la vista de error
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'error.view.php', 'templates/footer.view.php'), $data);
    }

    /**
     * Método que maneja el error 405.
     * 
     * @return void
     */
    function error405(): void {
        http_response_code(405);
        // Declaramos los datos necesarios de la vista de inicio de la página
        $data = [];
        $data['title'] = 'CodeShred | Error 405';
        $data['section'] = '/error405';
        $data['text'] = '405. Method not allowed';
        $data['text2'] = 'Quizás te interese alguno de estos Shreds:';
        $data['css'] = 'error';

        // Enseñamos la vista de error
        $this->view->showViews(array('templates/header.view.php', 'templates/aside.view.php', 'error.view.php', 'templates/footer.view.php'), $data);
    }
}
