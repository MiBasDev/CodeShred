  <!--Main-->
  <main class="cs-fl-col cs-fl-align-c cs-fl-just-c">
    <div class="login cs-fl-col cs-fl-align-c cs-fl-just-c">

      <h1>Log IN codeShred</h1>

      <form action="/login" method="post" class="login-form cs-fl-col cs-fl-just-c">
        <!--User-->
        <div class="login-input cs-fl">
          <span class="fas fa-user"></span>
          <input type="text" name="user" class="form-control" placeholder="Usuario" value="<?php echo isset($user) ? $user : ''; ?>">
        </div>
        <!--Pass-->
        <div class="login-input cs-fl">
          <span class="fas fa-lock"></span>
          <input type="password" class="form-control" name="pass" placeholder="Contraseña">
        </div>
        <?php if (isset($loginError)) : ?>
          <!--Errores-->
          <p class="login-box-message"><?php echo $loginError; ?></p>
        <?php endif; ?>
        <!--Botones-->
        <div class="login-buttons cs-fl cs-fl-align-c">
          <a href="/login">Registrarse</a>
          <button type="submit" class="button-primary">Acceder</button>
        </div>
      </form>
    </div>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>