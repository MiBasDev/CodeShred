<!--Main-->
<main class="cs-fl-col cs-fl-just-c cs-fl-align-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>" role="main">
    <div class="main-content cs-fl-col cs-fl-just-c">  
        <h1><?php echo $text; ?></h1>
        <h2><?php echo $text2; ?></h2>
        <div class="contact-posts-container">
            <?php
            $count = 0;
            if (isset($posts) && !is_null($posts) && !empty($posts)) {
                foreach ($posts as $post) {
                    ?>
                    <div class = "post-card cs-fl-col">
                        <a href = "/post/<?php echo isset($_SESSION['user']) && $post['user'] == $_SESSION['user']['user'] ? 'edit/' . $post['id_post'] : $post['id_post']; ?>" class = "post-card-img-a" style="background: url(<?php echo!empty($post['post_img']) ? $post['post_img'] : 'assets/img/cs-logo-color.png'; ?>) no-repeat 50% 50% / cover black;" aria-label="Ver post: <?php echo $post['post_title']; ?>"></a>
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
                                        <?php echo $post['tags_html'] == 1 ? '<i class="fab fa-html5"></i>' : ''; ?>
                                        <?php echo $post['tags_css'] == 1 ? '<i class="fab fa-css3-alt"></i>' : ''; ?>
                                        <?php echo $post['tags_js'] == 1 ? '<i class="fab fa-js-square"></i>' : ''; ?>
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
                    $count++;
                    if ($count === 2) {
                        break;
                    }
                }
            } else {
                ?>
                <div class = "cs-fl-col">No hemos encontrado ningún post.</div>
                <?php
            }
            ?>
        </div>
    </div>