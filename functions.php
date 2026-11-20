<?php
/**
 * Italian Taste — Bootstrap темы
 * 
 * Этот файл НЕ содержит бизнес-логику.
 * Его единственная задача — определить константы и подключить модули из /inc.
 * Так functions.php не превратится в свалку на 2000 строк через полгода.
 */

// Защита от прямого доступа к файлу через браузер.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Константы путей.
 * DIR  — физический путь на диске (для require_once, file_exists).
 * URI  — URL-путь (для wp_enqueue_style, wp_get_image).
 */
define( 'ITALIAN_TASTE_DIR', get_template_directory() );
define( 'ITALIAN_TASTE_URI', get_template_directory_uri() );

/**
 * Безопасный загрузчик модулей из /inc.
 * 
 * Если файл отсутствует — сайт не упадёт с Fatal Error,
 * а просто продолжит работать без этого модуля.
 * 
 * @param string $file Имя файла без расширения .php
 */
function it_include( string $file ): void {
	$path = ITALIAN_TASTE_DIR . '/inc/' . $file . '.php';
	if ( file_exists( $path ) ) {
		require_once $path;
	}
}

/*
 * Порядок подключения модулей:
 * 1. theme-setup — базовые фичи WP (меню, миниатюры, title-tag).
 * 2. cpt         — типы записей (Блюда, Шефы, Отзывы).
 * 3. acf         — поля ACF привязываются к CPT, значит после него.
 * 4. helpers     — функции, которые могут использоваться в enqueue и шаблонах.
 * 5. enqueue     — подключает CSS/JS, использует helpers для версий файлов.
 * 6. ajax        — обработчики AJAX запросов.
 */
it_include( 'theme-setup' );
it_include( 'cpt' );
it_include( 'acf-integration' );
it_include( 'helpers' );
it_include( 'enqueue' );
it_include( 'ajax' );