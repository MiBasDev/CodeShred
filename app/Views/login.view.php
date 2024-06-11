<!--Main-->
<main class="cs-fl-col cs-fl-align-c cs-fl-just-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="login cs-fl-col cs-fl-align-c cs-fl-just-c">

        <h1>Login CodeShred</h1>

        <h2 class="hidden-element">Formulario de login</h2>
        <form action="/login" method="post" class="login-form cs-fl-col cs-fl-just-c">
            <!--User-->
            <div class="login-input cs-fl">
                <label for="login-user" class="cs-fl"><span class="fas fa-user"></span><span class="hidden-element">Usuario</span></label>
                <input type="text" name="user" id="login-user" class="form-control" placeholder="Usuario" value="<?php echo isset($user) ? $user : ''; ?>">
            </div>
            <!--Pass-->
            <div class="login-input cs-fl">
                <label for="login-pass" class="cs-fl"><span class="fas fa-lock"></span><span class="hidden-element">Contraseña</span></label>
                <input type="password" name="pass" id="login-pass" class="form-control" placeholder="Contraseña">
            </div>
            <?php if (isset($loginError)) : ?>
                <!--Errores-->
                <p class="login-box-message"><?php echo $loginError; ?></p>
            <?php endif; ?>
            <!--Botones-->
            <div class="login-buttons cs-fl cs-fl-align-c">
                <a href="/registro" class="login-resgister-anchor">Registrarse</a>
                <button type="submit" class="button-primary">Acceder</button>
            </div>
        </form>
    </div>