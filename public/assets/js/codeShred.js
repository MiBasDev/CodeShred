
const asideHider = document.getElementById('aside-hider');
const aside = document.getElementsByTagName('aside')[0];
const main = document.getElementsByTagName('main')[0];
const footer = document.getElementsByTagName('footer')[0];


asideHider.addEventListener('click', () => {
    if (aside.classList.contains('folded-aside')) {
        aside.classList.remove('folded-aside');
    } else {
        aside.classList.add('folded-aside');
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
});