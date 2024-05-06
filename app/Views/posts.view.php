<!--Main-->
<main class="cs-fl-col cs-fl-align-c <?= isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="posts-container cs-fl-col">
        <h1><?= isset($section) && $section == '/mi-cuenta/mis-posts' ? 'Mis Shreds' : 'Shreds'; ?></h1>
        <div class="posts-cards-container-<?= isset($posts) && !empty($posts) && count($posts) > 2 ? 'grid' : 'flex'; ?>">
            <?php
            if (isset($posts) && !is_null($posts) && !empty($posts)) {
                foreach ($posts as $post) {
                    //var_dump($post);
                    ?>
                    <div class = "post-card cs-fl-col">
                        <a href = "/post/<?= isset($_SESSION['user']) && $post['user'] == $_SESSION['user']['user'] ? 'edit/' . $post['id_post'] : $post['id_post']; ?>" class = "post-card-img-a cs-fl cs-fl-just-c cs-fl-align-c">
                            <img src = "assets/img/cs-logo-color.png" class = "post-card-img">
                        </a>
                        <div class="cs-fl cs-fl-align-c post-card-title">
                            <a href = "/post/<?= isset($_SESSION['user']) && $post['user'] == $_SESSION['user']['user'] ? 'edit/' . $post['id_post'] : $post['id_post']; ?>" class = "post-card-title-container">
                                <h3><?= $post['post_title'] ?></h3>
                            </a>
                        </div>
                        <div class = "post-card-specifications cs-fl cs-fl-align-c">
                            <div class = "post-card-user cs-fl">
                                <i class = "fas fa-user"></i>
                                <span>
                                    <?= $post['user'] ?>
                                </span>
                            </div>
                            <div class = "post-card-tags cs-fl">
                                <span>
                                    <?= $post['tags_html'] == 1 ? '<i class="fab fa-html5"></i>' : ''; ?>
                                    <?= $post['tags_css'] == 1 ? '<i class="fab fa-css3-alt"></i>' : ''; ?>
                                    <?= $post['tags_js'] == 1 ? '<i class="fab fa-js-square"></i>' : ''; ?>
                                </span>
                            </div>
                        </div>
                        <div class="cs-fl cs-fl-align-c post-card-stats">
                            <div class="cs-fl cs-fl-just-c cs-fl-align-c post-card-stats-inner">
                                <span class="fa fa-eye"></span><span><?= $post['views'] ?></span>
                            </div>
                            <div class="cs-fl cs-fl-just-c cs-fl-align-c post-card-stats-inner">
                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['user'] != $post['user'] && $_SESSION['user']['user_rol'] != CodeShred\Controllers\UsersController::ADMIN) { ?>
                                    <button class="post-like" id="post-like-<?= $post['id_post']; ?>">
                                        <span class="<?= $post['liked'] !== null ? 'fa' : 'far'; ?> fa-heart <?= $post['liked'] !== null ? 'post-liked' : ''; ?>"></span>
                                    </button>
                                <?php } else { ?>
                                    <span class="fa fa-heart"></span>
                                <?php } ?>
                                <span id="post-total-likes-<?= $post['id_post'] ?>"><?= $post['total_likes'] ?></span>
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