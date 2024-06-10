<!--Main-->
<main class="cs-fl-col cs-fl-align-c cs-fl-just-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="contact-cont cs-fl-col cs-fl-align-c cs-fl-just-c">
        <h1>Contacto codeShred</h1>
        <h2 class="hidden-element">Formulario de contacto</h2>
        <form action="/contacto" method="post" class="contact-form">
            <?php if (!isset($_SESSION['user'])) { ?>
                <div class="cs-fl contact-form-span space">
                    <div class="login-input cs-fl-col">
                        <label for="name"><span class="hidden-element">Nombre</span></label>
                        <input type="text" name="name" id="name" placeholder="Nombre" class="form-control" value="<?php echo isset($name) ? $name : ''; ?>">
                        <?php if (isset($errors['name'])) : ?>
                            <!--Errores nombre-->
                            <p class="contact-box-message error-fl"><?php echo $errors['name']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="surname"><span class="hidden-element">Apellidos</span></label>
                        <input type="text" name="surname" id="surname" placeholder="Apellidos" class="form-control" value="<?php echo isset($surname) ? $surname : ''; ?>">
                        <?php if (isset($errors['surname'])) : ?>
                            <!--Errores apellidos-->
                            <p class="contact-box-message error-fl"><?php echo $errors['surname']; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="contact-form-span">
                    <label for="email"><span class="hidden-element">Email</span></label>
                    <input type="email" name="email" id="email" placeholder="Correo electrónico" class="form-control" value="<?php echo isset($email) ? $email : ''; ?>">
                </div>
                <?php if (isset($errors['email'])) : ?>
                    <!--Errores email-->
                    <p class="contact-box-message contact-form-span">
                        <?php echo $errors['email']; ?>
                    </p>
                <?php endif; ?>
            <?php } ?>
            <div class="contact-form-span">
                <label for="subject"><span class="hidden-element">Asunto</span></label>
                <input type="text" name="subject" id="subject" placeholder="Asunto" class="form-control" value="<?php echo isset($subject) ? $subject : ''; ?>">
            </div>
            <?php if (isset($errors['subject'])) : ?>
                <!--Errores asunto-->
                <p class="contact-box-message contact-form-span">
                    <?php echo $errors['subject']; ?>
                </p>
            <?php endif; ?>
            <div class="contact-message-container contact-form-span">
                <label for="message"><span class="hidden-element">Mensaje</span></label>
                <textarea name="message" id="message" rows="10" class="contact-form-textarea" maxlength="255" placeholder="Mensaje..."><?php echo isset($message) ? $message : ''; ?></textarea>
                <p id="charCount">0/255</p>
            </div>
            <?php if (isset($errors['message'])) : ?>
                <!--Errores ambas pass-->
                <p class="contact-box-message contact-form-span">
                    <?php echo $errors['message']; ?>
                </p>
            <?php endif; ?>

            <div class="contact-form-span cs-fl cs-fl-align-c">
                <button class="button button-primary" type="submit"><i class=""></i>Enviar</button>
            </div>
        </form>
    </div>