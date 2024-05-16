<!--Main-->
<main class="cs-fl-col cs-fl-align-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="admin-users-content">
        <h1>Usuarios del sistema</h1>
        <!--Todos los usuarios-->
        <div id="todos-los-usuarios" class="tabcontent admin">
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
                                    <?php echo $user['user_rol'] === \CodeShred\Controllers\UsersController::MOD ? '<span class="fas fa-user-cog admin-mod-text"></span>' : ''; ?>
                                    <?php echo $user['user'] ?>
                                </td>
                                <td>
                                    <?php echo!empty($user['user_description']) ? $user['user_description'] : '<i>Este usuario todavía no ha puesto una descripción D:</i>'; ?>
                                </td>
                                <td>
                                    <div class="cs-fl cs-fl-just-c cs-fl-align-c my-account-table-buttons">
                                        <button class="button-warning button-my-account-post-delete" onclick="openDeleteUserPopup(<?php echo $user['id_user']; ?>, '<?php echo $user['user'] ?>')" title="Eliminar usuario"><span class="fas fa-user-times"></span><span class="hidden-element">Eliminar usuario</span></button>
                                        <button class="button-secondary button-my-account-user-edit" onclick="openUpdateUserPopup(<?php echo $user['id_user']; ?>, '<?php echo $user['user'] ?>')" title="Editar usuario"><span class="fas fa-user-edit"></span><span class="hidden-element">Editar usuario</span></button>
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
                <div class="popup-delete-button cs-fl">
                    <button type="button" class="button-secondary" onclick="closeUpdateUserPopup()">Cerrar</button>
                    <button type="submit" class="button-primary" id="button-admin-user-update-popup">Actualizar</button>
                </div>
            </div>
        </div>
    </div>