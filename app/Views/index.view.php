<main class="cs-fl-col cs-fl-align-c <?= isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="index-main-container main-content cs-fl cs-fl-align-c">
        <div class="index-main-container-left cs-fl-col cs-fl-just-c">
            <!-- Logo y slogan -->
            <div class="index-logo-and-slogan cs-fl-col cs-fl-align-c">
                <img src="assets/img/cs-logo.png">
                <h1>La red social de los programadores web</h1>
            </div>
            <?php if (!isset($_SESSION['user'])) { ?>
                <!-- Crea y comparte -->
                <div class="index-crea-y-comparte cs-fl cs-fl-just-c">
                    <div class="index-crea cs-fl-col">
                        <h2>Crea contenido</h2>
                        <p>Empieza a crear contenido... ¡Hazte una cuenta ahora!</p>
                        <a href="/login">
                            <button class="button-secondary">Crear Shred</button>
                        </a>
                    </div>
                    <div class="index-comparte cs-fl-col">
                        <h2>Explora contenido</h2>
                        <p>Explora todos los shreds creados por nuestra comunidad.</p>
                        <a href="/posts">
                            <button class="button-secondary">Explorar Shreds</button>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- Posts destacados -->
        <div class="index-main-container-right cs-fl-col cs-fl-just-c">
            <h2>Posts destacados</h2>
            <div class="index-posts-container">
                <?php
                if (isset($posts) && !empty($posts)) {
                    foreach ($posts as $post) {
                        ?>
                        <div class = "post-card cs-fl-col">
                            <a href = "/post/<?= isset($_SESSION['user']) && $post['user'] == $_SESSION['user']['user'] ? 'edit/' . $post['id_post'] : $post['id_post']; ?>" class = "post-card-img-a cs-fl cs-fl-just-c cs-fl-align-c">
                                <img src = "assets/img/cs-logo-color.png" class = "post-card-img">
                            </a>
                            <a href = "/post/<?= isset($_SESSION['user']) && $post['user'] == $_SESSION['user']['user'] ? 'edit/' . $post['id_post'] : $post['id_post']; ?>" class = "post-card-title-container">
                                <h3><?= $post['post_title'] ?></h3>
                            </a>
                            <div class = "post-card-specifications cs-fl cs-fl-align-c">
                                <div class = "post-card-user cs-fl">
                                    <i class = "fas fa-user"></i>
                                    <span>
                                        <?= $post['user'] ?>
                                    </span>
                                </div>
                                <div class = "post-card-tags">
                                    <?= $post['tags_html'] == 1 ? '<span>#HTML</span>' : ''; ?>
                                    <?= $post['tags_css'] == 1 ? '<span>#CSS</span>' : ''; ?>
                                    <?= $post['tags_js'] == 1 ? '<span>#JS</span>' : ''; ?>

                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class = "cs-fl-col">No hemos encontrado ningún post.</div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
