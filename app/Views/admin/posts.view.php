<!--Main-->
<main class="cs-fl-col cs-fl-align-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="admin-posts-content">
        <h1>Shreds del sistema</h1>
        <!--Todos los Shreds-->
        <div id="todos-los-shreds" class="tabcontent admin">
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
                                    <?php echo $post['user_rol'] === \CodeShred\Controllers\UsersController::MOD ? '<span class="fas fa-user-cog admin-mod-text"></span>' : ''; ?>
                                    <?php echo $post['user'] ?>
                                </td>
                                <td>
                                    <div class="cs-fl cs-fl-just-c cs-fl-align-c my-account-table-buttons">
                                        <button class="button-warning button-my-account-post-delete" onclick="openDeletePopup(<?php echo $post['id_post']; ?>)" title="Eliminar shred"><span class="fas fa-trash-alt"></span><span class="hidden-element">Eliminar Shred</span></button>
                                        <a href="/post/edit/<?php echo $post['id_post']; ?>" class="button-secondary button-my-account-post-edit" id="button-my-account-post-edit-<?php echo $post['id_post']; ?>" title="Editar shred"><span class="far fa-edit"></span><span class="hidden-element">Editar Shred</span></a>
                                        <a href="/post/<?php echo $post['id_post']; ?>" class="button-primary button-my-account-post-view" id="button-my-account-post-view-<?php echo $post['id_post']; ?>" title="Editar shred"><span class="fa fa-eye"></span><span class="hidden-element">Ver Shred</span></a>
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
                </tbody>
            </table>
            <div class="pagination-buttons <?php echo count($usersPosts) > 8 ? '' : 'none' ?> cs-fl cs-fl-align-c">
                <div>
                    <button onclick="previousPage(0)" class="button-secondary prev"><span class="fas fa-angle-left"></span><span class="hidden-element">Anterior</span></button>
                </div>
                <div>
                    <button onclick="nextPage(0)" class="button-secondary next"><span class="fas fa-angle-right"></span><span class="hidden-element">Siguiente</span></button>
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