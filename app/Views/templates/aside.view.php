<div class="overlay" id="overlay"></div>
<!--Aside-->
<aside class="cs-fl <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-aside' : ''; ?>" id="aside">
    <div class="aside-content cs-fl-col cs-fl-align-c">
        <?php if (!isset($_SESSION['user'])) {
            ?>
            <div class="cs-fl hamburger-menu-buttons">
                <a href="/registro" class="button-primary">Registrarse</a>
                <a href="/login" class="button-secondary">Login</a>        
            </div>
        <?php } else { ?>
            <div class="cs-fl hamburger-menu-buttons">
                <a href="/mi-cuenta" class="button-secondary" title="<?php echo $_SESSION['user']['user'] ?>"><i class="fas fa-user"></i></a> 
                <a href="/logout" class="logout button-primary"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        <?php } ?>
        <a href="/<?php echo isset($_SESSION['user']) ? 'post/add' : 'login'; ?>" class="cs-fl cs-fl-just-c" id="button-create-shred"><span>Crear Shred</span><span class="fas fa-code"></span></a>

        <!-- Sidebar Menu -->
        <nav>
            <ul class="nav">
                <?php if (isset($_SESSION['user'])) : ?>
                    <li class="nav-item" title="Mis Shreds">
                        <a href="/mi-cuenta/mis-posts" class="nav-link cs-fl cs-fl-just-c <?php echo $section === '/mi-cuenta/mis-posts' ? 'active' : ''; ?>">
                            <i class="far fa-file-code"></i>
                            <p>
                                Mis Shreds
                            </p>
                        </a>
                    </li>
                    <?php if ($_SESSION['user']['user_rol'] != CodeShred\Controllers\UsersController::ADMIN) { ?>
                        <li class="nav-item" title="Siguiendo">
                            <a href="/siguiendo" class="nav-link cs-fl cs-fl-just-c <?php echo $section === '/siguiendo' ? 'active' : ''; ?>">
                                <i class="fas fa-user-friends"></i>
                                <p>
                                    Siguiendo
                                </p>
                            </a>
                        </li>                
                    <?php } ?>
                <?php endif; ?>
                <li class="nav-item" title="Ver Shreds">
                    <a href="/posts" class="nav-link cs-fl cs-fl-just-c <?php echo $section === '/posts' ? 'active' : ''; ?>">
                        <i class="fas fa-laptop-code"></i>
                        <p>
                            Ver Shreds
                        </p>
                    </a>
                </li>
                <?php if (isset($_SESSION['user'])) : ?>
                    <?php if ($_SESSION['user']['user_rol'] != CodeShred\Controllers\UsersController::ADMIN) { ?>
                        <li class="nav-item" title="Usuarios">
                            <a href="/usuarios" class="nav-link cs-fl cs-fl-just-c <?php echo $section === '/usuarios' ? 'active' : ''; ?>">
                                <i class="fas fa-users"></i>
                                <p>
                                    Usuarios
                                </p>
                            </a>
                        </li>
                    <?php } ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['user'])) : ?>
                    <?php if ($_SESSION['user']['user_rol'] == CodeShred\Controllers\UsersController::ADMIN) { ?>
                        <li class="nav-item" title="Tickets">
                            <a href="/tickets" class="nav-link cs-fl cs-fl-just-c <?php echo $section === '/tickets' ? 'active' : ''; ?>">
                                <i class="fas fa-cogs"></i>
                                <p>
                                    Admin | Tickets
                                </p>
                            </a>
                        </li>
                    <?php } ?>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <div class="aside-hider cs-fl cs-fl-just-c cs-fl-align-c <?php echo isset($_COOKIE['foldedCookie']) ? 'aside-hider-folded' : ''; ?>" id="aside-hider">
        <i class="fas fa-angle-left"></i>
        <i class="fas fa-angle-right"></i>
    </div>

</aside>