<!--Main-->
<main class="cs-fl-col cs-fl-just-c cs-fl-align-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="my-account-container cs-fl">
        <h1 class="hidden-element">Mi cuenta</h1>
        <?php if ($_SESSION['user']['user_rol'] != CodeShred\Controllers\UsersController::ADMIN) { ?>
            <div class="my-account-data cs-fl-col cs-fl-just-c cs-fl-align-c">
                <h2>Hola, <?php echo $userData['user']; ?> <i class="fas fa-smile-beam"></i></h2>
                <?php if (isset($_SESSION['user']) && isset($_SESSION['user']['user_gravatar'])) { ?>
                    <div class="my-account-profile-img cs-fl cs-fl-just-c cs-fl-align-c">
                        <img src="<?php echo htmlspecialchars($_SESSION['user']['user_gravatar']); ?>" alt="Imagen de perfil de <?php echo $_SESSION['user']['user']; ?>" id="profile-pic-account">
                    </div>
                <?php } else { ?>
                    <span class="fa fa-user my-account-data-logo"></span>
                <?php } ?>
                <div class="my-account-data-description cs-fl-col">
                    <label for="user-description">Sobre mí:</label>
                    <textarea name="user-description" id="user-description" rows="6" class="contact-form-textarea" placeholder="Pequeña descripción sobre ti..." maxlength="200"><?php echo isset($userData) && !empty($userData['user_description']) ? $userData['user_description'] : ''; ?></textarea>
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
                <button class="tablinks" onclick="openTabOption(event, 'mis-shreds')">Mis Shreds</button>
                <?php if ($_SESSION['user']['user_rol'] != CodeShred\Controllers\UsersController::ADMIN) { ?>
                    <button class="tablinks" onclick="openTabOption(event, 'likes')">Likes</button>
                    <button class="tablinks" onclick="openTabOption(event, 'cuentas-seguidas')">Cuentas seguidas</button>
                <?php } ?>
                <button class="tablinks" onclick="openTabOption(event, 'configuracion')" id="defaultOpen">Configuración</button>
            </div>
            <!--Mis Shreds-->
            <div id="mis-shreds" class="tabcontent">
                <table class="my-account-table">
                    <thead>
                        <tr>
                            <th>TÍTULO</th>                           
                            <th><span class="fa fa-eye"></span><span class="hidden-element">Visualizaciones</span></th>                            
                            <th><span class="fa fa-heart"></span><span class="hidden-element">Me gusta</span></th>
                            <th>CONTROL</th>
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
                                            <?php echo isset($post['post_title']) && !empty($post['post_title']) ? $post['post_title'] : '<i>Shred de ' . $post['user'] . '</i>'; ?>
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
                                            <button class="button-warning button-my-account-post-delete" onclick="openDeletePopup(<?php echo $post['id_post']; ?>)" title="Eliminar shred"><span class="fas fa-trash-alt"></span><span class="hidden-element">Eliminar Shred</span></button>
                                            <a href="/post/edit/<?php echo $post['id_post']; ?>" class="button-secondary button-my-account-post-edit" id="button-my-account-post-edit-<?php echo $post['id_post']; ?>" title="Editar shred"><span class="far fa-edit"></span><span class="hidden-element">Editar Shred</span></a>
                                            <a href="/post/<?php echo $post['id_post']; ?>" class="button-primary button-my-account-post-view" id="button-my-account-post-view-<?php echo $post['id_post']; ?>" title="Ver shred"><span class="fa fa-eye"></span><span class="hidden-element">Ver Shred</span></a>
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
                    </tbody>
                </table>
                <div class="pagination-buttons <?php echo isset($userPosts) && count($userPosts) > 8 ? '' : 'none' ?> cs-fl cs-fl-align-c">
                    <div>
                        <button onclick="previousPage(0)" class="button-secondary prev"><span class="fas fa-angle-left"></span><span class="hidden-element">Anterior</span></button>
                    </div>
                    <div>
                        <button onclick="nextPage(0)" class="button-secondary next"><span class="fas fa-angle-right"></span><span class="hidden-element">Siguiente</span></button>
                    </div>
                </div>
            </div>

            <?php if ($_SESSION['user']['user_rol'] != CodeShred\Controllers\UsersController::ADMIN) { ?>
                <!--Likes-->
                <div id="likes" class="tabcontent">
                    <table class="my-account-table">
                        <thead>
                            <tr>
                                <th>SHRED</th>                           
                                <th>USUARIO</th>
                                <th>CONTROL</th>
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
                                                <span class="fa fa-heart post-liked"></span><span class="hidden-element">Dar/quitar me gusta</span>
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
                        </tbody>
                    </table>
                    <div class="pagination-buttons <?php echo isset($userLikedPosts) && count($userLikedPosts) > 8 ? '' : 'none' ?> cs-fl cs-fl-align-c">
                        <div>
                            <button onclick="previousPage(1)" class="button-secondary prev"><span class="fas fa-angle-left"></span><span class="hidden-element">Anterior</span></button>
                        </div>
                        <div>
                            <button onclick="nextPage(1)" class="button-secondary next"><span class="fas fa-angle-right"></span><span class="hidden-element">Siguiente</span></button>
                        </div>
                    </div>
                </div>

                <!--Cuentas seguidas-->
                <div id="cuentas-seguidas" class="tabcontent">
                    <table class="my-account-table">
                        <thead>
                            <tr>
                                <th>USUARIO</th>                           
                                <th>DESCRIPCIÓN</th>
                                <th>CONTROL</th>
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
                                        <td class="cs-fl cs-fl-just-c">
                                            <button class="user-follow button-success" id="user-<?php echo $user['id_user']; ?>" data-user="<?php echo $user['user']; ?>">
                                                <span class="fas fa-user-check"></span><span class="hidden-element">Seguir/dejar de seguir al usuario</span>
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
                        </tbody>
                    </table>
                    <div class="pagination-buttons <?php echo isset($userFollowing) && count($userFollowing) > 8 ? '' : 'none' ?> cs-fl cs-fl-align-c">
                        <div>
                            <button onclick="previousPage(2)" class="button-secondary prev"><span class="fas fa-angle-left"></span><span class="hidden-element">Anterior</span></button>
                        </div>
                        <div>
                            <button onclick="nextPage(2)" class="button-secondary next"><span class="fas fa-angle-right"></span><span class="hidden-element">Siguiente</span></button>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!--Configuración-->
            <div id="configuracion" class="tabcontent">
                <div class="tab-conf cs-fl-col">
                    <h2>Tu cuenta</h2>
                    <div class="my-account-settings cs-fl-col">
                        <!--Nombre de usuario-->
                        <label for="user" class="hidden-element">Usuario</label>
                        <input type="text" name="user" id="user" placeholder="Nombre de usuario" class="form-control register-input" value="<?php echo isset($userData['user']) ? $userData['user'] : ''; ?>">
                        <!--Errores usuario-->
                        <p class="login-box-message my-account-form-error" id="errorUser"></p>
                        <!--Email-->
                        <label for="email" class="hidden-element">Email</label>
                        <input type="email" name="email" id="email" placeholder="Correo electrónico" class="form-control register-input" value="<?php echo isset($userData['user_email']) ? $userData['user_email'] : ''; ?>">
                        <!--Errores email-->
                        <p class="login-box-message my-account-form-error" id="errorEmail"></p>
                        <p class="my-account-form-pass-management">Cambiar contraseña:</p>
                        <!--Current pass-->
                        <label for="current-password" class="hidden-element">Contraseña actual</label>
                        <input type="password" name="current-password" id="current-password" placeholder="Contraseña actual" class="form-control register-input none">
                        <!--Errores current pass-->
                        <p class="login-box-message my-account-form-error" id="errorCurrentPass"></p>
                        <!--Pass 1-->
                        <label for="password1" class="hidden-element">Nueva contraseña</label>
                        <input type="password" name="password1" id="password1" placeholder="Nueva contraseña" class="form-control register-input none">
                        <!--Errores pass 1-->
                        <p class="login-box-message my-account-form-error" id="errorPass1"></p>
                        <!--Pass 2-->
                        <label for="password2" class="hidden-element">Repetir nueva contraseña</label>
                        <input type="password" name="password2" id="password2" placeholder="Repetir nueva contraseña" class="form-control register-input">
                        <!--Errores pass 2-->
                        <p class="login-box-message my-account-form-error" id="errorPass2"></p>
                        <!--Errores ambas pass-->
                        <p class="login-box-message register-input my-account-form-error" id="errorGlobal"></p>
                        <!--Submit-->
                        <div class="cs-fl cs-fl-align-c register-buttons">
                            <button type="submit" class="button-primary" id="update-user-data" data-id="<?php echo $userData['id_user']; ?>">Actualizar datos</button>
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
                <h3>¿Seguro que quieres eliminar este Shred?</h3>
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
                <h3 id="popup-delete-user-title">Se rellena solo</h3>
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
                <h3><?php echo $userData['user']; ?>, ¿seguro que quieres eliminar tu cuenta?</h3>
            </div>
            <div class="cs-fl-col">
                <form action="/mi-cuenta/<?php echo $userData['id_user']; ?>" method="post" class="popup-delete-button cs-fl">
                    <button type="button" class="button-secondary" onclick="closeDeleteAccountPopup()">Volver atrás</button>
                    <button type="submit" class="button-warning">Eliminar cuenta</button>
                </form>
            </div>
        </div>
    </div>