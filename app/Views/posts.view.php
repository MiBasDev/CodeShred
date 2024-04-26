<!--Main-->
<main class="cs-fl-col <?= isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="posts-container cs-fl-col">
        <h1><?= isset($section) && $section == '/mi-cuenta/mis-posts' ? 'Mis Shreds' : 'Shreds'; ?></h1>
        <div class="posts-cards-container">
            <?php
            //var_dump($posts);
            if (isset($posts) && !empty($posts)) {
                foreach ($posts as $post) {
//                    $json = json_decode($post['post_code']);
//                    foreach ($json as $key => $value) {
//                        echo $key. ' => ' . $value;
//                    }
                    ?>
                    <div class = "post-card cs-fl-col">
                        <a href = "/post/<?= $post['id_post'] ?>" class = "post-card-img-a cs-fl cs-fl-just-c cs-fl-align-c">
                            <img src = "assets/img/cs-logo-color.png" class = "post-card-img">
                        </a>
                        <a href = "/post/<?= $post['id_post'] ?>" class = "post-card-title-container">
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