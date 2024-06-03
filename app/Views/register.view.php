<!--Main-->
<main class="cs-fl-col cs-fl-align-c cs-fl-just-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="register cs-fl-col cs-fl-align-c cs-fl-just-c">

        <h1 class="cs-fl"><span><i class="fas fa-clipboard-list"></i></span>Registro codeShred</h1>

        <h2 class="hidden-element">Formulario de registro</h2>
        <form action="/registro" method="post" class="register-form">
            <div class="cs-fl register-input space">
                <!--Nombre-->
                <div class="cs-fl-col">
                    <label for="name"><span class="hidden-element">Nombre</span></label>
                    <input type="text" name="name" id="name" placeholder="Nombre" class="form-control" value="<?php echo isset($name) ? $name : ''; ?>">
                    <?php if (isset($errors['name'])) : ?>
                        <!--Errores nombre-->
                        <p class="login-box-message error-fl"><?php echo $errors['name']; ?></p>
                    <?php endif; ?>
                </div>
                <!--Nombre-->
                <div class="cs-fl-col">
                    <label for="surname"><span class="hidden-element">Apellidos</span></label>
                    <input type="text" name="surname" id="surname" placeholder="Apellidos" class="form-control" value="<?php echo isset($surname) ? $surname : ''; ?>">
                    <?php if (isset($errors['surname'])) : ?>
                        <!--Errores apellidos-->
                        <p class="login-box-message error-fl"><?php echo $errors['surname']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <!--Email-->
            <label for="email" class="hidden-element">Email</label>
            <input type="email" name="email" id="email" placeholder="Correo electrónico" class="form-control register-input" value="<?php echo isset($email) ? $email : ''; ?>">
            <?php if (isset($errors['email'])) : ?>
                <!--Errores email-->
                <p class="login-box-message register-input"><?php echo $errors['email']; ?></p>
            <?php endif; ?>
            <!--Nombre de usuario-->
            <label for="user" class="hidden-element">Usuario</label>
            <input type="text" name="user" id="user" placeholder="Nombre de usuario" class="form-control register-input" value="<?php echo isset($user) ? $user : ''; ?>">
            <?php if (isset($errors['user'])) : ?>
                <!--Errores usuario-->
                <p class="login-box-message register-input"><?php echo $errors['user']; ?></p>
            <?php endif; ?>
            <!--Pass 1-->
            <label for="password1" class="hidden-element">Contraseña</label>
            <input type="password" name="password1" id="password1" placeholder="Contraseña" class="form-control register-input">
            <?php if (isset($errors['password1'])) : ?>
                <!--Errores pass 1-->
                <p class="login-box-message register-input"><?php echo $errors['password1']; ?></p>
            <?php endif; ?>
            <!--Pass 2-->
            <label for="password2" class="hidden-element">Repetir contraseña</label>
            <input type="password" name="password2" id="password2" placeholder="Repetir contraseña" class="form-control register-input">
            <?php if (isset($errors['password2'])) : ?>
                <!--Errores pass 2-->
                <p class="login-box-message register-input"><?php echo $errors['password2']; ?></p>
            <?php endif; ?>
            <?php if (isset($errors['globalError'])) : ?>
                <!--Errores ambas pass-->
                <p class="login-box-message register-input"><?php echo $errors['globalError']; ?></p>
            <?php endif; ?>
            <!--Política de privacidad-->
            <div class="register-input cs-fl cs-fl-align-c register-privacity">
                <input type="checkbox" name="privacity" id="privacity" class="form-control register-input" <?php echo isset($data['privacity']) && $data['privacity'] ? 'checked' : ''; ?>>
                <label for="privacity">He leído y acepto la <a href="/politica-de-privacidad" target="_blank">Política de Privacidad</a></label>
            </div>
            <?php if (isset($errors['privacity'])) : ?>
                <!--Errores política de privacidad-->
                <p class="login-box-message register-input"><?php echo $errors['privacity']; ?></p>
            <?php endif; ?>
            <!--Submit-->
            <div class="cs-fl cs-fl-align-c register-buttons">
                <p>¿Ya tienes cuenta? <a href="/login" class="login-resgister-anchor">Logeate</a></p>
                <button type="submit" class="button-primary">Registrarse</button>
            </div>
        </form>
    </div>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>