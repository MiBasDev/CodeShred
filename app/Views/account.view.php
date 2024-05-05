<!--Main-->
<main class="cs-fl-col cs-fl-just-c cs-fl-align-c <?= isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="my-account-container cs-fl">
        <?php if ($_SESSION['user']['user_rol'] == CodeShred\Controllers\UsersController::USER) { ?>
            <div class="my-account-data cs-fl-col cs-fl-just-c cs-fl-align-c">
                <h1>Hola, <?= $userData['user']; ?> <i class="fab fa-accessible-icon"></i></h1>
                <span class="fa fa-user my-account-data-logo"></span>
                <div class="my-account-data-description cs-fl-col">
                    <label for="user-description">Sobre mí:</label>
                    <textarea name="user-description" id="user-description" rows="6" class="contact-form-textarea" length="255" placeholder="Pequeña descripción sobre ti..."><?= isset($userData) && !empty($userData['user_description']) ? $userData['user_description'] : ''; ?></textarea>
                </div>
                <div class="my-account-data-buttons cs-fl">
                    <button class="button-secondary" id="update-description">Guardar descripción</button>
                </div>
            </div>
        <?php } ?>
        <div class="my-account-tab <?= $_SESSION['user']['user_rol'] == CodeShred\Controllers\UsersController::USER ? '' : 'admin'; ?>">
            <div class="tab <?= $_SESSION['user']['user_rol'] == CodeShred\Controllers\UsersController::USER ? '' : 'admin'; ?>">
                <?php if ($_SESSION['user']['user_rol'] == CodeShred\Controllers\UsersController::USER) { ?>
                    <button class="tablinks" onclick="openTabOption(event, 'mis-shreds')" id="defaultOpen">Mis Shreds</button>
                    <button class="tablinks" onclick="openTabOption(event, 'likes')">Likes</button>
                    <button class="tablinks" onclick="openTabOption(event, 'cuentas-seguidas')">Cuentas seguidas</button>
                    <button class="tablinks" onclick="openTabOption(event, 'configuracion')">Configuración</button>
                <?php } else { ?>
                    <button class="tablinks" onclick="openTabOption(event, 'todos-los-shreds')" id="defaultOpen">Shreds</button>
                    <button class="tablinks" onclick="openTabOption(event, 'todos-los-usuarios')">Usuarios</button>
                <?php } ?>
            </div>
            <?php if ($_SESSION['user']['user_rol'] == CodeShred\Controllers\UsersController::USER) { ?>
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
                                    <tr id="my-account-table-post-<?= $post['id_post']; ?>">
                                        <td>
                                            <a href = "/post/<?= $post['id_post']; ?>">
                                                <?= $post['post_title'] ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?= $post['views'] ?>
                                        </td>
                                        <td>
                                            <?= $post['total_likes'] ?>
                                        </td>
                                        <td class="cs-fl cs-fl-just-c cs-fl-align-c my-account-table-buttons">
                                            <button class="button-warning button-my-account-post-delete" onclick="openDeletePopup(<?= $post['id_post']; ?>)" title="Borrar shred"><span class="fas fa-trash-alt"></span></button>
                                            <a href="/post/edit/<?= $post['id_post']; ?>" class="button-secondary button-my-account-post-edit" id="button-my-account-post-edit-<?= $post['id_post']; ?>" title="Editar shred"><span class="far fa-edit"></span></a>
                                            <a href="/post/<?= $post['id_post']; ?>" class="button-primary button-my-account-post-view" id="button-my-account-post-view-<?= $post['id_post']; ?>" title="Editar shred"><span class="fa fa-eye"></span></a>
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
                                            <a href = "/post/<?= $post['id_post']; ?>" title="Ir al Shred '<?= $post['post_title'] ?>'">
                                                <?= $post['post_title'] ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?= $post['user'] ?>
                                        </td>
                                        <td>
                                            <button class="post-like post-like-tab" id="post-like-<?= $post['id_post']; ?>">
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
                                                <?= $user['user'] ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?= !empty($user['user_description']) ? $user['user_description'] : '<i>Este usuario todavía no ha puesto una descripción D:</i>'; ?>
                                        </td>
                                        <td>
                                            <button class="user-follow button-success" id="user-<?= $user['id_user']; ?>" data="<?= $user['user']; ?>">
                                                <span class="fas fa-check"></span>
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
                </div>

                <!--Configuración-->
                <div id="configuracion" class="tabcontent">
                    <div class="tab-conf cs-fl-col">
                        <h3>Tu cuenta</h3>
                        <!--Nombre de usuario-->
                        <input type="text" name="user" id="user" placeholder="Nombre de usuario" class="form-control register-input" value="<?php echo isset($userData['user']) ? $userData['user'] : ''; ?>">
                        <?php if (isset($loginErrorUser)) : ?>
                            <!--Errores usuario-->
                            <p class="login-box-message"><?php echo $loginErrorUser; ?></p>
                        <?php endif; ?>
                        <!--Email-->
                        <input type="email" name="email" id="email" placeholder="Correo electrónico" class="form-control register-input" value="<?php echo isset($userData['user_email']) ? $userData['user_email'] : ''; ?>">
                        <?php if (isset($loginErrorEmail)) : ?>
                            <!--Errores email-->
                            <p class="login-box-message"><?php echo $loginErrorEmail; ?></p>
                        <?php endif; ?>
                        <!--Pass 1-->
                        <input type="password" name="password1" id="password1" placeholder="Contraseña" class="form-control register-input">
                        <?php if (isset($loginErrorPass1)) : ?>
                            <!--Errores pass 1-->
                            <p class="login-box-message"><?php echo $loginErrorPass1; ?></p>
                        <?php endif; ?>
                        <!--Pass 2-->
                        <input type="password" name="password2" id="password2" placeholder="Repetir contraseña" class="form-control register-input">
                        <?php if (isset($loginErrorPass2)) : ?>
                            <!--Errores pass 2-->
                            <p class="login-box-message"><?php echo $loginErrorPass2; ?></p>
                        <?php endif; ?>
                        <?php if (isset($loginError)) : ?>
                            <!--Errores ambas pass-->
                            <p class="login-box-message register-input"><?php echo $loginError; ?></p>
                        <?php endif; ?>
                        <!--Submit-->
                        <div class="cs-fl cs-fl-align-c register-buttons">
                            <button type="submit" class="button-primary">Actualizar datos</button>
                        </div>
                    </div>
                </div>
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
                                    <tr id="my-account-table-post-<?= $post['id_post']; ?>">
                                        <td>
                                            <a href = "/post/<?= $post['id_post']; ?>">
                                                <?= $post['post_title'] ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?= $post['user'] ?>
                                        </td>
                                        <td class="cs-fl cs-fl-just-c cs-fl-align-c my-account-table-buttons">
                                            <button class="button-warning button-my-account-post-delete" onclick="openDeletePopup(<?= $post['id_post']; ?>)" title="Borrar shred"><span class="fas fa-trash-alt"></span></button>
                                            <a href="/post/edit/<?= $post['id_post']; ?>" class="button-secondary button-my-account-post-edit" id="button-my-account-post-edit-<?= $post['id_post']; ?>" title="Editar shred"><span class="far fa-edit"></span></a>
                                            <a href="/post/<?= $post['id_post']; ?>" class="button-primary button-my-account-post-view" id="button-my-account-post-view-<?= $post['id_post']; ?>" title="Editar shred"><span class="fa fa-eye"></span></a>
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
                </div>

                <!--Cuentas seguidas-->
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
                                    <tr id="my-account-table-user-<?= $user['id_user']; ?>">
                                        <td>
                                            <?= $user['user_rol'] === CodeShred\Controllers\UsersController::MOD ? '<span class="fas fa-users-cog admin-mod-text"></span>' : ''; ?>
                                            <?= $user['user'] ?>
                                        </td>
                                        <td>
                                            <?= !empty($user['user_description']) ? $user['user_description'] : '<i>Este usuario todavía no ha puesto una descripción D:</i>'; ?>
                                        </td>
                                        <td class="cs-fl cs-fl-just-c cs-fl-align-c my-account-table-buttons">
                                            <button class="button-warning button-my-account-post-delete" onclick="openDeleteUserPopup(<?= $user['id_user']; ?>, '<?= $user['user'] ?>')" title="Borrar usuario"><span class="fas fa-trash-alt"></span></button>
                                            <a href="/post/edit/<?= $post['id_post']; ?>" class="button-secondary button-my-account-post-edit" id="button-my-account-post-edit-<?= $post['id_post']; ?>" title="Editar usuario"><span class="far fa-edit"></span></a>
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
                </div>
            <?php } ?>
        </div>
    </div>
    <div id="popup-delete" class="popup-delete">
        <div class="popup-delete-content cs-fl-col">
            <div class="popup-delete-title cs-fl cs-fl-just-c">
                <h2>¿Seguro que quieres borrar este Shred?</h2>
            </div>
            <div class="cs-fl-col">
                <div class="popup-delete-button cs-fl">
                    <button type="button" class="button-secondary" onclick="closeDeletePopup()">Volver atrás</button>
                    <button type="submit" class="button-warning" id="button-my-account-post-delete-popup">Borrar</button>
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
                    <button type="submit" class="button-warning" id="button-my-account-user-delete-popup">Borrar</button>
                </div>
            </div>
        </div>
    </div>
