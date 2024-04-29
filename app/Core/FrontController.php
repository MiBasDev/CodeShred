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
                    $controlador->showAll();
                }
                , 'get');

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

        Route::add('/politica-de-privacidad',
                function () {
                    $controlador = new \CodeShred\Controllers\InicioController();
                    $controlador->privacy();
                }
                , 'get');

        Route::add('/politica-de-cookies',
                function () {
                    $controlador = new \CodeShred\Controllers\InicioController();
                    $controlador->cookies();
                }
                , 'get');
        Route::add('/post/([0-9]+)',
                function ($id) {
                    $controlador = new \CodeShred\Controllers\PostsController();
                    $controlador->show($id);
                }
                , 'get');

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
                        $controlador->register();
                    }
                    , 'get');

            Route::add('/registro',
                    function () {
                        $controlador = new \CodeShred\Controllers\UsuarioController();
                        $controlador->registerProcess();
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

            Route::add('/post/add',
                    function () {
                        $controlador = new \CodeShred\Controllers\PostsController();
                        $controlador->showAdd();
                    }
                    , 'get');

            Route::add('/post/add',
                    function () {
                        $controlador = new \CodeShred\Controllers\PostsController();
                        $controlador->processAdd();
                    }
                    , 'post');

            Route::add('/post/edit/([0-9]+)',
                    function ($id) {
                        $controlador = new \CodeShred\Controllers\PostsController();
                        $controlador->showEdit($id);
                    }
                    , 'get');

            Route::add('/post/edit/([0-9]+)',
                    function ($id) {
                        $controlador = new \CodeShred\Controllers\PostsController();
                        $controlador->processEdit($id);
                    }
                    , 'post');

            Route::add('/post/delete/([0-9]+)',
                    function ($id) {
                        $controlador = new \CodeShred\Controllers\PostsController();
                        $controlador->deletePost($id);
                    }
                    , 'post');

            Route::add('/mi-cuenta/mis-posts',
                    function () {
                        $controlador = new \CodeShred\Controllers\PostsController();
                        $controlador->showMyPosts();
                    }
                    , 'get');

            Route::add('/mi-cuenta/mis-posts',
                    function () {
                        $controlador = new \CodeShred\Controllers\PostsController();
                        $controlador->edit();
                    }
                    , 'post');

            Route::add('/siguiendo',
                    function () {
                        $controlador = new \CodeShred\Controllers\UsuarioController();
                        $controlador->showFollowing();
                    }
                    , 'get');

            Route::add('/siguiendo',
                    function () {
                        $controlador = new \CodeShred\Controllers\UsuarioController();
                        $controlador->mostrar();
                    }
                    , 'post');

            Route::add('/usuarios',
                    function () {
                        $controlador = new \CodeShred\Controllers\UsuarioController();
                        $controlador->showAll();
                    }
                    , 'get');

            Route::add('/usuarios',
                    function () {
                        $controlador = new \CodeShred\Controllers\UsuarioController();
                        $controlador->mostar();
                    }
                    , 'post');

            Route::add('/mi-cuenta',
                    function () {
                        $controlador = new \CodeShred\Controllers\UsuarioController();
                        $controlador->myAccount();
                    }
                    , 'get');

            Route::add('/mi-cuenta',
                    function () {
                        $controlador = new \CodeShred\Controllers\UsuarioController();
                        $controlador->myAccountProcess();
                    }
                    , 'post');

            Route::add('/user-follow',
                    function () {
                        $controlador = new \CodeShred\Controllers\UsuarioController();
                        $controlador->followProcess();
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
