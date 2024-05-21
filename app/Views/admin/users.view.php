<!--Main-->
<main class="cs-fl-col cs-fl-align-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>" role="main">
    <div class="admin-users-content">
        <h1>Usuarios del sistema</h1>
        <!--Todos los usuarios-->
        <div id="todos-los-usuarios" class="tabcontent admin">
            <h2 class="hidden-element">Tabla de usuarios</h2>
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
                    if (isset($usersData) && !empty($usersData)) {
                        foreach ($usersData as $user) {
                            ?>
                            <tr id="my-account-table-user-<?php echo $user['id_user']; ?>">
                                <td>
                                    <?php echo $user['user_rol'] === \CodeShred\Controllers\UsersController::MOD ? '<span class="fas fa-user-cog admin-mod-text"></span>' : ''; ?>
                                    <?php echo $user['user'] ?>
                                </td>
                                <td>
                                    <?php echo!empty($user['user_description']) ? $user['user_description'] : '<i>Este usuario todavía no ha puesto una descripción D:</i>'; ?>
                                </td>
                                <td>
                                    <div class="cs-fl cs-fl-just-c cs-fl-align-c my-account-table-buttons">
                                        <button class="button-warning button-my-account-post-delete" onclick="openDeleteUserPopup(<?php echo $user['id_user']; ?>, '<?php echo $user['user'] ?>')" title="Eliminar al usuario <?php echo $user['user'] ?>"><span class="fas fa-user-times"></span><span class="hidden-element">Eliminar usuario</span></button>
                                        <button class="button-secondary button-my-account-user-edit" onclick="openUpdateUserPopup(<?php echo $user['id_user']; ?>, '<?php echo $user['user'] ?>', '<?php echo $user['user_email'] ?>', '<?php echo $user['user_rol'] ?>')" ><span class="fas fa-user-edit"></span><span class="hidden-element">Editar usuario</span></button>
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
                </tbody>
            </table>
            <div class="pagination-buttons <?php echo count($usersData) > 8 ? '' : 'none' ?> cs-fl cs-fl-align-c">
                <div>
                    <button onclick="previousPage(0)" class="button-secondary prev"><span class="fas fa-angle-left"></span><span class="hidden-element">Anterior</span></button>
                </div>
                <div>
                    <button onclick="nextPage(0)" class="button-secondary next"><span class="fas fa-angle-right"></span><span class="hidden-element">Siguiente</span></button>
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

    <div id="popup-update-user" class="popup-delete">
        <div class="popup-delete-content cs-fl-col">
            <div class="popup-delete-title cs-fl cs-fl-just-c">
                <h3 id="popup-admin-user-update-title">Se rellena solo</h3>
            </div>
            <div class="cs-fl-col">
                <div class="popup-delete-button cs-fl-col">
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
                    <div class="cs-fl">
                        <div class="popup-admin-pass cs-fl-col">
                            <!--Pass 1-->
                            <label for="password1" class="hidden-element">Contraseña</label>
                            <input type="password" name="password1" id="password1" placeholder="Contraseña" class="form-control register-input none" disabled>
                            <!--Errores pass 1-->
                            <p class="login-box-message my-account-form-error" id="errorPass1"></p>
                            <!--Pass 2-->
                            <label for="password2" class="hidden-element">Repetir contraseña</label>
                            <input type="password" name="password2" id="password2" placeholder="Repetir contraseña" class="form-control register-input" disabled>
                            <!--Errores pass 2-->
                            <p class="login-box-message my-account-form-error" id="errorPass2"></p>
                            <!--Errores ambas pass-->
                            <p class="login-box-message register-input my-account-form-error" id="errorGlobal"></p>
                        </div>
                        <div class="popup-admin-roles cs-fl cs-fl-align-c cs-fl-just-c">
                            <!--Cambio de rol-->
                            <label for="roles" class="hidden-element">Cambiar rol</label>
                            <select id="roles" name="roles">
                                <option value="<?php echo \CodeShred\Controllers\UsersController::USER; ?>">Usuario</option>
                                <option value="<?php echo \CodeShred\Controllers\UsersController::MOD; ?>">Moderador</option>
                            </select>
                        </div>
                    </div>
                    <!--Submit-->
                    <div class="cs-fl cs-fl-align-c register-buttons">
                        <button type="button" class="button-secondary" onclick="closeUpdateUserPopup()">Cerrar</button>
                        <button type="button" class="button-primary" id="update-user-data">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>