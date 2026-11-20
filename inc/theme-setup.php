<?php
/**
 * Базовые настройки темы
 * 
 * Здесь регистрируем поддержку фич WordPress:
 * - Меню навигации
 * - Миниатюры записей (thumbnails)
 * - Title-tag (SEO)
 * - Подключение Google Fonts с preconnect
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Регистрируем поддержку фич темы
 * 
 * Хук after_setup_theme срабатывает после загрузки темы,
 * но до вывода HTML. Здесь мы говорим WP: "мы поддерживаем эти фичи".
 */
function it_theme_setup() {
	// Поддержка миниатюр записей (для блога и блюд)
	add_theme_support( 'post-thumbnails' );
	
	// Поддержка title-tag (SEO, WordPress сам генерирует <title>)
	add_theme_support( 'title-tag' );
	
	// Регистрация меню навигации (хедер, футер)
	register_nav_menus( array(
		'primary' => __( 'Главное меню', 'italian-taste' ),
		'footer'  => __( 'Меню футера', 'italian-taste' ),
	) );
}
add_action( 'after_setup_theme', 'it_theme_setup' );

/**
 * Подключаем Google Fonts с preconnect для производительности
 * 
 * Почему preconnect: браузер устанавливает соединение с Google Fonts
 * заранее, до того как нужен шрифт. Это ускоряет загрузку на 100-200мс.
 * 
 * Почему wp_enqueue_style, а не <link> в header.php:
 * - WordPress управляет порядком загрузки
 * - Можно отключить через хуки
 * - Правильное кэширование
 */
function it_enqueue_google_fonts() {
	// Preconnect к Google Fonts (ускоряет загрузку)
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
	
	// Подключаем шрифты: Playfair Display (заголовки) + Inter (текст)
	// weight=400;700 — обычный и жирный для каждого шрифта
	wp_enqueue_style(
		'google-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Playfair+Display:wght@400;700&display=swap',
		array(),
		null,  // Без версии (шрифты кэшируются Google)
		'all'
	);
}
add_action( 'wp_head', 'it_enqueue_google_fonts', 1 ); // Приоритет 1 — чтобы preconnect был в самом начале <head>