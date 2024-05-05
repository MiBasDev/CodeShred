<!DOCTYPE html>
<html lang="en">

    <head>
        <base href="/">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="assets/css/codeShred-general.css">
        <link rel="stylesheet" type="text/css" href="assets/css/codeShred.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" type="text/css" href="plugins/fontawesome-free/css/all.min.css">
        <?php if (isset($section) && strpos($section, '/post') === 0) { ?>
            <!--Codemirror-->
            <link rel="stylesheet" type="text/css" href="plugins/codemirror/codemirror.css">
            <script type="text/javascript" src="plugins/codemirror/codemirror.js"></script>
            <link rel="stylesheet" type="text/css" href="plugins/codemirror/theme/dracula.css">
            <script type="text/javascript" src="plugins/codemirror/mode/xml/xml.js"></script>
            <script type="text/javascript" src="plugins/codemirror/mode/css/css.js"></script>
            <script type="text/javascript" src="plugins/codemirror/mode/javascript/javascript.js"></script>
            <script type="text/javascript" src="plugins/codemirror/addon/edit/matchbrackets.js"></script>
            <script type="text/javascript" src="plugins/codemirror/addon/edit/closebrackets.js"></script>
            <script type="text/javascript" src="plugins/codemirror/addon/edit/closetag.js"></script>
            <script type="text/javascript" src="plugins/codemirror/addon/hint/show-hint.js"></script>
            <script type="text/javascript" src="plugins/codemirror/addon/hint/anyword-hint.js"></script>
            <script type="text/javascript" src="plugins/codemirror/addon/lint/lint.js"></script>
            <script type="text/javascript" src="plugins/codemirror/addon/edit/matchtags.js"></script>
            <script type="text/javascript" src="plugins/codemirror/addon/display/autorefresh.js"></script>
        <?php } ?>
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
                    <?php if (isset($section) && strpos($section, '/post') === 0 && $section !== '/posts') { ?>
                        <input type="text" name="title" id="post-title" value="<?php echo isset($post) ? $post['post_title'] : ''; ?>" placeholder="Título" <?php echo isset($section) && strpos($section, '/post/') !== 0 ? 'disabled' : ''; ?>>
                    <?php } ?>
                </div>
                <div>
                    <?php if (isset($_SESSION['user']) && isset($section) && $section == '/post/edit') { ?>
                        <button class="button-warning" id="button-post-delete" onclick="openDeletePopup()"><i class="fas fa-trash-alt"></i></button>
                    <?php } ?>
                    <?php if (isset($_SESSION['user']) && isset($section) && strpos($section, '/post/') === 0) { ?>
                        <button class="button-primary" id="button-post-save" onclick="openPopup()">Guardar</button>
                    <?php } ?>
                    <?php if (isset($_SESSION['user']) && isset($section) && strpos($section, '/post') !== 0 || $section === '/posts') { ?>
                        <input type="search" placeholder="Buscar...">
                    <?php } ?>
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
                            <button class="button-secondary" id="button-my-account" title="<?= $_SESSION['user']['user'] ?>"><i class="fas fa-user"></i></button>
                        </a> 
                        <a href="/logout" class="logout">
                            <button class="button-primary" id="button-logout"><i class="fas fa-sign-out-alt"></i></button>
                        </a>   
                    <?php } ?>
                </div>
            </div>
        </header>

        <!--Notificaciones???-->
        <div class="<?= isset($notification) ? 'cs-fl-col' : 'user-notificactions-none'; ?> cs-fl-just-c user-notificactions" id="user-notificactions">
            <h3>Nueva notifiación</h3>
            <p><?= $notification['message']; ?></p>
        </div>
