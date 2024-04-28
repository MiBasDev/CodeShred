<!--Main-->
<main class="cs-fl-col cs-fl-align-c <?= isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="cs-fl-col cs-fl-just-c users-page-container">
        <h1>Usuarios en codeShred</h1>
        <div class="users-container">
            <?php
            if (isset($users) && !empty($users)) {
                foreach ($users as $user) {
                    ?>
                    <div class="users-card cs-fl-col cs-fl-just-c">
                        <div class="user-name-container cs-fl">
                            <div class="user-name cs-fl">
                                <span class="fas fa-user user-img"></span>
                                <span><?= $user['user']; ?></span>
                            </div>
                            <button class="user-follow button-secondary">
                                <span class="fas fa-user-plus"></span>
                                <span>Seguir</span>
                            </button>
                        </div>
                        <div class="user-content cs-fl">
                            <div><?= !empty($user['user_description']) ? $user['user_description'] : '<i>Este usuario todavía no ha puesto una descripción D:</i>'; ?></div>
                            <!--<span>#TAGS #TAGS #TAGS</span>-->
                        </div>
                    </div>
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