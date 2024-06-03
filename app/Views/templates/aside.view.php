<div class="overlay" id="overlay" aria-hidden="true"></div>
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
                <a href="/mi-cuenta" class="button-secondary <?php echo isset($_SESSION['user']) && isset($_SESSION['user']['user_gravatar']) ? 'gravatar' : ''; ?>" title="<?php echo $_SESSION['user']['user'] ?>">
                    <?php if (isset($_SESSION['user']) && isset($_SESSION['user']['user_gravatar'])) { ?>
                        <img id="profile-pic-hamburger" src="<?php echo htmlspecialchars($_SESSION['user']['user_gravatar']); ?>" alt="Imagen de perfil de <?php echo $_SESSION['user']['user']; ?>">
                    <?php } else { ?>
                        <i class="fas fa-user"></i><span class="hidden-element">Mi cuenta</span>
                    <?php } ?>
                </a> 
                <a href="/logout" class="logout button-primary" id="hamburger-logout"><i class="fas fa-sign-out-alt"></i><span class="hidden-element">Logout</span></a>
            </div>
        <?php } ?>
        <a href="/<?php echo isset($_SESSION['user']) ? 'post/add' : 'login'; ?>" class="cs-fl cs-fl-just-c" id="button-create-shred" aria-label="Crear nuevo shred"><span>Crear Shred</span><span class="fas fa-code"></span></a>

        <!-- Sidebar Menu -->
        <nav aria-label="Menú de navegación principal">
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
                <?php endif; ?><?php if (isset($_SESSION['user'])) : ?>
                    <?php if ($_SESSION['user']['user_rol'] != CodeShred\Controllers\UsersController::USER) { ?>
                        <li>
                            <hr class="aside-separator">
                        <li>
                        <li class="nav-item" title="Admin | Shreds">
                            <a href="/admin/posts" class="nav-link cs-fl cs-fl-just-c <?php echo $section === '/admin/posts' ? 'active' : ''; ?>">
                                <i class="far fa-folder-open"></i>
                                <p>
                                    Admin | Shreds
                                </p>
                            </a>
                        </li>
                        <?php if ($_SESSION['user']['user_rol'] == CodeShred\Controllers\UsersController::ADMIN) { ?>
                            <li class="nav-item" title="Admin | Users">
                                <a href="/admin/users" class="nav-link cs-fl cs-fl-just-c <?php echo $section === '/admin/users' ? 'active' : ''; ?>">
                                    <i class="fas fa-users-cog"></i>
                                    <p>
                                        Admin | Usuarios
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item" title="Tickets">
                                <a href="/tickets" class="nav-link cs-fl cs-fl-just-c <?php echo $section === '/admin/tickets' ? 'active' : ''; ?>">
                                    <i class="far fa-clipboard"></i>
                                    <p>
                                        Admin | Tickets
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
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