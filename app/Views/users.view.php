<!--Main-->
<main class="cs-fl-col cs-fl-align-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="cs-fl-col cs-fl-just-c users-page-container">
        <h1>Usuarios en codeShred</h1>
        <h2 class="hidden-element">Lista de usuarios</h2>
        <div class="users-container-<?php echo isset($users) && !empty($users) && count($users) > 3 ? 'grid' : 'flex'; ?>">
            <?php
            if (isset($users) && !empty($users)) {
                foreach ($users as $user) {
                    ?>
                    <?php if ($user['user'] != $_SESSION['user']['user']) { ?>
                        <div class="users-card cs-fl-col cs-fl-just-c">
                            <div class="user-name-container cs-fl">
                                <div class="user-name cs-fl">
                                    <img class="profile-pic" src="<?php echo htmlspecialchars($user['user_gravatar']); ?>" alt="Imagen de perfil de <?php echo $user['user']; ?>">
                                    <span><?php echo $user['user']; ?></span>
                                </div>
                                <button class="user-follow <?php echo $user['user_id_following'] != null ? 'button-success' : 'button-secondary'; ?>" id="user-<?php echo $user['id_user']; ?>" data-name="<?php echo $user['user']; ?>">
                                    <span class="fas <?php echo $user['user_id_following'] != null ? 'fa-user-check' : 'fa-user-plus'; ?>"></span><span class="hidden-element">Seguir/dejar de seguir al usuario</span>
                                </button>
                            </div>
                            <div class="user-content cs-fl">
                                <div><?php echo!empty($user['user_description']) ? $user['user_description'] : '<i>Este usuario todavía no ha puesto una descripción D:</i>'; ?></div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                }
            } else {
                ?>
                <div class = "cs-fl-col">No hemos encontrado ningún usuario.</div>
                <?php
            }
            ?>
        </div>
    </div>