</main>

<!--Footer position relative si o si-->
<footer class="cs-fl cs-fl-just-c cs-fl-align-c <?php
if (isset($section) && ($section === '/post' || strpos($section, '/post/') === 0)) {
    echo 'folded-others';
}
?>">
    <div class="cs-fl">
        <p>
            <a href="#" class="<?= $section === '/politica-de-privacidad' ? 'active' : ''; ?>">Política de privacidad</a>
        </p>
        <p>
            <a href="#" class="<?= $section === '/cookies' ? 'active' : ''; ?>">Cookies</a>
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
</html>