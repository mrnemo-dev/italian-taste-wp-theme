<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php wp_head(); ?>

    <script>
    /*
     * Анти-FOUC: ставим data-theme ДО первой отрисовки страницы.
     */
    (function () {
        try {
            var saved = localStorage.getItem('it-theme');
            if (saved === 'light') {
                document.documentElement.setAttribute('data-theme', 'light');
            }
        } catch (e) {
            // localStorage недоступен — оставляем дефолт (тёмная тема).
        }
    })();
    </script>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="site-header__container">
        <!-- Логотип -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo">
            Italian Taste
        </a>
        
        <!-- Навигация -->
        <nav class="site-header__nav">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => '',
                'fallback_cb'    => false,
            ) );
            ?>
        </nav>
        
        <!-- Кнопки действий: тема → бронь → корзина (самая правая) -->
        <div class="site-header__actions">
            
            <!-- Кнопка Бургер (для мобильных) -->
            <button class="burger-menu" id="burgerMenu" aria-label="Открыть меню">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <button class="theme-toggle" id="themeToggle" aria-label="Переключить тему">
                🌙 Тёмная
            </button>

            <a href="#booking" class="btn-reserve">Забронировать</a>

            <button class="cart-toggle" id="cartToggle" aria-label="Открыть корзину">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span class="cart-toggle__count" id="cartCount">0</span>
            </button>
        </div>
    </div>
</header>

<!-- Drawer-корзина (выезжающая панель справа) -->
<div class="cart-drawer" id="cartDrawer" aria-hidden="true">
    <div class="cart-drawer__overlay" id="cartOverlay"></div>
    <div class="cart-drawer__panel">
        <div class="cart-drawer__header">
            <h3>Ваш заказ</h3>
            <button class="cart-drawer__close" id="cartClose" aria-label="Закрыть корзину">&times;</button>
        </div>
        
        <div class="cart-drawer__items" id="cartItems">
            <p class="cart-drawer__empty">Корзина пуста 🍝</p>
        </div>

        <!-- ЕДИНСТВЕННЫЙ footer: итог + контакты + кнопка -->
        <div class="cart-drawer__footer">
            <div class="cart-drawer__total">
                <span>Итого:</span>
                <strong id="cartTotal">0 ₽</strong>
            </div>
            
            <div class="cart-drawer__contact">
                <input type="text" id="cartName" placeholder="Ваше имя" required>
                <input type="tel" id="cartPhone" placeholder="+7 (999) 000-00-00" required>
            </div>

            <button class="btn btn--primary btn--full" id="checkoutBtn">Оформить в Telegram</button>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>