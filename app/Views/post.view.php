<!--Main-->
<main class="cs-fl-col cs-fl-align-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>" role="main">
    <div class="cs-fl cs-fl-align-c post-action-buttons">
        <h1 class="hidden-element">Post</h1>
        <div class="cs-fl cs-fl-align-c">
            <?php if (isset($section) && strpos($section, '/post') === 0 && $section !== '/posts') { ?>
                <label for="post-title-two" class="hidden-element">Usuario</label>
                <input type="text" name="title" id="post-title-two" class="form-control" value="<?php echo isset($post) ? $post['post_title'] : ''; ?>" placeholder="Título" <?php echo isset($section) && strpos($section, '/post/') !== 0 ? 'disabled' : ''; ?>>
            <?php } ?>
        </div>
        <div class="cs-fl cs-fl-align-c">
            <?php if (isset($_SESSION['user']) && isset($section) && $section == '/post/edit') { ?>
                <button class="button-warning" onclick="openDeletePopup()"><i class="fas fa-trash-alt"></i><span class="hidden-element">Borrar Shred</span></button>
            <?php } ?>
            <?php if (isset($_SESSION['user']) && isset($section) && strpos($section, '/post/') === 0) { ?>
                <button class="button-primary" onclick="saveAndOpenPopup()">Guardar</button>
            <?php } ?>
        </div>
    </div>
    <div class="container-code">
        <?php
        if (isset($post)) {
            $post_code = json_decode($post['post_code']);
        }
        ?>
        <!-- HTML -->
        <div id="html" class="tabcontent code-background active">
            <div class="code-title cs-fl cs-fl-align-c">
                <div class="cs-fl code-textarea-title">
                    <i class="fab fa-html5"></i>
                    <span>HTML</span>
                </div>
                <div class="tabs">
                    <button class="tablinks active" onclick="showCodeEditor('html')"><i class="fab fa-html5"></i> HTML</button>
                    <button class="tablinks" onclick="showCodeEditor('css')"><i class="fab fa-css3-alt"></i> CSS</button>
                    <button class="tablinks" onclick="showCodeEditor('js')"><i class="fab fa-js-square"></i> JS</button>
                </div>
            </div>
            <label for="html-code" class="hidden-element">Código HTML</label>
            <textarea name="html-code" id="html-code" <?php echo isset($section) && strpos($section, '/post/') !== 0 ? 'disabled' : ''; ?>><?php echo isset($post_code) && !empty($post_code->html) ? $post_code->html : ''; ?></textarea>
            <?php if (isset($section) && strpos($section, '/post/add') !== 0) { ?>
                <button id="copy-html-button" class="post-code-copy" title="Copiar código HTML"><span class="fas fa-copy"></span></button>
            <?php } ?>
        </div>
        <!-- CSS -->
        <div id="css" class="tabcontent code-background">
            <div class="code-title cs-fl cs-fl-align-c">
                <div class="cs-fl code-textarea-title">
                    <i class="fab fa-css3-alt"></i>
                    <span>CSS</span>
                </div>
                <div class="tabs">
                    <button class="tablinks" onclick="showCodeEditor('html')"><i class="fab fa-html5"></i> HTML</button>
                    <button class="tablinks active" onclick="showCodeEditor('css')"><i class="fab fa-css3-alt"></i> CSS</button>
                    <button class="tablinks" onclick="showCodeEditor('js')"><i class="fab fa-js-square"></i> JS</button>
                </div>
            </div>
            <label for="css-code" class="hidden-element">Código CSS</label>
            <textarea name="css-code" id="css-code" <?php echo isset($section) && strpos($section, '/post/') !== 0 ? 'disabled' : ''; ?>><?php echo isset($post_code) && !empty($post_code->css) ? $post_code->css : ''; ?></textarea>
            <?php if (isset($section) && strpos($section, '/post/add') !== 0) { ?>
                <button id="copy-css-button" class="post-code-copy" title="Copiar código CSS"><span class="fas fa-copy"></span></button>
            <?php } ?>
        </div>
        <!-- JS -->
        <div id="js" class="tabcontent code-background">
            <div class="code-title cs-fl cs-fl-align-c">
                <div class="cs-fl code-textarea-title">
                    <i class="fab fa-js-square"></i>
                    <span>JS</span>
                </div>
                <div class="tabs">
                    <button class="tablinks" onclick="showCodeEditor('html')"><i class="fab fa-html5"></i> HTML</button>
                    <button class="tablinks" onclick="showCodeEditor('css')"><i class="fab fa-css3-alt"></i> CSS</button>
                    <button class="tablinks active" onclick="showCodeEditor('js')"><i class="fab fa-js-square"></i> JS</button>
                </div>
            </div>
            <label for="js-code" class="hidden-element">Código JavaScript</label>
            <textarea name="js-code" id="js-code" <?php echo isset($section) && strpos($section, '/post/') !== 0 ? 'disabled' : ''; ?>><?php echo isset($post_code) && !empty($post_code->js) ? $post_code->js : ''; ?></textarea>
            <?php if (isset($section) && strpos($section, '/post/add') !== 0) { ?>
                <button id="copy-js-button" class="post-code-copy" title="Copiar código JS"><span class="fas fa-copy"></span></button>
            <?php } ?>
        </div>
    </div>
    <!-- IFRAME PREVIEW -->
    <div id="final-code-container">
        <div id="final-code"><iframe id="my-iframe" sandbox="allow-same-origin allow-scripts" aria-label="Preview del código"></iframe></div>
    </div>

    <div id="popup" class="popup">
        <div class="popup-content cs-fl-col">
            <div class="popup-title cs-fl">
                <h2>¿Quieres guardar este Shred?</h2>
                <span class="close-popup" onclick="closePopup()" onkeydown="if (event.keyCode === 13 || event.keyCode === 32) {
                            closePopup() // (sof)
                        }" tabindex="0"><span class="fas fa-times"></span><span class="hidden-element">Cerrar popup</span></span>
            </div>
            <form action="<?php echo isset($section) && $section == '/post/add' ? '/post/add' : '/post/edit/' . $post['id_post']; ?>" method="POST" id="popup-form" class="cs-fl-col ">
                <div class="popup-img-container-all">
                    <div id="popup-image-container" style="width: 100%; height: 100%"></div>
                    <div class="include-img cs-fl cs-fl-just-c">
                        <label for="include-img">Incluir imagen</label>
                        <input type="checkbox" id="include-img" name="include-img" checked>
                    </div>
                </div>
                <input type="hidden" id="post-img-data" name="post-img-data">
                <div class="popup-input cs-fl-col cs-fl-just-c">
                    <label for="shred-title">Title:</label>
                    <input type="text" id="shred-title" name="shred-title" class="form-control">
                </div>
                <div class="popup-input-hide cs-fl-col cs-fl-just-c">
                    <label for="shred-html">HTML:</label>
                    <textarea id="shred-html" name="shred-html" class="form-control"></textarea>
                </div>
                <div class="popup-input-hide cs-fl-col cs-fl-just-c">
                    <label for="shred-css">CSS:</label>
                    <textarea id="shred-css" name="shred-css" class="form-control"></textarea>
                </div>
                <div class="popup-input-hide cs-fl-col cs-fl-just-c">
                    <label for="shred-js">JS:</label>
                    <textarea id="shred-js" name="shred-js" class="form-control"></textarea>
                </div>
                <div class="popup-button cs-fl">
                    <button type="submit" class="button-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <?php if (isset($section) && strpos($section, '/post/edit') === 0) { ?>
        <div id="popup-delete" class="popup-delete">
            <div class="popup-delete-content cs-fl-col">
                <div class="popup-delete-title cs-fl cs-fl-just-c">
                    <h2>¿Seguro que quieres eliminar este Shred?</h2>
                </div>
                <form action="/post/delete/<?php echo $post['id_post']; ?>" method="POST" id="popup-form" class="cs-fl-col">
                    <div class="popup-delete-button cs-fl">
                        <button type="button" class="button-secondary" onclick="closeDeletePopup()">Volver atrás</button>
                        <button type="submit" class="button-warning">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>