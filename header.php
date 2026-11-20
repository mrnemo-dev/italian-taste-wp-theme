<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
        <?php wp_head(); ?>
    <script>
    /*
     * Анти-FOUC: ставим data-theme ДО первой отрисовки страницы.
     *
     * Почему здесь, а не в отдельном файле:
     * - Этот скрипт должен выполниться синхронно, пока браузер ещё
     *   не начал рисовать body. Если вынести его в footer с defer —
     *   пользователь увидит мигание темы.
     * - Он крошечный (3 строки), поэтому inline здесь оправдан.
     *
     * Логика: читаем сохранённый выбор из localStorage. Если светлая —
     * ставим data-theme="light", CSS-переменные светлой темы применятся
     * ещё до того, как браузер нарисует первый пиксель.
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
        
        <!-- Кнопки -->
        <div class="site-header__actions">
            <button class="theme-toggle" id="themeToggle">
                🌙 Тёмная
            </button>
            <a href="#booking" class="btn-reserve">Забронировать</a>
        </div>
    </div>
</header>