<?php

namespace CodeShred\Core;

use Steampixel\Route;

class FrontController {

    static function main() {
        session_start();

        Route::add('/',
                function () {
                    $controlador = new \CodeShred\Controllers\InicioController();
                    $controlador->index();
                }
                , 'get');

        Route::add('/posts',
                function () {
                    $controlador = new \CodeShred\Controllers\PostsController();
                    $controlador->mostrarTodos();
                }
                , 'get');

        Route::add('/posts',
                function () {
                    $controlador = new \CodeShred\Controllers\PostsController();
                    $controlador->registroProcess();
                }
                , 'post');

        Route::add('/contacto',
                function () {
                    $controlador = new \CodeShred\Controllers\InicioController();
                    $controlador->contact();
                }
                , 'get');

        Route::add('/contacto',
                function () {
                    $controlador = new \CodeShred\Controllers\InicioController();
                    $controlador->contactForm();
                }
                , 'post');

        if (!isset($_SESSION['user'])) {
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
                        $controlador->registroProcess();
                    }
                    , 'post');
            Route::pathNotFound(
                    function () {
                        header('location: /');
                    }
            );
        } else {
            Route::add('/logout',
                    function () {
                        $controlador = new \CodeShred\Controllers\UsuarioController();
                        $controlador->logout();
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
