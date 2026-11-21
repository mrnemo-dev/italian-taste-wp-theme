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

/**
 * Создаём страницу настроек темы в админке
 * Теперь все поля ACF будут в одном месте: Внешний вид → Настройки Italian Taste
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => 'Настройки Italian Taste',
        'menu_title'    => 'Настройки Italian Taste',
        'menu_slug'     => 'italian-taste-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false,
        'position'      => '59.5', // Позиция в меню (после "Внешний вид")
    ));
}

/**
 * Передаём AJAX URL и nonce в JS для корзины
 */
function it_localize_cart_ajax() {
    wp_localize_script('italian-taste-cart', 'it_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('it_telegram_order_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'it_localize_cart_ajax', 20); // После подключения cart.js

/**
 * Обработчик отправки заказа в Telegram
 */
function it_send_order_to_telegram() {
    // 1. Проверка безопасности (nonce)
    check_ajax_referer('it_telegram_order_nonce', 'nonce');

    // 2. Получаем и чистим данные
    $name  = sanitize_text_field($_POST['name']);
    $phone = sanitize_text_field($_POST['phone']);
    $items = json_decode(stripslashes($_POST['items']), true);
    $total = intval($_POST['grandTotal']);

    // 3. Формируем красивое сообщение
    $message = "🍝 *Новый заказ — Italian Taste*\n\n";
    $message .= "👤 *Имя:* {$name}\n";
    $message .= "📞 *Телефон:* {$phone}\n\n";
    $message .= "🛒 *Состав заказа:*\n";
    
    foreach ($items as $item) {
        $message .= "• {$item['name']} × {$item['qty']} = {$item['total']} ₽\n";
    }
    
    $message .= "\n💰 *Итого:* {$total} ₽";

    // 4. Отправляем в Telegram
    $bot_token = defined('IT_TELEGRAM_BOT_TOKEN') ? IT_TELEGRAM_BOT_TOKEN : '';
    $chat_id   = defined('IT_TELEGRAM_CHAT_ID') ? IT_TELEGRAM_CHAT_ID : '';

    if (empty($bot_token) || empty($chat_id)) {
        wp_send_json_error('Настройки Telegram не указаны в wp-config.php');
        return;
    }

    $url = "https://api.telegram.org/bot{$bot_token}/sendMessage";
    
    $response = wp_remote_post($url, array(
        'body' => array(
            'chat_id'      => $chat_id,
            'text'         => $message,
            'parse_mode'   => 'Markdown',
            'disable_web_page_preview' => true
        ),
        'timeout' => 15
    ));

    if (is_wp_error($response)) {
        wp_send_json_error('Ошибка соединения с Telegram: ' . $response->get_error_message());
    } else {
        $body = json_decode(wp_remote_retrieve_body($response), true);
        if (isset($body['ok']) && $body['ok']) {
            wp_send_json_success('Заказ отправлен');
        } else {
            wp_send_json_error('Telegram вернул ошибку: ' . ($body['description'] ?? 'Unknown'));
        }
    }
}
// Хуки для авторизованных и неавторизованных пользователей
add_action('wp_ajax_it_send_order_to_telegram', 'it_send_order_to_telegram');
add_action('wp_ajax_nopriv_it_send_order_to_telegram', 'it_send_order_to_telegram');


/**
 * Telegram-бот: настройки для отправки заказов.
 * 
 * В продакшене эти константы должны быть определены в wp-config.php корня сайта:
 *   define('IT_TELEGRAM_BOT_TOKEN', 'реальный_токен');
 *   define('IT_TELEGRAM_CHAT_ID', 'реальный_chat_id');
 * 
 * Для демо/портфолио оставлены плейсхолдеры.
 */
if (!defined('IT_TELEGRAM_BOT_TOKEN')) {
    define('IT_TELEGRAM_BOT_TOKEN', 'YOUR_BOT_TOKEN_HERE');
}
if (!defined('IT_TELEGRAM_CHAT_ID')) {
    define('IT_TELEGRAM_CHAT_ID', 'YOUR_CHAT_ID_HERE');
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