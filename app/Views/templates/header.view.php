<!DOCTYPE html>
<html lang="en">

    <head>
        <base href="/">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/codeShred-general.css">
        <link rel="stylesheet" href="assets/css/codeShred.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

        <title><?php echo $title; ?></title>
        <link rel="icon" type="image/x-icon" href="assets/img/cs-logo-favicon.png">
    </head>
    <body>

        <!--Header-->
        <header class="cs-fl cs-fl-align-c">
            <div class="header-logo cs-fl cs-fl-just-c cs-fl-align-c">
                <a href="/">
                    <img src="assets/img/cs-logo.png" alt="Logo codeShred" id="logo-cs">
                </a>
            </div>
            <div class="header-buttons cs-fl cs-fl-align-c">
                <div>
                    <?php if (isset($section) && strpos($section, '/post/') === 0) { ?>
                        <input type="text" name="title" id="post-title" value="" placeholder="Título" <?php echo isset($section) && strpos($section, '/post/') !== 0 ? 'disabled' : ''; ?>>
                    <?php } ?>
                </div>
                <div>
                    <?php if (isset($_SESSION['user']) && isset($section) && strpos($section, '/post/') === 0) { ?>
                        <button class="button-secondary" id="button-post-save">Guardar</button>
                    <?php } ?>
                    <input type="search" placeholder="Buscar...">
                    <?php if (!isset($_SESSION['user'])) {
                        ?>
                        <a href="/registro">
                            <button class="button-primary" id="button-register">Registrarse</button>
                        </a>
                        <a href="/login">
                            <button class="button-secondary" id="button-login">Login</button>
                        </a>        
                    <?php } else { ?>
                        <a href="/mi-cuenta">
                            <button class="button-secondary" id="button-my-account"><i class="fas fa-user"></i></button>
                        </a> 
                        <a href="/logout" class="logout">
                            <button class="button-primary" id="button-logout"><i class="fas fa-sign-out-alt"></i></button>
                        </a>   
                    <?php } ?>
                </div>
            </div>

        </header>
