/**
 * Корзина: хранение в localStorage, счётчик, drawer, +/-.
 *
 * Товар = { id, name, price, image, qty }
 * Ключ в localStorage: 'it-cart'
 */

(function () {
    const STORAGE_KEY = 'it-cart';

    // --- Состояние ---
    let cart = loadCart();

    // --- DOM ---
    const drawer     = document.getElementById('cartDrawer');
    const toggleBtn  = document.getElementById('cartToggle');
    const closeBtn   = document.getElementById('cartClose');
    const overlay    = document.getElementById('cartOverlay');
    const itemsBox   = document.getElementById('cartItems');
    const totalBox   = document.getElementById('cartTotal');
    const countBox   = document.getElementById('cartCount');
    const checkoutBtn = document.getElementById('checkoutBtn');

    if (!drawer || !toggleBtn) return; // не на странице с хедером

    // --- Хранилище ---
    function loadCart() {
        try {
            return JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
        } catch (e) {
            return [];
        }
    }

    function saveCart() {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(cart));
    }

    // --- Действия ---
    function addToCart(item) {
        const existing = cart.find(c => c.id === item.id);
        if (existing) {
            existing.qty += 1;
        } else {
            cart.push({ ...item, qty: 1 });
        }
        saveCart();
        render();
        bumpBadge();
    }

    function changeQty(id, delta) {
        const item = cart.find(c => c.id === id);
        if (!item) return;
        item.qty += delta;
        if (item.qty <= 0) {
            cart = cart.filter(c => c.id !== id);
        }
        saveCart();
        render();
    }

    function removeItem(id) {
        cart = cart.filter(c => c.id !== id);
        saveCart();
        render();
    }

    // --- Рендер ---
    function render() {
        // Счётчик
        const totalQty = cart.reduce((sum, c) => sum + c.qty, 0);
        countBox.textContent = totalQty;
        countBox.classList.toggle('is-empty', totalQty === 0);

        // Список товаров
        if (cart.length === 0) {
            itemsBox.innerHTML = '<p class="cart-drawer__empty">Корзина пуста 🍝</p>';
        } else {
            itemsBox.innerHTML = cart.map(item => `
                <div class="cart-item" data-id="${item.id}">
                    <img class="cart-item__thumb" src="${item.image}" alt="${item.name}">
                    <div class="cart-item__info">
                        <h4>${item.name}</h4>
                        <span>${item.price} ₽</span>
                    </div>
                    <div class="cart-item__qty">
                        <button type="button" data-action="dec" aria-label="Меньше">−</button>
                        <span>${item.qty}</span>
                        <button type="button" data-action="inc" aria-label="Больше">+</button>
                    </div>
                    <button type="button" class="cart-item__remove" data-action="remove" aria-label="Удалить">&times;</button>
                </div>
            `).join('');
        }

        // Итого
        const total = cart.reduce((sum, c) => sum + c.price * c.qty, 0);
        totalBox.textContent = total.toLocaleString('ru-RU') + ' ₽';
    }

    // --- Открытие / закрытие drawer ---
    function openDrawer() {
        drawer.classList.add('is-open');
        drawer.setAttribute('aria-hidden', 'false');
        document.body.classList.add('cart-open');
    }

    function closeDrawer() {
        drawer.classList.remove('is-open');
        drawer.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('cart-open');
    }

    // --- Анимация бейджа при добавлении ---
    function bumpBadge() {
        countBox.style.transform = 'scale(1.4)';
        setTimeout(() => { countBox.style.transform = ''; }, 200);
    }

    // --- Слушатели ---
    toggleBtn.addEventListener('click', openDrawer);
    closeBtn.addEventListener('click', closeDrawer);
    overlay.addEventListener('click', closeDrawer);
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && drawer.classList.contains('is-open')) closeDrawer();
    });

    // Клик по кнопкам +/-/удалить внутри drawer (делегирование)
    itemsBox.addEventListener('click', e => {
        const btn = e.target.closest('[data-action]');
        if (!btn) return;
        const id = btn.closest('.cart-item').dataset.id;
        const action = btn.dataset.action;

        if (action === 'inc') changeQty(id, 1);
        if (action === 'dec') changeQty(id, -1);
        if (action === 'remove') removeItem(id);
    });

    // Клик по "В корзину" на карточках блюд (делегирование на весь document)
    document.addEventListener('click', e => {
        const btn = e.target.closest('.btn-add-to-cart');
        if (!btn) return;
        e.preventDefault();

        const item = {
            id:    btn.dataset.id,
            name:  btn.dataset.name,
            price: parseInt(btn.dataset.price, 10),
            image: btn.dataset.image
        };
        if (!item.id || isNaN(item.price)) return;

        addToCart(item);
    });

    // Кнопка "Оформить заказ"
    checkoutBtn.addEventListener('click', async () => {
        if (cart.length === 0) {
            alert('Корзина пуста 🍝');
            return;
        }

        const name = document.getElementById('cartName').value.trim();
        const phone = document.getElementById('cartPhone').value.trim();

        if (!name || !phone) {
            alert('Пожалуйста, укажите имя и телефон для связи.');
            return;
        }

        // Блокируем кнопку на время отправки
        checkoutBtn.disabled = true;
        checkoutBtn.textContent = 'Отправка...';

        // Формируем данные для отправки
        const orderData = {
            action: 'it_send_order_to_telegram', // Хук для WordPress AJAX
            name: name,
            phone: phone,
            items: cart.map(item => ({
                name: item.name,
                qty: item.qty,
                price: item.price,
                total: item.qty * item.price
            })),
            grandTotal: cart.reduce((sum, c) => sum + c.price * c.qty, 0),
            // Передаём nonce для безопасности WordPress
            nonce: it_ajax.nonce 
        };

        try {
            const response = await fetch(it_ajax.ajax_url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams(orderData)
            });

            const result = await response.json();

            if (result.success) {
                alert('✅ Заказ успешно отправлен! Мы скоро свяжемся с вами.');
                cart = []; // Очищаем корзину
                saveCart();
                render();
                closeDrawer();
                document.getElementById('cartName').value = '';
                document.getElementById('cartPhone').value = '';
            } else {
                alert('❌ Ошибка отправки: ' + (result.data || 'Попробуйте позже.'));
            }
        } catch (error) {
            console.error('AJAX Error:', error);
            alert('❌ Ошибка сети. Проверьте подключение.');
        } finally {
            checkoutBtn.disabled = false;
            checkoutBtn.textContent = 'Оформить в Telegram';
        }
    });

    // --- Старт ---
    render();
})();