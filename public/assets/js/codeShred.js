const asideHider = document.getElementById('aside-hider');
const aside = document.getElementsByTagName('aside')[0];
const main = document.getElementsByTagName('main')[0];
const footer = document.getElementsByTagName('footer')[0];
const navLinkPs = document.querySelectorAll('aside .nav-link p');

asideHider.addEventListener('click', () => {
    let folded;
    if (aside.classList.contains('folded-aside')) {
        aside.classList.remove('folded-aside');
        folded = false;
    } else {
        aside.classList.add('folded-aside');
        folded = true;
    }

    if (main.classList.contains('folded-others')) {
        main.classList.remove('folded-others');
    } else {
        main.classList.add('folded-others');
    }

    if (footer.classList.contains('folded-others')) {
        footer.classList.remove('folded-others');
    } else {
        footer.classList.add('folded-others');
    }

    if (asideHider.classList.contains('aside-hider-folded')) {
        asideHider.classList.remove('aside-hider-folded');
    } else {
        asideHider.classList.add('aside-hider-folded');
    }

    if (!folded) {
        setTimeout(() => {
            navLinkPs.forEach(p => {
                p.style.display = 'block';
            });
        }, 200);
    } else {
        navLinkPs.forEach(p => {
            p.style.display = 'none';
        });
    }
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