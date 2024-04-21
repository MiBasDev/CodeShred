<!--Main-->
<main class="cs-fl-col cs-fl-align-c <?= $section == '/post' ? 'folded-others' : ''; ?>">
    <div class="container-code">
        <div class="code-background">
            <label for="html-code" class="code-title cs-fl cs-fl-align-c">
                <i class="fab fa-html5"></i>
                <p>HTML</p>
            </label>
            <textarea name="html-code" id="html-code" oninput='customSize(this), updateFinalCodeHTML(this)'></textarea>
        </div>
        <div class="code-background">
            <label for="css-code" class="code-title cs-fl cs-fl-align-c">
                <i class="fab fa-css3-alt"></i>
                <p>CSS</p>
            </label>
            <textarea name="css-code" id="css-code" oninput='customSize(this), updateFinalCodeStyle(this)'></textarea>
        </div>
        <div class="code-background">
            <label for="js-code" class="code-title cs-fl cs-fl-align-c">
                <i class="fab fa-js-square"></i>
                <p>JS</p>
            </label>
            <textarea name="js-code" id="js-code" oninput='customSize(this), updateFinalCodeScript(this)'></textarea>
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
    <script>
        function updateFinalCodeHTML(textarea) {
            var textareaContent = textarea.value;
            var finalCodeDiv = document.getElementById('final-code');

            finalCodeDiv.innerHTML = "";

            if (validarCodigo(textareaContent, "html")) {
                if (containsBalancedTagsHTML(textareaContent)) {
                    finalCodeDiv.innerHTML = textareaContent;
                } else {
                    finalCodeDiv.innerText = textareaContent;
                }
            }
        }

        function updateFinalCodeStyle(textarea) {
            var textareaContent = textarea.value;
            var finalCodeStyle = document.getElementById('final-code-style');

            // Limpiamos el contenido previo del div
            finalCodeStyle.innerHTML = "";
            finalCodeStyle.innerHTML = textareaContent;

        }

        function updateFinalCodeScript(textarea) {
            var scriptContent = document.getElementById("js-code").value;
            var scriptElement = document.getElementById("final-code-script");

            scriptElement.innerHTML = "";

            var funcion = new Function(scriptContent);

            try {
                funcion();
            } catch (error) {
            }
        }

        function containsBalancedTagsHTML(content) {
            var tagPattern = /<\/?[a-z][\s\S]*?>/ig;
            var match;
            var stack = [];

            while ((match = tagPattern.exec(content)) !== null) {
                if (match[0].startsWith("</")) {
                    if (stack.length === 0) {
                        return false;
                    }
                    stack.pop();
                } else {
                    stack.push(match[0]);
                }
            }
            return stack.length === 0;
        }

        function validarCodigo(codigo, tipo) {
            // Sanitización básica
            codigo = codigo.replace(/<|>|&|"/g, '');
            codigo = codigo.replace(/</g, '&lt;');
            codigo = codigo.replace(/>/g, '&gt;');

            // Validación de longitud
            if (codigo.length > 1000) {
                return false;
            }

            // Validación específica por tipo
            switch (tipo) {
                case "html":
                    // Validación de etiquetas HTML
                    break;
                case "css":
                    // Validación de reglas CSS
                    // Puedes usar una biblioteca como CSSLint: https://csslint.net/
                    break;
                case "js":
                    try {
                        new Function(codigo);
                    } catch (error) {
                        return false;
                    }
                    // Puedes usar una biblioteca como jslint: https://www.jslint.com/
                    break;
            }

            // Buscar patrones de código malicioso
            if (codigo.match(/<script>/g) || codigo.match(/alert\(/g)) {
                return false;
            }

            return true;
        }
    </script>