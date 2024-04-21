<!--Main-->
<main class="cs-fl-col cs-fl-align-c folded-others">
    <div class="container-code">
        <div class="code-background">
            <label for="html-code" class="code-title cs-fl cs-fl-align-c">
                <i class="fab fa-html5"></i>
                <p>HTML</p>
            </label>
            <textarea name="html-code" id="html-code" oninput='customSize(this), updateFinalCodeHTML(this)' <?php echo isset($section) && strpos($section, '/post/') !== 0 ? 'disabled' : ''; ?>></textarea>
        </div>
        <div class="code-background">
            <label for="css-code" class="code-title cs-fl cs-fl-align-c">
                <i class="fab fa-css3-alt"></i>
                <p>CSS</p>
            </label>
            <textarea name="css-code" id="css-code" oninput='customSize(this), updateFinalCodeStyle(this)' <?php echo isset($section) && strpos($section, '/post/') !== 0 ? 'disabled' : ''; ?>></textarea>
        </div>
        <div class="code-background">
            <label for="js-code" class="code-title cs-fl cs-fl-align-c">
                <i class="fab fa-js-square"></i>
                <p>JS</p>
            </label>
            <textarea name="js-code" id="js-code" oninput='customSize(this), updateFinalCodeScript(this)' <?php echo isset($section) && strpos($section, '/post/') !== 0 ? 'disabled' : ''; ?>></textarea>
        </div>
    </div>
    <div id="final-code-container">
        <h2>Output</h2>
        <div id="final-code"></div>
        <div>
            <style id="final-code-style"></style>
            <script id="final-code-script" type="text/javascript"></script>
        </div>
    </div>