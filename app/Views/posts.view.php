<!--Main-->
<main class="cs-fl-col cs-fl-align-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="posts-container cs-fl-col">
        <h1><?php echo isset($section) && $section == '/mi-cuenta/mis-posts' ? 'Mis Shreds' : 'Shreds'; ?></h1>
        <div class="posts-cards-container-<?php echo isset($posts) && !empty($posts) && count($posts) > 2 ? 'grid' : 'flex'; ?>">
            <?php
            if (isset($posts) && !is_null($posts) && !empty($posts)) {
                foreach ($posts as $post) {
                    //var_dump($post);
                    ?>
                    <div class = "post-card cs-fl-col">
                        <a href = "/post/<?php echo isset($_SESSION['user']) && $post['user'] == $_SESSION['user']['user'] ? 'edit/' . $post['id_post'] : $post['id_post']; ?>" class = "post-card-img-a cs-fl cs-fl-just-c cs-fl-align-c">
                            <img src = "assets/img/cs-logo-color.png" class = "post-card-img">
                        </a>
                        <div class="cs-fl cs-fl-align-c post-card-title">
                            <a href = "/post/<?php echo isset($_SESSION['user']) && $post['user'] == $_SESSION['user']['user'] ? 'edit/' . $post['id_post'] : $post['id_post']; ?>" class = "post-card-title-container">
                                <h3><?php echo $post['post_title'] ?></h3>
                            </a>
                        </div>
                        <div class = "post-card-specifications cs-fl cs-fl-align-c">
                            <div class = "post-card-user cs-fl">
                                <i class = "fas fa-user"></i>
                                <span>
                                    <?php echo $post['user'] ?>
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
                        <div class="cs-fl cs-fl-align-c post-card-stats">
                            <div class="cs-fl cs-fl-just-c cs-fl-align-c post-card-stats-inner">
                                <span class="fa fa-eye"></span><span><?php echo $post['views'] ?></span>
                            </div>
                            <div class="cs-fl cs-fl-just-c cs-fl-align-c post-card-stats-inner">
                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['user'] != $post['user'] && $_SESSION['user']['user_rol'] != CodeShred\Controllers\UsersController::ADMIN) { ?>
                                    <button class="post-like" id="post-like-<?php echo $post['id_post']; ?>">
                                        <span class="<?php echo $post['liked'] !== null ? 'fa' : 'far'; ?> fa-heart <?php echo $post['liked'] !== null ? 'post-liked' : ''; ?>"></span>
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