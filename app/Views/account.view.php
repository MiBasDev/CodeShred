<!--Main-->
<main class="cs-fl-col cs-fl-just-c cs-fl-align-c <?= isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="my-account-container cs-fl">
        <div class="my-account-data cs-fl-col cs-fl-just-c cs-fl-align-c">
            <h1>Hola, <?= $userData['user']; ?> <i class="fab fa-accessible-icon"></i></h1>
            <span class="fa fa-user my-account-data-logo"></span>
            <div class="my-account-data-description cs-fl-col">
                <label for="user-description">Sobre mí:</label>
                <textarea name="user-description" id="user-description" rows="6" class="contact-form-textarea" length="255" placeholder="Pequeña descripción sobre mí..."></textarea>
            </div>
            <div class="my-account-data-buttons cs-fl">
                <input class="button-secondary" type="submit" value="Guardar descripción">
            </div>
        </div>
        <div class="my-account-tab">
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'mis-shreds')" id="defaultOpen">Mis Shreds</button>
                <button class="tablinks" onclick="openCity(event, 'likes')">Likes</button>
                <button class="tablinks" onclick="openCity(event, 'cuentas-seguidas')">Cuentas seguidas</button>
                <button class="tablinks" onclick="openCity(event, 'configuracion')">Configuración</button>
            </div>

            <div id="mis-shreds" class="tabcontent">
                <div class="posts-cards-container">
                    <?php
                    //var_dump($posts);
                    if (isset($userPosts) && !empty($userPosts)) {
                        foreach ($userPosts as $post) {
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

            <div id="likes" class="tabcontent">
                <h3>Likes</h3>
            </div>

            <div id="cuentas-seguidas" class="tabcontent">
                <h3>Cuentas seguidas</h3>
            </div>

            <div id="configuracion" class="tabcontent">
                <div class="tab-conf cs-fl-col">
                    <h3>Tu cuenta</h3>
                    <!--Nombre de usuario-->
                    <input type="text" name="user" id="user" placeholder="Nombre de usuario" class="form-control register-input" value="<?php echo isset($userData['user']) ? $userData['user'] : ''; ?>">
                    <?php if (isset($loginErrorUser)) : ?>
                        <!--Errores usuario-->
                        <p class="login-box-message"><?php echo $loginErrorUser; ?></p>
                    <?php endif; ?>
                    <!--Email-->
                    <input type="email" name="email" id="email" placeholder="Correo electrónico" class="form-control register-input" value="<?php echo isset($userData['user_email']) ? $userData['user_email'] : ''; ?>">
                    <?php if (isset($loginErrorEmail)) : ?>
                        <!--Errores email-->
                        <p class="login-box-message"><?php echo $loginErrorEmail; ?></p>
                    <?php endif; ?>
                    <!--Pass 1-->
                    <input type="password" name="password1" id="password1" placeholder="Contraseña" class="form-control register-input">
                    <?php if (isset($loginErrorPass1)) : ?>
                        <!--Errores pass 1-->
                        <p class="login-box-message"><?php echo $loginErrorPass1; ?></p>
                    <?php endif; ?>
                    <!--Pass 2-->
                    <input type="password" name="password2" id="password2" placeholder="Repetir contraseña" class="form-control register-input">
                    <?php if (isset($loginErrorPass2)) : ?>
                        <!--Errores pass 2-->
                        <p class="login-box-message"><?php echo $loginErrorPass2; ?></p>
                    <?php endif; ?>
                    <?php if (isset($loginError)) : ?>
                        <!--Errores ambas pass-->
                        <p class="login-box-message register-input"><?php echo $loginError; ?></p>
                    <?php endif; ?>
                    <!--Submit-->
                    <div class="cs-fl cs-fl-align-c register-buttons">
                        <button type="submit" class="button-primary">Actualizar datos</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>