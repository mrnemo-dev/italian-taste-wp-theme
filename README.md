# Italian Taste — Custom WordPress Theme

Кастомная тема WordPress для итальянского ресторана с доставкой. Разработана с нуля без использования конструкторов (Elementor, WPBakery).

![Italian Taste](screenshot.png)
🎥 **Демо-видео:** https://youtu.be/watch?v=hhuHC5aRh-o

## 🎯 Особенности

- **Чистая кастомная тема** без зависимости от page builders
- **Темная/светлая тема** с плавными переходами
- **GSAP ScrollTrigger** анимации появления секций
- **Корзина на localStorage** с drawer-панелью и пересчетом
- **Telegram-интеграция** для приема заказов (AJAX + wp_remote_post)
- **Блог** с шаблонами `home.php` и `single.php`
- **Полный адаптив** от 320px до 4K
- **BEM-методология** в SCSS, CSS-переменные для темизации

## 🛠 Стек

- WordPress 7.1+ (custom theme)
- PHP 8.0+
- SCSS (Live Sass Compiler)
- Vanilla JavaScript (ES6+)
- GSAP 3 + ScrollTrigger
- ACF (опционально, для клиентских версий)
- Local by Flywheel (local dev)

## 📁 Структура темы
italian-taste/
├── template-parts/ # Секции главной страницы (hero, menu, about...)
├── assets/
│ ├── scss/ # Исходники стилей (BEM)
│ ├── css/ # Скомпилированный CSS
│ ├── js/ # Скрипты (cart, menu, scroll-animations)
│ └── images/ # Статичные изображения
├── inc/ # PHP-модули (enqueue, helpers, CPT)
├── home.php # Шаблон страницы блога
├── single.php # Шаблон одной статьи
├── front-page.php # Главная страница
├── header.php # Общий хедер + drawer корзины
└── footer.php # Общий футер

## 🚀 Установка

1. Скопируй папку темы в `wp-content/themes/`
2. Активируй в **Внешний вид → Темы**
3. Установи плагин **ACF** (если нужны редактируемые поля)
4. Создай страницы: Главная, Блог
5. В **Настройки → Чтение** назначь "Главную" и "Блог"

### Telegram-бот (опционально)

Добавь в `wp-config.php`:
```php
define('IT_TELEGRAM_BOT_TOKEN', 'твой_токен');
define('IT_TELEGRAM_CHAT_ID', 'твой_chat_id');
