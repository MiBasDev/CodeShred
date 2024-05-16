<?php

namespace CodeShred\Core;

use Steampixel\Route;

class FrontController {

    /**
     * Método que controla los endpoints de las rutas.
     */
    static function main() {
        // Iniciamos la sesión
        session_start();

        Route::add('/',
                function () {
                    $controller = new \CodeShred\Controllers\InitController();
                    $controller->index();
                }
                , 'get');

        Route::add('/posts',
                function () {
                    $controller = new \CodeShred\Controllers\PostsController();
                    $controller->showAll();
                }
                , 'get');

        Route::add('/contacto',
                function () {
                    $controller = new \CodeShred\Controllers\InitController();
                    $controller->contact();
                }
                , 'get');

        Route::add('/contacto',
                function () {
                    $controller = new \CodeShred\Controllers\InitController();
                    $controller->contactForm();
                }
                , 'post');

        Route::add('/politica-de-privacidad',
                function () {
                    $controller = new \CodeShred\Controllers\InitController();
                    $controller->privacy();
                }
                , 'get');

        Route::add('/politica-de-cookies',
                function () {
                    $controller = new \CodeShred\Controllers\InitController();
                    $controller->cookies();
                }
                , 'get');
        Route::add('/post/([0-9]+)',
                function ($id) {
                    $controller = new \CodeShred\Controllers\PostsController();
                    $controller->show($id);
                }
                , 'get');

        // Si no existe un usuario de sesión
        if (!isset($_SESSION['user'])) {
            Route::add('/login',
                    function () {
                        $controller = new \CodeShred\Controllers\UsersController();
                        $controller->login();
                    }
                    , 'get');

            Route::add('/login',
                    function () {
                        $controller = new \CodeShred\Controllers\UsersController();
                        $controller->loginProcess();
                    }
                    , 'post');
            Route::add('/registro',
                    function () {
                        $controller = new \CodeShred\Controllers\UsersController();
                        $controller->register();
                    }
                    , 'get');

            Route::add('/registro',
                    function () {
                        $controller = new \CodeShred\Controllers\UsersController();
                        $controller->registerProcess();
                    }
                    , 'post');
            Route::pathNotFound(
                    function () {
                        header('location: /');
                    }
            );
        } else { // Si existe un usuario de sesión
            Route::add('/logout',
                    function () {
                        $controller = new \CodeShred\Controllers\UsersController();
                        $controller->logout();
                    }
                    , 'get');

            Route::add('/post/add',
                    function () {
                        $controller = new \CodeShred\Controllers\PostsController();
                        $controller->showAdd();
                    }
                    , 'get');

            Route::add('/post/add',
                    function () {
                        $controller = new \CodeShred\Controllers\PostsController();
                        $controller->processAdd();
                    }
                    , 'post');

            Route::add('/post/edit/([0-9]+)',
                    function ($id) {
                        $controller = new \CodeShred\Controllers\PostsController();
                        $controller->showEdit($id);
                    }
                    , 'get');

            Route::add('/post/edit/([0-9]+)',
                    function ($id) {
                        $controller = new \CodeShred\Controllers\PostsController();
                        $controller->processEdit($id);
                    }
                    , 'post');

            Route::add('/post/delete/([0-9]+)',
                    function ($id) {
                        $controller = new \CodeShred\Controllers\PostsController();
                        $controller->deletePost($id);
                    }
                    , 'post');

            Route::add('/mi-cuenta/mis-posts',
                    function () {
                        $controller = new \CodeShred\Controllers\PostsController();
                        $controller->showMyPosts();
                    }
                    , 'get');

            Route::add('/siguiendo',
                    function () {
                        $controller = new \CodeShred\Controllers\UsersController();
                        $controller->showFollowing();
                    }
                    , 'get');

            Route::add('/usuarios',
                    function () {
                        $controller = new \CodeShred\Controllers\UsersController();
                        $controller->showAll();
                    }
                    , 'get');

            Route::add('/mi-cuenta',
                    function () {
                        $controller = new \CodeShred\Controllers\UsersController();
                        $controller->myAccount();
                    }
                    , 'get');

            Route::add('/mi-cuenta/([0-9]+)',
                    function ($id) {
                        $controller = new \CodeShred\Controllers\UsersController();
                        $controller->myAccountDelete($id);
                    }
                    , 'post');

            if ($_SESSION['user']['user_rol'] != \CodeShred\Controllers\UsersController::USER) {
                Route::add('/admin/posts',
                        function () {
                            $controller = new \CodeShred\Controllers\PostsController();
                            $controller->adminPosts();
                        }
                        , 'get');
                if ($_SESSION['user']['user_rol'] == \CodeShred\Controllers\UsersController::ADMIN) {
                    Route::add('/admin/users',
                            function () {
                                $controller = new \CodeShred\Controllers\UsersController();
                                $controller->adminUsers();
                            }
                            , 'get');

                    Route::add('/tickets',
                            function () {
                                $controller = new \CodeShred\Controllers\TicketsController();
                                $controller->showTickets();
                            }
                            , 'get');
                }
            }

            // Rutas de AJAX
            Route::add('/update-description',
                    function () {
                        $controller = new \CodeShred\Controllers\UsersController();
                        $controller->updateDescription();
                    }
                    , 'post');

            Route::add('/user-follow',
                    function () {
                        $controller = new \CodeShred\Controllers\UsersController();
                        $controller->followProcess();
                    }
                    , 'post');

            Route::add('/post-like',
                    function () {
                        $controller = new \CodeShred\Controllers\PostsController();
                        $controller->likeProcess();
                    }
                    , 'post');

            Route::add('/post-delete',
                    function () {
                        $controller = new \CodeShred\Controllers\PostsController();
                        $controller->tablePostDeleteProcess();
                    }
                    , 'post');

            Route::add('/user-delete',
                    function () {
                        $controller = new \CodeShred\Controllers\UsersController();
                        $controller->tableUserDeleteProcess();
                    }
                    , 'post');

            Route::add('/update-user-data',
                    function () {
                        $controller = new \CodeShred\Controllers\UsersController();
                        $controller->updateUserData();
                    }
                    , 'post');

            Route::add('/ticket-delete',
                    function () {
                        $controller = new \CodeShred\Controllers\TicketsController();
                        $controller->deleteTicket();
                    }
                    , 'post');

            Route::add('/ticket-resolve',
                    function () {
                        $controller = new \CodeShred\Controllers\TicketsController();
                        $controller->resolveTicket();
                    }
                    , 'post');

            Route::pathNotFound(
                    function () {
                        $controller = new \CodeShred\Controllers\ErrorsController();
                        $controller->error404();
                    }
            );

            Route::methodNotAllowed(
                    function () {
                        $controller = new \CodeShred\Controllers\ErrorsController();
                        $controller->error405();
                    }
            );
        }

        // Runemaos la ruta
        Route::run();
    }
}
