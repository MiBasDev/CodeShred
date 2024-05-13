<!--Main-->
<main class="cs-fl-col cs-fl-just-c cs-fl-align-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="my-account-container cs-fl">
        <?php if ($_SESSION['user']['user_rol'] != CodeShred\Controllers\UsersController::ADMIN) { ?>
            <div class="my-account-data cs-fl-col cs-fl-just-c cs-fl-align-c">
                <h1>Hola, <?php echo $userData['user']; ?> <i class="fas fa-smile-beam"></i></h1>
                <span class="fa fa-user my-account-data-logo"></span>
                <div class="my-account-data-description cs-fl-col">
                    <label for="user-description">Sobre mí:</label>
                    <textarea name="user-description" id="user-description" rows="6" class="contact-form-textarea" length="255" placeholder="Pequeña descripción sobre ti..."><?php echo isset($userData) && !empty($userData['user_description']) ? $userData['user_description'] : ''; ?></textarea>
                </div>
                <div class="my-account-data-buttons cs-fl">
                    <button class="button-secondary" id="update-description">Guardar descripción</button>
                </div>
            </div>
        <?php } ?>
        <div class="my-account-tab <?php echo $_SESSION['user']['user_rol'] == CodeShred\Controllers\UsersController::USER ? '' : 'admin'; ?>">
            <div class="tab <?php
            if ($_SESSION['user']['user_rol'] == CodeShred\Controllers\UsersController::ADMIN) {
                echo 'admin';
            } elseif ($_SESSION['user']['user_rol'] == CodeShred\Controllers\UsersController::MOD) {
                echo 'mod';
            }
            ?>">
                     <?php if ($_SESSION['user']['user_rol'] != CodeShred\Controllers\UsersController::ADMIN) { ?>
                    <button class="tablinks" onclick="openTabOption(event, 'mis-shreds')">Mis Shreds</button>
                    <button class="tablinks" onclick="openTabOption(event, 'likes')">Likes</button>
                    <button class="tablinks" onclick="openTabOption(event, 'cuentas-seguidas')">Cuentas seguidas</button>
                    <?php if ($_SESSION['user']['user_rol'] == CodeShred\Controllers\UsersController::MOD) { ?>
                        <button class="tablinks" onclick="openTabOption(event, 'todos-los-shreds')">Shreds</button>
                    <?php } ?>
                <?php } else { ?>
                    <button class="tablinks" onclick="openTabOption(event, 'todos-los-shreds')">Shreds</button>
                    <button class="tablinks" onclick="openTabOption(event, 'todos-los-usuarios')">Usuarios</button>
                <?php } ?>
                <button class="tablinks" onclick="openTabOption(event, 'configuracion')" id="defaultOpen">Configuración</button>
            </div>
            <?php if ($_SESSION['user']['user_rol'] != CodeShred\Controllers\UsersController::ADMIN) { ?>
                <!--Mis Shreds-->
                <div id="mis-shreds" class="tabcontent">
                    <table class="my-account-table">
                        <thead>
                            <tr>
                                <td>TÍTULO</td>                           
                                <td><span class="fa fa-eye"></span></td>                            
                                <td><span class="fa fa-heart"></span></td>
                                <td>CONTROL</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($userPosts) && !empty($userPosts)) {
                                foreach ($userPosts as $post) {
                                    ?>
                                    <tr id="my-account-table-post-<?php echo $post['id_post']; ?>">
                                        <td>
                                            <a href = "/post/<?php echo $post['id_post']; ?>">
                                                <?php echo $post['post_title'] ?><?php echo isset($post['post_title']) && !empty($post['post_title']) ? $post['post_title'] : '<i>Shred de ' . $post['user'] . '</i>'; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php echo $post['views'] ?>
                                        </td>
                                        <td>
                                            <?php echo $post['total_likes'] ?>
                                        </td>
                                        <td>
                                            <div class="cs-fl cs-fl-just-c cs-fl-align-c my-account-table-buttons">
                                                <button class="button-warning button-my-account-post-delete" onclick="openDeletePopup(<?php echo $post['id_post']; ?>)" title="Eliminar shred"><span class="fas fa-trash-alt"></span></button>
                                                <a href="/post/edit/<?php echo $post['id_post']; ?>" class="button-secondary button-my-account-post-edit" id="button-my-account-post-edit-<?php echo $post['id_post']; ?>" title="Editar shred"><span class="far fa-edit"></span></a>
                                                <a href="/post/<?php echo $post['id_post']; ?>" class="button-primary button-my-account-post-view" id="button-my-account-post-view-<?php echo $post['id_post']; ?>" title="Editar shred"><span class="fa fa-eye"></span></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="4">Todavía no has creado ningún Shred.</td>
                                </tr>
                                <?php
                            }
                            ?>
                        <tbody>
                    </table>
                    <?php if (count($userPosts) > 8) { ?>
                        <div class="pagination-buttons cs-fl cs-fl-align-c">
                            <div>
                                <button onclick="previousPage(0)" class="button-secondary prev"><span class="fas fa-angle-left"></span></button>
                            </div>
                            <div>
                                <button onclick="nextPage(0)" class="button-secondary next"><span class="fas fa-angle-right"></span></button>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <!--Likes-->
                <div id="likes" class="tabcontent">
                    <table class="my-account-table">
                        <thead>
                            <tr>
                                <td>SHRED</td>                           
                                <td>USUARIO</td>
                                <td>CONTROL</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($userLikedPosts) && !empty($userLikedPosts)) {
                                foreach ($userLikedPosts as $post) {
                                    ?>
                                    <tr>
                                        <td>
                                            <a href = "/post/<?php echo $post['id_post']; ?>" title="Ir al Shred '<?php echo $post['post_title'] ?>'">
                                                <?php echo isset($post['post_title']) && !empty($post['post_title']) ? $post['post_title'] : '<i>Shred de ' . $post['user'] . '</i>'; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php echo $post['user'] ?>
                                        </td>
                                        <td>
                                            <button class="post-like post-like-tab" id="post-like-<?php echo $post['id_post']; ?>">
                                                <span class="fa fa-heart post-liked"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="3">No le has dado like a ningún Shred.</td>
                                </tr>
                                <?php
                            }
                            ?>
                        <tbody>
                    </table>
                    <?php if (count($userLikedPosts) > 8) { ?>
                        <div class="pagination-buttons cs-fl cs-fl-align-c">
                            <div>
                                <button onclick="previousPage(1)" class="button-secondary prev"><span class="fas fa-angle-left"></span></button>
                            </div>
                            <div>
                                <button onclick="nextPage(1)" class="button-secondary next"><span class="fas fa-angle-right"></span></button>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <!--Cuentas seguidas-->
                <div id="cuentas-seguidas" class="tabcontent">
                    <table class="my-account-table">
                        <thead>
                            <tr>
                                <td>USUARIO</td>                           
                                <td>DESCRIPCIÓN</td>
                                <td>CONTROL</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($userFollowing) && !empty($userFollowing)) {
                                foreach ($userFollowing as $user) {
                                    ?>
                                    <tr>
                                        <td>
                                            <a href = "/siguiendo">
                                                <?php echo $user['user'] ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php echo!empty($user['user_description']) ? $user['user_description'] : '<i>Este usuario todavía no ha puesto una descripción D:</i>'; ?>
                                        </td>
                                        <td>
                                            <button class="user-follow button-success" id="user-<?php echo $user['id_user']; ?>" data="<?php echo $user['user']; ?>">
                                                <span class="fas fa-user-check"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="3">No sigues a ningún usuario.</td>
                                </tr>
                                <?php
                            }
                            ?>
                        <tbody>
                    </table>
                    <?php if (count($userFollowing) > 8) { ?>
                        <div class="pagination-buttons cs-fl cs-fl-align-c">
                            <div>
                                <button onclick="previousPage(2)" class="button-secondary prev"><span class="fas fa-angle-left"></span></button>
                            </div>
                            <div>
                                <button onclick="nextPage(2)" class="button-secondary next"><span class="fas fa-angle-right"></span></button>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <?php if ($_SESSION['user']['user_rol'] == CodeShred\Controllers\UsersController::MOD) { ?>
                    <div id="todos-los-shreds" class="tabcontent">
                        <table class="my-account-table">
                            <thead>
                                <tr>
                                    <td>TÍTULO</td>                           
                                    <td>USUARIO</td>
                                    <td>CONTROL</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($usersPosts) && !empty($usersPosts)) {
                                    foreach ($usersPosts as $post) {
                                        ?>
                                        <tr id="my-account-table-post-<?php echo $post['id_post']; ?>">
                                            <td>
                                                <a href = "/post/<?php echo $post['id_post']; ?>">
                                                    <?php echo isset($post['post_title']) && !empty($post['post_title']) ? $post['post_title'] : '<i>Shred de ' . $post['user'] . '</i>'; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo $post['user'] ?>
                                            </td>
                                            <td>
                                                <div class="cs-fl cs-fl-just-c cs-fl-align-c my-account-table-buttons">
                                                    <button class="button-warning button-my-account-post-delete" onclick="openDeletePopup(<?php echo $post['id_post']; ?>)" title="Eliminar shred"><span class="fas fa-trash-alt"></span></button>
                                                    <a href="/post/edit/<?php echo $post['id_post']; ?>" class="button-secondary button-my-account-post-edit" id="button-my-account-post-edit-<?php echo $post['id_post']; ?>" title="Editar shred"><span class="far fa-edit"></span></a>
                                                    <a href="/post/<?php echo $post['id_post']; ?>" class="button-primary button-my-account-post-view" id="button-my-account-post-view-<?php echo $post['id_post']; ?>" title="Editar shred"><span class="fa fa-eye"></span></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="4">Todavía no hay ningún shred.</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            <tbody>
                        </table>
                        <?php if (count($usersPosts) > 8) { ?>
                            <div class="pagination-buttons cs-fl cs-fl-align-c">
                                <div>
                                    <button onclick="previousPage(3)" class="button-secondary prev"><span class="fas fa-angle-left"></span></button>
                                </div>
                                <div>
                                    <button onclick="nextPage(3)" class="button-secondary next"><span class="fas fa-angle-right"></span></button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <!--Mis Shreds-->
                <div id="todos-los-shreds" class="tabcontent">
                    <table class="my-account-table">
                        <thead>
                            <tr>
                                <td>TÍTULO</td>                           
                                <td>USUARIO</td>
                                <td>CONTROL</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($usersPosts) && !empty($usersPosts)) {
                                foreach ($usersPosts as $post) {
                                    ?>
                                    <tr id="my-account-table-post-<?php echo $post['id_post']; ?>">
                                        <td>
                                            <a href = "/post/<?php echo $post['id_post']; ?>">
                                                <?php echo isset($post['post_title']) && !empty($post['post_title']) ? $post['post_title'] : '<i>Shred de ' . $post['user'] . '</i>'; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php echo $post['user'] ?>
                                        </td>
                                        <td>
                                            <div class="cs-fl cs-fl-just-c cs-fl-align-c my-account-table-buttons">
                                                <button class="button-warning button-my-account-post-delete" onclick="openDeletePopup(<?php echo $post['id_post']; ?>)" title="Eliminar shred"><span class="fas fa-trash-alt"></span></button>
                                                <a href="/post/edit/<?php echo $post['id_post']; ?>" class="button-secondary button-my-account-post-edit" id="button-my-account-post-edit-<?php echo $post['id_post']; ?>" title="Editar shred"><span class="far fa-edit"></span></a>
                                                <a href="/post/<?php echo $post['id_post']; ?>" class="button-primary button-my-account-post-view" id="button-my-account-post-view-<?php echo $post['id_post']; ?>" title="Editar shred"><span class="fa fa-eye"></span></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="4">Todavía no hay ningún shred.</td>
                                </tr>
                                <?php
                            }
                            ?>
                        <tbody>
                    </table>
                    <?php if (count($usersPosts) > 8) { ?>
                        <div class="pagination-buttons cs-fl cs-fl-align-c">
                            <div>
                                <button onclick="previousPage(0)" class="button-secondary prev"><span class="fas fa-angle-left"></span></button>
                            </div>
                            <div>
                                <button onclick="nextPage(0)" class="button-secondary next"><span class="fas fa-angle-right"></span></button>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <!--Todos los ususarios-->
                <div id="todos-los-usuarios" class="tabcontent">
                    <table class="my-account-table">
                        <thead>
                            <tr>
                                <td>USUARIO</td>                           
                                <td>DESCRIPCIÓN</td>
                                <td>CONTROL</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($usersData) && !empty($usersData)) {
                                foreach ($usersData as $user) {
                                    ?>
                                    <tr id="my-account-table-user-<?php echo $user['id_user']; ?>">
                                        <td>
                                            <?php echo $user['user_rol'] === CodeShred\Controllers\UsersController::MOD ? '<span class="fas fa-users-cog admin-mod-text"></span>' : ''; ?>
                                            <?php echo $user['user'] ?>
                                        </td>
                                        <td>
                                            <?php echo!empty($user['user_description']) ? $user['user_description'] : '<i>Este usuario todavía no ha puesto una descripción D:</i>'; ?>
                                        </td>
                                        <td>
                                            <div class="cs-fl cs-fl-just-c cs-fl-align-c my-account-table-buttons">
                                                <button class="button-warning button-my-account-post-delete" onclick="openDeleteUserPopup(<?php echo $user['id_user']; ?>, '<?php echo $user['user'] ?>')" title="Eliminar usuario"><span class="fas fa-user-times"></span></button>
                                                <a href="/post/edit/<?php echo $post['id_post']; ?>" class="button-secondary button-my-account-user-edit" id="button-my-account-user-edit-<?php echo $post['id_post']; ?>" title="Editar usuario"><span class="fas fa-user-edit"></span></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="3">Parece que no hemos encontrado ningún usuario.</td>
                                </tr>
                                <?php
                            }
                            ?>
                        <tbody>
                    </table>
                    <?php if (count($usersData) > 8) { ?>
                        <div class="pagination-buttons cs-fl cs-fl-align-c">
                            <div>
                                <button onclick="previousPage(1)" class="button-secondary prev"><span class="fas fa-angle-left"></span></button>
                            </div>
                            <div>
                                <button onclick="nextPage(1)" class="button-secondary next"><span class="fas fa-angle-right"></span></button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>


            <!--Configuración-->
            <div id="configuracion" class="tabcontent">
                <div class="tab-conf cs-fl-col">
                    <h3>Tu cuenta</h3>
                    <div class="my-account-settings cs-fl-col">
                        <!--Nombre de usuario-->
                        <input type="text" name="user" id="user" placeholder="Nombre de usuario" class="form-control register-input" value="<?php echo isset($userData['user']) ? $userData['user'] : ''; ?>">
                        <!--Errores usuario-->
                        <p class="login-box-message my-account-form-error" id="errorUser"></p>
                        <!--Email-->
                        <input type="email" name="email" id="email" placeholder="Correo electrónico" class="form-control register-input" value="<?php echo isset($userData['user_email']) ? $userData['user_email'] : ''; ?>">
                        <!--Errores email-->
                        <p class="login-box-message my-account-form-error" id="errorEmail"></p>
                        <!--Pass 1-->
                        <input type="password" name="password1" id="password1" placeholder="Contraseña" class="form-control register-input none" disabled>
                        <!--Errores pass 1-->
                        <p class="login-box-message my-account-form-error" id="errorPass1"></p>
                        <!--Pass 2-->
                        <input type="password" name="password2" id="password2" placeholder="Repetir contraseña" class="form-control register-input" disabled>
                        <!--Errores pass 2-->
                        <p class="login-box-message my-account-form-error" id="errorPass2"></p>
                        <!--Errores ambas pass-->
                        <p class="login-box-message register-input my-account-form-error" id="errorGlobal"></p>
                        <!--Submit-->
                        <div class="cs-fl cs-fl-align-c register-buttons">
                            <button type="submit" class="button-primary" id="update-user-data" data="<?php echo $userData['id_user']; ?>">Actualizar datos</button>
                            <button type="submit" class="button-warning" onclick="openDeleteAccountPopup()">Eliminar cuenta</button>
                        </div>
                        <?php if (isset($errorDelete)) : ?>
                            <p class="login-box-message register-input my-account-error-delete"><?php echo $errorDelete; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="popup-delete" class="popup-delete">
        <div class="popup-delete-content cs-fl-col">
            <div class="popup-delete-title cs-fl cs-fl-just-c">
                <h2>¿Seguro que quieres eliminar este Shred?</h2>
            </div>
            <div class="cs-fl-col">
                <div class="popup-delete-button cs-fl">
                    <button type="button" class="button-secondary" onclick="closeDeletePopup()">Volver atrás</button>
                    <button type="submit" class="button-warning" id="button-my-account-post-delete-popup">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <div id="popup-delete-user" class="popup-delete">
        <div class="popup-delete-content cs-fl-col">
            <div class="popup-delete-title cs-fl cs-fl-just-c">
                <h2 id="popup-delete-user-title"></h2>
            </div>
            <div class="cs-fl-col">
                <div class="popup-delete-button cs-fl">
                    <button type="button" class="button-secondary" onclick="closeDeleteUserPopup()">Volver atrás</button>
                    <button type="submit" class="button-warning" id="button-my-account-user-delete-popup">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <div id="popup-delete-account" class="popup-delete">
        <div class="popup-delete-content cs-fl-col">
            <div class="popup-delete-title cs-fl cs-fl-just-c">
                <h2><?php echo $userData['user']; ?>, ¿seguro que quieres eliminar tu cuenta?</h2>
            </div>
            <div class="cs-fl-col">
                <form action="/mi-cuenta/<?php echo $userData['id_user']; ?>" method="post" class="popup-delete-button cs-fl">
                    <button type="button" class="button-secondary" onclick="closeDeleteAccountPopup()">Volver atrás</button>
                    <button type="submit" class="button-warning">Eliminar cuenta</button>
                </form>
            </div>
        </div>
    </div>
