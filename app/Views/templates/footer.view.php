</main>

<!--Footer position relative si o si-->
<footer class="cs-fl cs-fl-just-c cs-fl-align-c <?= isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="cs-fl">
        <p>
            <a href="/politica-de-privacidad" class="<?= $section === '/politica-de-privacidad' ? 'active' : ''; ?>">Política de privacidad</a>
        </p>
        <p>
            <a href="/politica-de-cookies" class="<?= $section === '/politica-de-cookies' ? 'active' : ''; ?>">Cookies</a>
        </p>
        <p>
            <a href="/contacto" class="<?= $section === '/contacto' ? 'active' : ''; ?>">Contacto</a>
        </p>
    </div>
    <div class="cs-fl">
        <p>
            <a href="#">
                <i class="fab fa-instagram"></i>
            </a>
        </p>
        <p>
            <a href="#">
                <i class="fab fa-github"></i>
            </a>
        </p>
        <p>
            <a href="#">
                <i class="fab fa-twitter"></i>
            </a>
        </p>
    </div>
</footer>
</body>
<script src="assets/js/codeShred.js"></script>
<?php if (isset($section) && strpos($section, '/post/') === 0) : ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.3/purify.min.js"></script>
    <script src="assets/js/postControl.js"></script>
<?php endif; ?>
<?php if (isset($section) && $section == '/mi-cuenta') : ?>
    <script src="assets/js/tabControl.js"></script>
<?php endif; ?>
<script src="assets/js/userAjax.js"></script>
<script src="assets/js/postAjax.js"></script>
<?php if (isset($section) && strpos($section, '/post') === 0 && $section != '/posts') { ?>
    <!--Codemirror-->
    <script type="text/javascript" src="plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/textareaCode.js"></script>
<?php } ?>
</html>
