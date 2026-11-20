/**
 * Переключатель цветовых тем
 *
 * Логика:
 * - Состояние темы хранится в атрибуте data-theme на <html> и в localStorage.
 * - Кнопка показывает ЦЕЛЕВОЙ режим: если сейчас тёмная — на ней "☀️ Светлая"
 *   (то есть "нажми, чтобы стать светлой"). Это интуитивнее, чем показывать
 *   текущий режим, потому что пользователь видит, что произойдёт по клику.
 * - Выбор пользователя сохраняется в localStorage, чтобы при следующем
 *   визите тема не сбрасывалась на дефолт.
 *
 * Почему отдельный файл, а не inline в header.php:
 * - main.js можно кэшировать браузером (inline-скрипт кэшируется хуже),
 * - логика живёт отдельно от шаблона, header.php остаётся читаемым.
 */

(function () {
	'use strict';

	// Ключ в localStorage. Выносим в константу, чтобы не опечататься в 5 местах.
	const STORAGE_KEY = 'it-theme';

	// Ссылки на DOM-элементы.
	const root = document.documentElement;
	const toggleBtn = document.getElementById('themeToggle');

	// Если кнопки нет на странице — выходим, чтобы не ловить null-ошибку.
	// Это защита от случаев, когда скрипт грузится на странице без хедера.
	if (!toggleBtn) {
		return;
	}

	/**
	 * Обновляет текст и иконку кнопки под текущую тему.
	 * Вынесено в функцию, потому что вызывается в двух местах:
	 * при загрузке и после каждого клика.
	 */
	function updateButtonLabel() {
		const isLight = root.getAttribute('data-theme') === 'light';
		// Если светлая — предлагаем переключить на тёмную, и наоборот.
		toggleBtn.textContent = isLight ? '🌙 Тёмная' : '☀️ Светлая';
	}

	/**
	 * Переключает тему: меняет атрибут, сохраняет выбор, обновляет кнопку.
	 */
	function toggleTheme() {
		const isLight = root.getAttribute('data-theme') === 'light';
		const newTheme = isLight ? 'dark' : 'light';

		// Ставим атрибут на <html> — CSS-переменные из [data-theme="light"]
	 // тут же пересчитаются, и transition на body даст плавный переход.
		root.setAttribute('data-theme', newTheme);

		// Сохраняем выбор пользователя. try/catch — на случай, если
		// localStorage недоступен (приватный режим Safari, например).
		try {
			localStorage.setItem(STORAGE_KEY, newTheme);
		} catch (e) {
			// Молча игнорируем: без сохранения тема всё равно переключится
			// на текущей сессии, просто не запомнится.
		}

		updateButtonLabel();
	}

	// Инициализация: ставим правильный текст кнопки под текущую тему
	// (тему уже поставил анти-FOUC скрипт в <head>, мы только синхронизируем UI).
	updateButtonLabel();

	// Вешаем обработчик клика.
	toggleBtn.addEventListener('click', toggleTheme);
})();