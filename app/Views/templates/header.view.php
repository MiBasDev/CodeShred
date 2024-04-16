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

    <title>Inicio</title>
</head>

<body>
    <!--Header-->
    <header>
        <input type="search" placeholder="Buscar...">
        <?php if(!isset($_SESSION['user'])){ ?>
        <a href="/registro">
            <button class="button-primary" id="button-register">Registrarse</button>
        </a>
        <a href="/login">
            <button class="button-secondary" id="button-login">Login</button>
        </a>        
        <?php } else { ?>
        <a href="/logout">
            <button id="button-logout"><i class="fas fa-sign-out-alt"></i></button>
        </a>   
        <?php } ?>


    </header>
