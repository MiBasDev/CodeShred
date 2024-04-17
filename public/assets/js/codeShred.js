function showOrHideAside(rootVar, currentWidth){
    // Verificar el valor actual y cambiarlo en consecuencia
    if (currentWidth === '300px') {
        rootVar.style.setProperty('--aside-width', '100px');
    } else if (currentWidth === '100px') {
        rootVar.style.setProperty('--aside-width', '300px');
    }
}