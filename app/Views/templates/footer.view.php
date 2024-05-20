<!--Notificaciones-->
<div class="cs-fl-col cs-fl-just-c user-notificactions" id="user-notificactions">
    <h3>Nueva notifiación</h3>
    <p id="notification-message"></p>
</div>
</main>

<!--Footer position relative si o si-->
<footer class="cs-fl cs-fl-just-c cs-fl-align-c <?php echo isset($_COOKIE['foldedCookie']) ? 'folded-others' : ''; ?>">
    <div class="cs-fl">
        <a href="/politica-de-privacidad" class="<?php echo $section === '/politica-de-privacidad' ? 'active' : ''; ?>">Política de privacidad</a>
        <a href="/politica-de-cookies" class="<?php echo $section === '/politica-de-cookies' ? 'active' : ''; ?>">Cookies</a>
        <a href="/contacto" class="<?php echo $section === '/contacto' ? 'active' : ''; ?>">Contacto</a>
    </div>
    <div class="cs-fl">
        <a href="https://twitter.com/codeShred" target="_blank">
            <i class="fab fa-instagram"></i><span class="hidden-element">Instagram</span>
        </a>
        <a href="https://github.com/MiBasDev/codeShred" target="_blank">
            <i class="fab fa-github"></i><span class="hidden-element">GitHub</span>
        </a>
        <a href="https://www.instagram.com/codeShred" target="_blank">
            <i class="fab fa-twitter"></i><span class="hidden-element">Twitter</span>
        </a>
    </div>
</footer>
<script src="assets/js/codeShred.js"></script>
<?php if (isset($section) && strpos($section, '/post/') === 0) : ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.3/purify.min.js"></script>
    <script src="assets/js/postControl.js"></script>
<?php endif; ?>
<?php if (isset($section) && $section == '/mi-cuenta' || $section == '/admin/users' || $section == '/admin/posts') : ?>
    <script src="assets/js/tabControl.js"></script>
<?php endif; ?>
<script src="assets/js/userAjax.js"></script>
<script src="assets/js/postAjax.js"></script>
<?php if (isset($section) && strpos($section, '/post') === 0 && $section != '/posts') { ?>
    <!--Codemirror-->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="assets/js/textareaCode.js"></script>
<?php } ?>
<?php if (isset($section) && $section == '/tickets') : ?>
    <script src="assets/js/ticketAjax.js"></script>
<?php endif; ?>
<?php if (isset($_SESSION['user'])) { ?>
    <script>
        // Pasar el userId desde PHP a una variable JavaScript
        //const userId = <?php //echo json_encode($_SESSION['user']['id_user']);   ?>;
    </script>
    <script src="assets/js/notificationWorker.js"></script>
<?php } ?>
</body>
</html>