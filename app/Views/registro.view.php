<!--Main-->
<main class="cs-fl-col cs-fl-align-c cs-fl-just-c <?= isset($_COOKIE['foldedCookie']) ? 'folded-others' : '';?>">
    <div class="register cs-fl-col cs-fl-align-c cs-fl-just-c">

        <h1 class="cs-fl"><span><i class="fas fa-clipboard-list"></i></span>Registro codeShred</h1>

        <form action="/registro" method="post" class="register-form">
            <!--Nombre-->
            <input type="text" name="name" id="name" placeholder="Nombre" class="form-control" value="<?php echo isset($name) ? $name : ''; ?>">
            <!--Apellidos-->
            <input type="text" name="surname" id="surname" placeholder="Apellidos" class="form-control" value="<?php echo isset($surname) ? $surname : ''; ?>">
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
            <!--Email-->
            <input type="email" name="email" id="email" placeholder="Correo electrónico" class="form-control register-input" value="<?php echo isset($email) ? $email : ''; ?>">
            <?php if (isset($loginErrorEmail)) : ?>
                <!--Errores email-->
                <p class="login-box-message"><?php echo $loginErrorEmail; ?></p>
            <?php endif; ?>
            <!--Nombre de usuario-->
            <input type="text" name="user" id="user" placeholder="Nombre de usuario" class="form-control register-input" value="<?php echo isset($user) ? $user : ''; ?>">
            <?php if (isset($loginErrorUser)) : ?>
                <!--Errores usuario-->
                <p class="login-box-message"><?php echo $loginErrorUser; ?></p>
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
                <p>¿Ya tienes cuenta? <a href="/login" class="login-resgister-anchor">Logeate</a></p>
                <button type="submit" class="button-primary">Registrarse</button>
            </div>
        </form>
    </div>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>