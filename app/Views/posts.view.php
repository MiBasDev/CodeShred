<!--Main-->
<main class="cs-fl-col cs-fl-align-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="posts-container cs-fl-col">
        <h1><?php echo isset($section) && $section == '/mi-cuenta/mis-posts' ? 'Mis Shreds' : 'Shreds'; ?></h1>
        <h2 class="hidden-element">Todos los Shreds del sistema</h2>
        <div class="posts-cards-container-<?php echo isset($posts) && !empty($posts) && count($posts) > 2 ? 'grid' : 'flex'; ?>">
            <?php
            if (isset($posts) && !is_null($posts) && !empty($posts)) {
                foreach ($posts as $post) {
                    ?>
                    <div class = "post-card cs-fl-col">
                        <a href = "/post/<?php echo isset($_SESSION['user']) && $post['user'] == $_SESSION['user']['user'] ? 'edit/' . $post['id_post'] : $post['id_post']; ?>" class = "post-card-img-a cs-fl cs-fl-just-c cs-fl-align-c">
                            <img src = "<?php echo!empty($post['post_img']) && $post['post_img'] != '-' ? $post['post_img'] : 'assets/img/cs-logo-color.png'; ?>" alt="<?php echo $post['post_title']; ?>-<?php echo $post['user']; ?>" class = "post-card-img">
                        </a>
                        <div class="post-card-text-content cs-fl-col cs-fl-just-c">
                            <div class="cs-fl cs-fl-align-c post-card-title">
                                <a href = "/post/<?php echo isset($_SESSION['user']) && $post['user'] == $_SESSION['user']['user'] ? 'edit/' . $post['id_post'] : $post['id_post']; ?>" class = "post-card-title-container">
                                    <h3><?php echo isset($post['post_title']) && !empty($post['post_title']) ? $post['post_title'] : '<i>Shred de ' . $post['user'] . '</i>'; ?></h3>
                                </a>
                            </div>
                            <div class = "post-card-specifications cs-fl cs-fl-align-c">
                                <div class = "post-card-user cs-fl">
                                    <img class="profile-pic" src="<?php echo htmlspecialchars($post['user_gravatar']); ?>" alt="Imagen de perfil de <?php echo $post['user']; ?>">
                                    <span>
                                        <?php echo $post['user']; ?>
                                    </span>
                                </div>
                                <div class = "post-card-tags cs-fl">
                                    <span>
                                        <?php echo $post['tags_html'] == 1 ? '<i class="fab fa-html5"></i>' : ''; ?>
                                        <?php echo $post['tags_css'] == 1 ? '<i class="fab fa-css3-alt"></i>' : ''; ?>
                                        <?php echo $post['tags_js'] == 1 ? '<i class="fab fa-js-square"></i>' : ''; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="cs-fl cs-fl-align-c post-card-stats">
                            <div class="cs-fl cs-fl-just-c cs-fl-align-c post-card-stats-inner">
                                <span class="fa fa-eye"></span><span><?php echo $post['views'] ?></span>
                            </div>
                            <div class="cs-fl cs-fl-just-c cs-fl-align-c post-card-stats-inner">
                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['user'] != $post['user'] && $_SESSION['user']['user_rol'] != CodeShred\Controllers\UsersController::ADMIN) { ?>
                                    <button class="post-like" id="post-like-<?php echo $post['id_post']; ?>">
                                        <span class="<?php echo $post['liked'] !== null ? 'fa' : 'far'; ?> fa-heart <?php echo $post['liked'] !== null ? 'post-liked' : ''; ?>"></span><span class="hidden-element">Dar/quitar me gusta</span>
                                    </button>
                                <?php } else { ?>
                                    <span class="fa fa-heart"></span>
                                <?php } ?>
                                <span id="post-total-likes-<?php echo $post['id_post'] ?>"><?php echo $post['total_likes'] ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class = "cs-fl-col">No hemos encontrado ningún Shred.</div>
                <?php
            }
            ?>
        </div>
    </div>                