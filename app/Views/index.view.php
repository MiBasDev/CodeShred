<main class="cs-fl-col cs-fl-align-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>" role="main">
    <div class="index-main-container main-content cs-fl cs-fl-align-c">
        <div class="index-main-container-left cs-fl-col cs-fl-just-c">
            <!-- Logo y slogan -->
            <div class="index-logo-and-slogan cs-fl-col cs-fl-align-c">
                <img src="assets/img/cs-logo.png" alt="Logo codeShred">
                <h1>La red social de los desarrolladores web</h1>
            </div>
            <?php if (!isset($_SESSION['user'])) { ?>
                <!-- Crea y comparte -->
                <div class="index-crea-y-comparte cs-fl cs-fl-just-c">
                    <div class="index-crea cs-fl-col">
                        <h2>Crea contenido</h2>
                        <p>Empieza a crear contenido... ¡Hazte una cuenta ahora!</p>
                        <div class="cs-fl">
                            <a href="/login" class="button-secondary">Crear Shred</a>
                        </div>
                    </div>
                    <div class="index-comparte cs-fl-col">
                        <h2>Explora contenido</h2>
                        <p>Explora todos los shreds creados por nuestra comunidad.</p>
                        <div class="cs-fl">
                            <a href="/posts" class="button-secondary">Explorar Shreds</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- Posts destacados -->
        <div class="index-main-container-right cs-fl-col cs-fl-just-c">
            <h2>Posts destacados</h2>
            <div class="index-posts-container">
                <?php
                if (isset($posts) && !is_null($posts) && !empty($posts)) {
                    foreach ($posts as $post) {
                        ?>
                        <div class = "post-card cs-fl-col">
                            <a href = "/post/<?php echo isset($_SESSION['user']) && $post['user'] == $_SESSION['user']['user'] ? 'edit/' . $post['id_post'] : $post['id_post']; ?>" class = "post-card-img-a" style="background: url(<?php echo!empty($post['post_img']) ? $post['post_img'] : 'assets/img/cs-logo-color.png'; ?>) no-repeat scroll 50% 50% / cover;" aria-label="Ver post: <?php echo $post['post_title']; ?>"></span></a>
                            <div class="post-card-text-content cs-fl-col cs-fl-just-c">
                                <a href = "/post/<?php echo isset($_SESSION['user']) && $post['user'] == $_SESSION['user']['user'] ? 'edit/' . $post['id_post'] : $post['id_post']; ?>" class = "post-card-title-container">
                                    <h3><?php echo $post['post_title']; ?></h3>
                                </a>
                                <div class = "post-card-specifications cs-fl cs-fl-align-c">
                                    <div class = "post-card-user cs-fl">
                                        <img class="profile-pic" src="<?php echo htmlspecialchars($post['user_gravatar']); ?>" alt="Imagen de perfil de <?php echo $post['user']; ?>">
                                        <span>
                                            <?php echo $post['user']; ?>
                                        </span>
                                    </div>
                                    <div class = "post-card-tags cs-fl">
                                        <span>
                                            <?php echo $post['tags_html'] == 1 ? '<i class="fab fa-html5"><span class="hidden-element">HMTL</span></i>' : ''; ?>
                                            <?php echo $post['tags_css'] == 1 ? '<i class="fab fa-css3-alt"><span class="hidden-element">CSS</span></i>' : ''; ?>
                                            <?php echo $post['tags_js'] == 1 ? '<i class="fab fa-js-square"><span class="hidden-element">JavaScript</span></i>' : ''; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="cs-fl cs-fl-align-c post-card-stats">
                                <div class="cs-fl post-card-stats-inner">
                                    <span class="fa fa-eye"></span><span><?php echo $post['views'] ?></span>
                                </div>
                                <div class="cs-fl post-card-stats-inner">
                                    <span class="fa fa-heart"></span><span><?php echo $post['total_likes'] ?></span>
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