<!--Main-->
<main class="cs-fl-col cs-fl-align-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="container-code">
        <?php
        if (isset($post)) {
            $post_code = json_decode($post['post_code']);
        }
        ?>
        <div class="code-background">
            <label for="html-code" class="code-title cs-fl cs-fl-align-c">
                <i class="fab fa-html5"></i>
                <p>HTML</p>
            </label>
            <textarea name="html-code" id="html-code" <?php echo isset($section) && strpos($section, '/post/') !== 0 ? 'disabled' : ''; ?>><?php echo isset($post_code) && !empty($post_code->html) ? $post_code->html : ''; ?></textarea>
            <?php if (isset($section) && strpos($section, '/post/add') !== 0) { ?>
                <button id="copy-html-button" class="post-code-copy" title="Copiar código HTML"><span class="fas fa-copy"></span></button>
            <?php } ?>
        </div>
        <div class="code-background">
            <label for="css-code" class="code-title cs-fl cs-fl-align-c">
                <i class="fab fa-css3-alt"></i>
                <p>CSS</p>
            </label>
            <textarea name="css-code" id="css-code" <?php echo isset($section) && strpos($section, '/post/') !== 0 ? 'disabled' : ''; ?>><?php echo isset($post_code) && !empty($post_code->css) ? $post_code->css : ''; ?></textarea>
            <?php if (isset($section) && strpos($section, '/post/add') !== 0) { ?>
                <button id="copy-css-button" class="post-code-copy" title="Copiar código CSS"><span class="fas fa-copy"></span></button>
            <?php } ?>
        </div>
        <div class="code-background">
            <label for="js-code" class="code-title cs-fl cs-fl-align-c">
                <i class="fab fa-js-square"></i>
                <p>JS</p>
            </label>
            <textarea name="js-code" id="js-code" <?php echo isset($section) && strpos($section, '/post/') !== 0 ? 'disabled' : ''; ?>><?php echo isset($post_code) && !empty($post_code->js) ? $post_code->js : ''; ?></textarea>
            <?php if (isset($section) && strpos($section, '/post/add') !== 0) { ?>
                <button id="copy-js-button" class="post-code-copy" title="Copiar código JS"><span class="fas fa-copy"></span></button>
            <?php } ?>
        </div>
    </div>
    <div id="final-code-container">
        <div id="final-code"><iframe id="my-iframe" sandbox="allow-same-origin allow-scripts"></iframe></div>
    </div>

    <div id="popup" class="popup">
        <div class="popup-content cs-fl-col">
            <div class="popup-title cs-fl">
                <h2>¿Quieres guardar este Shred?</h2>
                <span class="close-popup" onclick="closePopup()">&times;</span>
            </div>
            <form action="<?php echo isset($section) && $section == '/post/add' ? '/post/add' : '/post/edit/' . $post['id_post']; ?>" method="POST" id="popup-form" class="cs-fl-col ">
                <div id="popup-image-container" style="width: 100%; height: 100%"></div>
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



    <div id="popup-delete" class="popup-delete">
        <div class="popup-delete-content cs-fl-col">
            <div class="popup-delete-title cs-fl cs-fl-just-c">
                <h2>¿Seguro que quieres borrar este Shred?</h2>
            </div>
            <form action="/post/delete/<?php echo $post['id_post']; ?>" method="POST" id="popup-form" class="cs-fl-col">
                <div class="popup-delete-button cs-fl">
                    <button type="button" class="button-secondary" onclick="closeDeletePopup()">Volver atrás</button>
                    <button type="submit" class="button-warning">Borrar</button>
                </div>
            </form>
        </div>
    </div>
