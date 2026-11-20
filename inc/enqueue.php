<?php
/**
 * Подключение стилей и скриптов темы
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Регистрируем и подключаем стили темы
 */
function it_enqueue_styles() {
	wp_enqueue_style(
		'italian-taste-style',                              
		ITALIAN_TASTE_URI . '/assets/css/main.css',         
		array(),                                            
		'1.0.0',                                            
		'all'                                               
	);
}
add_action( 'wp_enqueue_scripts', 'it_enqueue_styles' );

/**
 * Подключаем JavaScript темы (Theme Toggle)
 */
function it_enqueue_scripts() {
	wp_enqueue_script(
		'italian-taste-theme-toggle',                       
		ITALIAN_TASTE_URI . '/assets/js/theme-toggle.js',   
		array(),                                            
		'1.0.0',                                            
		true                                                
	);
}
add_action( 'wp_enqueue_scripts', 'it_enqueue_scripts' );

/**
 * Подключаем Font Awesome для иконок
 */
function it_enqueue_font_awesome() {
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );
}
add_action( 'wp_enqueue_scripts', 'it_enqueue_font_awesome' );

/**
 * Подключаем скрипты меню
 */
function it_enqueue_menu_scripts() {
    wp_enqueue_script(
        'italian-taste-menu',
        ITALIAN_TASTE_URI . '/assets/js/menu.js',
        array(),
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'it_enqueue_menu_scripts' );

/**
 * Подключаем GSAP для анимаций
 */
function it_enqueue_gsap() {
    wp_enqueue_script(
        'gsap-core',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
        array(),
        '3.12.5',
        true
    );
    
    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
        array('gsap-core'),
        '3.12.5',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'it_enqueue_gsap' );

/**
 * Подключаем анимации меню
 */
function it_enqueue_menu_animations() {
    wp_enqueue_script(
        'italian-taste-menu-animations',
        ITALIAN_TASTE_URI . '/assets/js/menu-animations.js',
        array('gsap-core', 'gsap-scrolltrigger', 'italian-taste-menu'),
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'it_enqueue_menu_animations' );

/**
 * Подключаем анимации витрины (Showcase)
 */
function it_enqueue_showcase() {
    wp_enqueue_script(
        'italian-taste-showcase',
        ITALIAN_TASTE_URI . '/assets/js/showcase.js',
        array('gsap-core'),
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'it_enqueue_showcase' );

/**
 * Подключаем Flatpickr и скрипт бронирования
 */
function it_enqueue_flatpickr() {
    // Стили Flatpickr
    wp_enqueue_style(
        'flatpickr',
        'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css',
        array(),
        '4.6.13'
    );
    
    // Ядро Flatpickr
    wp_enqueue_script(
        'flatpickr',
        'https://cdn.jsdelivr.net/npm/flatpickr',
        array(),
        '4.6.13',
        true
    );
    
    // Русская локаль Flatpickr (зависит от ядра)
    wp_enqueue_script(
        'flatpickr-ru',
        'https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ru.js',
        array('flatpickr'),
        '4.6.13',
        true
    );
    
    // Наш кастомный скрипт инициализации (зависит от ядра и локали)
    wp_enqueue_script(
        'italian-taste-booking',
        ITALIAN_TASTE_URI . '/assets/js/booking.js',
        array('flatpickr', 'flatpickr-ru'),
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'it_enqueue_flatpickr' );

/**
 * Подключаем ScrollTrigger анимации
 */
function it_enqueue_scroll_animations() {
    wp_enqueue_script(
        'italian-taste-scroll-animations',
        ITALIAN_TASTE_URI . '/assets/js/scroll-animations.js',
        array('gsap-core', 'gsap-scrolltrigger'),
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'it_enqueue_scroll_animations' );