const asideHider = document.getElementById('aside-hider');
asideHider.addEventListener('click', () => {
    const aside = document.querySelector('aside');
    const main = document.querySelector('main');
    const footer = document.querySelector('footer');
    const navLinkPs = document.querySelectorAll('aside .nav-link p');

    aside.classList.toggle('folded-aside');
    main.classList.toggle('folded-others');
    footer.classList.toggle('folded-others');
    asideHider.classList.toggle('aside-hider-folded');

    navLinkPs.forEach(p => {
        p.style.display = aside.classList.contains('folded-aside') ? 'none' : 'block';
    });

    const functionName = 'ajaxHandler';
    const action = 'toggleFolded';
    console.log('hola');
    
    fetch('/app/Controllers/UsuarioController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            functionName: functionName,
            action: action,
        }),
    })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch(error => console.error('Error al realizar la solicitud AJAX:', error));
});



const htmlCodeTx = document.getElementById('html-code');
const cssCodeTx = document.getElementById('css-code');
const jsCodeTx = document.getElementById('js-code');
const finalCode = document.getElementById('final-code');

htmlCodeTx.addEventListener('input', mostrarResultado);
cssCodeTx.addEventListener('input', mostrarResultado);
jsCodeTx.addEventListener('input', mostrarResultado);

function mostrarResultado() {
    const iframe = document.createElement('iframe');
    iframe.style.width = '100%';
    iframe.style.height = '100%';

    iframe.sandbox = 'allow-scripts';

    const htmlCode = htmlCodeTx.value;
    const cssCode = '<style>' + cssCodeTx.value + '</style>';
    const jsCode = '<script>' + jsCodeTx.value + '</script>';
    const allCode = htmlCode + cssCode + jsCode;

    const saveCode = DOMPurify.sanitize(allCode);

    const doc = iframe.contentDocument;
    if (doc) {
        doc.open();
        doc.write(saveCode);
        doc.close();

        finalCode.innerHTML = '';
        finalCode.appendChild(iframe);
    } else {
        console.error('El iframe no se ha creado correctamente.');
    }
}

