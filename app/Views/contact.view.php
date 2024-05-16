<!--Main-->
<main class="cs-fl-col cs-fl-align-c cs-fl-just-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="contact-cont cs-fl-col cs-fl-align-c cs-fl-just-c">
        <h1>Contacto codeShred</h1>
        <form action="/contacto" method="post" class="contact-form">
            <?php if (!isset($_SESSION['user'])) { ?>
                <div class="cs-fl contact-form-span space">
                    <div class="login-input">
                        <label for="name"><span class="hidden-element">Nombre</span></label>
                        <input type="text" name="name" placeholder="Nombre" class="form-control">
                    </div>

                    <div class="login-input">
                        <label for="surname"><span class="hidden-element">Apellidos</span></label>
                        <input type="text" name="surname" placeholder="Apellidos" class="form-control">
                    </div>
                </div>
                <?php if (isset($errors['name']) || isset($errors['surname'])) : ?>
                    <div class="cs-fl register-div-errs space">
                        <!--Errores nombre-->
                        <p class="contact-box-message">
                            <?php
                            if (isset($errors['name'])) {
                                echo $errors['name'];
                            }
                            ?>
                        </p>
                        <!--Errores apellidos-->
                        <p class="contact-box-message">
                            <?php
                            if (isset($errors['surname'])) {
                                echo $errors['surname'];
                            }
                            ?>
                        </p>
                    </div>
                <?php endif; ?>
                <div class="login-input contact-form-span">
                    <label for="email"><span class="hidden-element">Email</span></label>
                    <input type="email" name="email" placeholder="Email" class="form-control">
                </div>
                <?php if (isset($errors['email'])) : ?>
                    <!--Errores email-->
                    <p class="contact-box-message">
                        <?php echo $errors['email']; ?>
                    </p>
                <?php endif; ?>
            <?php } ?>
            <div class="login-input contact-form-span">
                <label for="subject"><span class="hidden-element">Asunto</span></label>
                <input type="text" name="subject" id="subject" placeholder="Asunto" class="form-control"></input>
            </div>
            <?php if (isset($errors['subject'])) : ?>
                <!--Errores asunto-->
                <p class="contact-box-message">
                    <?php echo $errors['subject']; ?>
                </p>
            <?php endif; ?>
            <div class="login-input contact-form-span">
                <label for="message"><span class="hidden-element">Mensaje</span></label>
                <textarea name="message" id="message" rows="10" class="contact-form-textarea" maxlength="255" placeholder="Comentarios..."></textarea>
            </div>
            <?php if (isset($errors['message'])) : ?>
                <!--Errores ambas pass-->
                <p class="contact-box-message register-input">
                    <?php echo $errors['message']; ?>
                </p>
            <?php endif; ?>

            <div class="contact-form-span cs-fl cs-fl-align-c">
                <p id="charCount">0/255</p>
                <button class="button button-primary" type="submit"><i class=""></i>Enviar</button>
            </div>
        </form>
    </div>