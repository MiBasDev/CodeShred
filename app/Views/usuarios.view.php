<!--Main-->
<main class="cs-fl-col cs-fl-align-c">
    <?php var_dump($users) ?>
    <div class="cs-fl-col cs-fl-just-c users-page-container">
        <h1>Usuarios en codeShred</h1>
        <div class="users-container">
            <?php foreach ($users as $user) : ?>
                <div class="users-card cs-fl-col cs-fl-just-c">
                    <div class="user-name-container cs-fl">
                        <div class="user-name cs-fl">
                            <span class="fas fa-user user-img"></span>
                            <span><?= $user['user'] ?></span>
                        </div>
                        <button class="user-follow button-secondary">
                            <span class="fas fa-user"></span>
                            <span>Seguir</span>
                        </button>
                    </div>
                    <div class="user-content cs-fl">
                        <div>Descripción Descripción Descripción Descripción Descripción Descripción Descripción Descripción</div>
                        <span>#TAGS #TAGS #TAGS</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>