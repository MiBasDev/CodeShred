<?php

namespace CodeShred\Core;

use Steampixel\Route;

class FrontController {

    static function main() {
        session_start();

        if (!isset($_SESSION['usuario'])) {
            Route::add('/login',
                    function () {
                        $controlador = new \CodeShred\Controllers\UsuarioController();
                        $controlador->login();
                    }
                    , 'get');

            Route::add('/login',
                    function () {
                        $controlador = new \CodeShred\Controllers\UsuarioController();
                        $controlador->loginProcess();
                    }
                    , 'post');
            Route::add('/registro',
                    function () {
                        $controlador = new \CodeShred\Controllers\UsuarioController();
                        $controlador->registro();
                    }
                    , 'get');

            Route::add('/registro',
                    function () {
                        $controlador = new \CodeShred\Controllers\UsuarioController();
                        $controlador->loginProcess();
                    }
                    , 'post');
            Route::add('/',
                    function () {
                        $controlador = new \CodeShred\Controllers\InicioController();
                        $controlador->index();
                    }
                    , 'get');
            Route::pathNotFound(
                    function () {
                        header('location: /');
                    }
            );
        } else {
            Route::add('/login',
                    function () {
                        $controlador = new \CodeShred\Controllers\InicioController();
                        $controlador->login();
                    }
                    , 'get');

            Route::add('/post',
                    function () {
                        $controlador = new \CodeShred\Controllers\PostsController();
                        $controlador->mostrar();
                    }
                    , 'get');

            Route::add('/mi-cuenta/mis-posts',
                    function () {
                        $controlador = new \CodeShred\Controllers\ProveedorController();
                        $controlador->mostrarEdit();
                    }
                    , 'get');

            Route::add('/mi-cuenta/mis-posts',
                    function () {
                        $controlador = new \CodeShred\Controllers\ProveedorController();
                        $controlador->edit();
                    }
                    , 'post');

            Route::add('/siguiendo',
                    function () {
                        $controlador = new \CodeShred\Controllers\ProveedorController();
                        $controlador->mostrar();
                    }
                    , 'get');

            Route::add('/siguiendo',
                    function () {
                        $controlador = new \CodeShred\Controllers\ProveedorController();
                        $controlador->mostrar();
                    }
                    , 'post');

            Route::add('/usuarios',
                    function () {
                        $controlador = new \CodeShred\Controllers\UsuariosController();
                        $controlador->mostrar();
                    }
                    , 'get');

            Route::add('/usuarios',
                    function () {
                        $controlador = new \CodeShred\Controllers\UsuariosController();
                        $controlador->mostar();
                    }
                    , 'post');

            Route::pathNotFound(
                    function () {
                        $controller = new \CodeShred\Controllers\ErroresController();
                        $controller->error404();
                    }
            );

            Route::methodNotAllowed(
                    function () {
                        $controller = new \CodeShred\Controllers\ErroresController();
                        $controller->error405();
                    }
            );
        }

        Route::run();
    }
}
