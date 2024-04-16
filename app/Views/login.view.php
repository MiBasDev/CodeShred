  <!--Main-->
  <main class="flex-col flex-align-c flex-just-c">
    <div class="login flex-col flex-align-c flex-just-c">

      <h1>Log IN codeShred</h1>
      <!-- <p class="login-box-msg">Datos acceso: <i>admin@test.org - test</i></p>     -->
      <form action="/login" method="post" class="login-form flex-col flex-just-c">
        <div class="login-input flex">
          <span class="fas fa-user"></span>
          <input type="text" name="user" class="form-control" placeholder="Usuario" value="<?php echo isset($user) ? $user : ''; ?>">
        </div>
        <div class="login-input flex">
          <span class="fas fa-lock"></span>
          <input type="password" class="form-control" name="pass" placeholder="Contraseña">
        </div>
        <?php if(isset($loginError)):?>
        <p class="login-box-message"><?php echo $loginError;?></p>
        <?php endif;?>
        <div class="login-buttons flex flex-align-c">
          <a href="/login">Registrasrse</a>
          <button type="submit" class="button-primary">Acceder</button>
        </div>
      </form>
    </div>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>