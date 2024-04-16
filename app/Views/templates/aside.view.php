<!--Aside-->
<aside class="flex">
    <div class="aside-content flex-col flex-align-c">
        <div class="flex flex-align-c">
            <a href="/">
                <img src="assets/img/codeShred-logo-dark.png" alt="Logo codeShred" id="logo-aside">
            </a>
        </div>

        <a href="/post">
            <button id="button-create-shred">Crear Shred</button>
        </a>

        <!-- Sidebar Menu -->
        <nav>
            <ul class="nav">
                <?php
                $isUserLoggedIn = isset($_SESSION['user']);
                if ($isUserLoggedIn) :
                ?>
                    <li class="nav-item">
                        <a href="/mi-cuenta/mis-posts" class="nav-link flex flex-just-c active">
                            <i class="far fa-file-code"></i>
                            <p>
                                Mis Shreds
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/siguiendo" class="nav-link flex flex-just-c ">
                            <i class="fas fa-user-friends"></i>
                            <p>
                                Siguiendo
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="/posts" class="nav-link flex flex-just-c ">
                        <i class="fas fa-laptop-code"></i>
                        <p>
                            Ver Shreds
                        </p>
                    </a>
                </li>
                <?php if ($isUserLoggedIn) :  ?>
                    <li class="nav-item">
                        <a href="/usuarios" class="nav-link flex flex-just-c ">
                            <i class="fas fa-users"></i>
                            <p>
                                Usuarios
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <!--         
            <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-database"></i>
                    <p>
                        DB
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

                
                    <ul class="nav nav-treeview">                        
                        <li class="nav-item">
                            <a href="/usuarios-sistema" class="nav-link <?php echo isset($seccion) && $seccion === '/usuarios-sistema' ? 'active' : ''; ?>">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Usuarios del Sistema</p>
                            </a>
                        </li>                                                
                        <li class="nav-item">
                            <a href="/productos" class="nav-link <?php echo isset($seccion) && $seccion === '/productos' ? 'active' : ''; ?>">
                                <i class="fas fa-shopping-bag nav-icon"></i>
                                <p>Productos</p>
                            </a>
                        </li>                        
                        <li class="nav-item">
                            <a href="/categorias" class="nav-link <?php echo isset($seccion) && $seccion === '/categorias' ? 'active' : ''; ?>">
                                <i class="fas fa-folder nav-icon"></i>
                                <p>Categorías</p>
                            </a>
                        </li>                            
                        <li class="nav-item">
                            <a href="/proveedores" class="nav-link <?php echo isset($seccion) && $seccion === '/proveedores' ? 'active' : ''; ?>">
                                <i class="fas fa-handshake nav-icon"></i>
                                <p>Proveedores</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/post" class="nav-link <?php echo isset($seccion) && $seccion === '/post' ? 'active' : ''; ?>">
                                <i class="fas fa-user-lock nav-icon"></i>
                                <p>Post</p>
                            </a>
                        </li> 
                </ul>
            </li>
            
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-database"></i>
                    <p>
                        Demos
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/demos/usuarios-sistema" class="nav-link <?php echo isset($seccion) && $seccion === '/demos/usuarios-sistema' ? 'active' : ''; ?>">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Usuarios del Sistema</p>
                            </a>
                        </li>
     
                        <li class="nav-item">
                            <a href="/demos/usuarios-sistema/add" class="nav-link <?php echo isset($seccion) && $seccion === '/demos/usuarios-sistema/edit' ? 'active' : ''; ?>">
                                <i class="fas fa-user nav-icon"></i>
                                <p>Alta usuario</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/demos/login" class="nav-link <?php echo isset($seccion) && $seccion === '/categorias' ? 'active' : ''; ?>">
                                <i class="fas fa-user-lock nav-icon"></i>
                                <p>Login</p>
                            </a>
                        </li>  
                </ul>
            </li> -->

            </ul>
        </nav>
    </div>
    <div class="aside-hider" onclick="asideHide()">

    </div>
    <!-- /.sidebar-menu -->

</aside>