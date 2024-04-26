<!--Aside-->
<aside class="cs-fl <?= isset($_COOKIE['foldedCookie']) ? 'folded-aside' : ''; ?>" id="aside">
    <div class="aside-content cs-fl-col cs-fl-align-c">
        <a href="/<?= isset($_SESSION['user']) ? 'post/add' : 'login'; ?>">
            <button class="cs-fl cs-fl-just-c" id="button-create-shred"><span>Crear</span><span>Shred</span></button>
        </a>

        <!-- Sidebar Menu -->
        <nav>
            <ul class="nav">
                <?php if (isset($_SESSION['user'])) : ?>
                    <li class="nav-item" title="Mis Shreds">
                        <a href="/mi-cuenta/mis-posts" class="nav-link cs-fl cs-fl-just-c <?= $section === '/mi-cuenta/mis-posts' ? 'active' : ''; ?>">
                            <i class="far fa-file-code"></i>
                            <p>
                                Mis Shreds
                            </p>
                        </a>
                    </li>
                    <li class="nav-item" title="Siguiendo">
                        <a href="/siguiendo" class="nav-link cs-fl cs-fl-just-c <?= $section === '/siguiendo' ? 'active' : ''; ?>">
                            <i class="fas fa-user-friends"></i>
                            <p>
                                Siguiendo
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item" title="Ver Shreds">
                    <a href="/posts" class="nav-link cs-fl cs-fl-just-c <?= $section === '/posts' ? 'active' : ''; ?>">
                        <i class="fas fa-laptop-code"></i>
                        <p>
                            Ver Shreds
                        </p>
                    </a>
                </li>
                <?php if (isset($_SESSION['user'])) : ?>
                    <li class="nav-item" title="Usuarios">
                        <a href="/usuarios" class="nav-link cs-fl cs-fl-just-c <?= $section === '/usuarios' ? 'active' : ''; ?>">
                            <i class="fas fa-users"></i>
                            <p>
                                Usuarios
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <div class="aside-hider cs-fl cs-fl-just-c cs-fl-align-c <?= isset($_COOKIE['foldedCookie']) ? 'aside-hider-folded' : ''; ?>" id="aside-hider">
        <i class="fas fa-angle-left"></i>
        <i class="fas fa-angle-right"></i>
    </div>

</aside>