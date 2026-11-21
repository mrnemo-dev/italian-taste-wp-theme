/**
 * Логика мобильного бургер-меню
 */
(function () {
    const burger = document.getElementById('burgerMenu');
    const nav = document.querySelector('.site-header__nav');
    
    if (!burger || !nav) return;

    // Клик по бургеру
    burger.addEventListener('click', () => {
        nav.classList.toggle('is-open');
        burger.classList.toggle('is-active');
        document.body.classList.toggle('menu-open');
    });

    // Закрытие меню при клике на любую ссылку внутри него
    nav.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            nav.classList.remove('is-open');
            burger.classList.remove('is-active');
            document.body.classList.remove('menu-open');
        });
    });
})();