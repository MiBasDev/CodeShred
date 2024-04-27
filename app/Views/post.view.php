<!--Main-->
<main class="cs-fl-col cs-fl-align-c <?= isset($_COOKIE['foldedCookie']) ? 'folded-others' : '';?>">
    <div class="container-code">
        <div class="code-background">
            <label for="html-code" class="code-title cs-fl cs-fl-align-c">
                <i class="fab fa-html5"></i>
                <p>HTML</p>
            </label>
            <textarea name="html-code" id="html-code" <?php echo isset($section) && strpos($section, '/post/') !== 0 ? 'disabled' : ''; ?>></textarea>
        </div>
        <div class="code-background">
            <label for="css-code" class="code-title cs-fl cs-fl-align-c">
                <i class="fab fa-css3-alt"></i>
                <p>CSS</p>
            </label>
            <textarea name="css-code" id="css-code" <?php echo isset($section) && strpos($section, '/post/') !== 0 ? 'disabled' : ''; ?>></textarea>
        </div>
        <div class="code-background">
            <label for="js-code" class="code-title cs-fl cs-fl-align-c">
                <i class="fab fa-js-square"></i>
                <p>JS</p>
            </label>
            <textarea name="js-code" id="js-code" <?php echo isset($section) && strpos($section, '/post/') !== 0 ? 'disabled' : ''; ?>></textarea>
        </div>
    </div>
    <div id="final-code-container">
        <h2>Output</h2>
        <div id="final-code"><iframe id="my-iframe" src="/app/Views/iframe.html"></iframe></div>
        <div>
            <style id="final-code-style"></style>
            <script id="final-code-script" type="text/javascript"></script>
        </div>
    </div>