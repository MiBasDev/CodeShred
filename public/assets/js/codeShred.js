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