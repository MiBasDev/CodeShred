<!--Main-->
<main class="cs-fl-col cs-fl-align-c cs-fl-just-c <?= isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="contact-cont cs-fl-col cs-fl-align-c cs-fl-just-c">
        <h1 class="">CONTACTO</h1>
        <form action="/contacto" method="post" class="contact-form">
            <?php if (!isset($_SESSION['user'])) { ?>
                <div class="cs-fl contact-form-span">
                    <div class="login-input">
                        <label for="name"><i class=""></i></label>
                        <input type="text" name="name" placeholder="Nombre" class="form-control">
                    </div>

                    <div class="login-input">
                        <label for="surname"><i class=""></i></label>
                        <input type="text" name="surname" placeholder="Apellidos" class="form-control">
                    </div>
                </div>
                <?php if (isset($loginErrorName) || isset($loginErrorSurname)) : ?>
                    <div class="cs-fl register-div-errs">
                        <!--Errores nombre-->
                        <p class="login-box-message">
                            <?php
                            if (isset($loginErrorName)) {
                                echo $loginErrorName;
                            }
                            ?>
                        </p>
                        <!--Errores apellidos-->
                        <p class="login-box-message">
                            <?php
                            if (isset($loginErrorSurname)) {
                                echo $loginErrorSurname;
                            }
                            ?>
                        </p>
                    </div>
                <?php endif; ?>
                <div class="login-input contact-form-span">
                    <label for="email"><i class=""></i></label>
                    <input type="email" name="email" placeholder="Email" class="form-control">
                </div>
                <?php if (isset($loginErrorEmail)) : ?>
                    <!--Errores email-->
                    <p class="login-box-message">
                        <?php echo $loginErrorEmail; ?>
                    </p>
                <?php endif; ?>
            <?php } ?>
            <div class="login-input contact-form-span">
                <label for="subject"><i class=""></i></label>
                <input type="text" name="subject" id="subject" placeholder="Asunto" class="form-control"></input>
            </div>
            <?php if (isset($loginErrorEmail)) : ?>
                <!--Errores asunto-->
                <p class="login-box-message">
                    <?php echo $loginErrorEmail; ?>
                </p>
            <?php endif; ?>
            <div class="login-input contact-form-span">
                <label for="message"><i class=""></i></label>
                <textarea name="message" id="message" rows="10" class="contact-form-textarea" length="255" placeholder="Comentarios..."></textarea>
            </div>
            <?php if (isset($loginError)) : ?>
                <!--Errores ambas pass-->
                <p class="login-box-message register-input">
                    <?php echo $loginError; ?>
                </p>
            <?php endif; ?>

            <div class="contact-form-span">
                <button class="button button-primary" type="submit"><i class=""></i>Enviar</button>
            </div>
        </form>
    </div>