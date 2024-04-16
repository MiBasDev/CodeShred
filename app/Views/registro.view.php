<!--Main-->
<main class="flex-col flex-align-c flex-just-c">
    <div class="login flex-col flex-align-c flex-just-c" style="width: 100%; height:100%; display:grid; place-content: center;">
        <h1>Registro codeShred</h1>
        <form action="/registro" method="post" style="display: grid; grid-template-columns: repeat(2, 1fr);">
            <input type="text" name="name" id="name" placeholder="Nombre" class="form-control">
            <input type="text" name="surname" id="surname" placeholder="Apellidos" class="form-control">
            <input type="email" name="email" id="email" placeholder="Correo electrónico" class="form-control register-input"style="grid-column: span 2;">
            <input type="text" name="user" id="user" placeholder="Usuario" class="form-control register-input" style="grid-column: span 2;">
            <input type="password" name="password1" id="password1" placeholder="Contraseña" class="form-control register-input" style="grid-column: span 2;">
            <input type="password" name="password2" id="password2" placeholder="Repetir contraseña" class="form-control register-input" style="grid-column: span 2;">
            <?php if(isset($loginError)):?>
            <p class="login-box-message"><?php echo $loginError;?></p>
            <?php endif;?>
            <input type="submit" value="Registrarse" class="button-primary">
        </form>
    </div>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>