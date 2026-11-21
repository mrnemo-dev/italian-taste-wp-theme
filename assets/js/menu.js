/**
 * Логика секции "Меню"
 * 
 * Функционал:
 * - Фильтрация блюд по категориям
 * - Открытие модального окна с деталями блюда
 * - Закрытие модального окна
 */

(function () {
    'use strict';

    // Данные блюд (дублируем из PHP для JS-логики)
    const dishesData = {
        'tagliatelle-truffle': {
            name: 'Тальятелле с трюфелем',
            description: 'Домашняя паста с чёрным трюфелем, пармезаном и сливочным соусом.',
            ingredients: 'Тальятелле, трюфель, пармезан, сливки, сливочное масло',
            price: '890 ₽',
            image: 'tagliatelle-truffle.webp'
        },
        'ravioli-ricotta': {
            name: 'Равиоли с рикоттой',
            description: 'Равиоли с начинкой из рикотты и шпината в соусе из шалфея.',
            ingredients: 'Равиоли, рикотта, шпинат, шалфей, пармезан',
            price: '750 ₽',
            image: 'ravioli-ricotta.webp'
        },
        'pizza-margherita': {
            name: 'Пицца Маргарита',
            description: 'Классическая неаполитанская пицца с моцареллой, томатами и базиликом.',
            ingredients: 'Тесто, моцарелла, томаты, базилик, оливковое масло',
            price: '650 ₽',
            image: 'pizza-margherita.webp'
        },
        'risotto-milanese': {
            name: 'Ризотто алла миланезе',
            description: 'Кремовое ризотто с шафраном, пармезаном и костным мозгом.',
            ingredients: 'Рис арборио, шафран, пармезан, костный мозг, белое вино',
            price: '820 ₽',
            image: 'risotto-milanese.webp'
        },
        'osso-buco': {
            name: 'Оссобуко',
            description: 'Томлёная телячья голяшка с ризотто и гремолатой.',
            ingredients: 'Телячья голяшка, ризотто, гремолата, белое вино, овощи',
            price: '1200 ₽',
            image: 'osso-buco.webp'
        },
        'tiramisu': {
            name: 'Тирамису',
            description: 'Классический итальянский десерт с маскарпоне, кофе и какао.',
            ingredients: 'Маскарпоне, савоярди, эспрессо, какао, яйца, сахар',
            price: '450 ₽',
            image: 'tiramisu.webp'
        }
    };

    // Элементы DOM
    const filterBtns = document.querySelectorAll('.menu__filter-btn');
    const dishCards = document.querySelectorAll('.dish-card');
    const modal = document.getElementById('dishModal');
    const modalClose = document.querySelector('.modal__close');
    const modalOverlay = document.querySelector('.modal__overlay');

    // Фильтрация блюд
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Убираем active у всех кнопок
            filterBtns.forEach(b => b.classList.remove('active'));
            // Добавляем active нажатой кнопке
            btn.classList.add('active');

            const category = btn.dataset.category;

            // Показываем/скрываем карточки
            dishCards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
// На страницах без модалки (например, служебная /menu/) — выходим молча
if (!modal) return;
    // Открытие модального окна
    document.querySelectorAll('.dish-card__btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation(); // Чтобы не срабатывал клик по карточке
            const dishSlug = btn.dataset.dish;
            const dish = dishesData[dishSlug];

            if (dish) {
                document.getElementById('modalImage').src = `/wp-content/themes/italian-taste/assets/images/dishes/${dish.image}`;
                document.getElementById('modalImage').alt = dish.name;
                document.getElementById('modalTitle').textContent = dish.name;
                document.getElementById('modalDescription').textContent = dish.description;
                document.getElementById('modalIngredients').textContent = dish.ingredients;
                document.getElementById('modalPrice').textContent = dish.price;

                modal.classList.add('active');
                document.body.style.overflow = 'hidden'; // Блокируем скролл страницы
                
                // Когда модалка открывается и данные блюда подставляются, обновляем и кнопку корзины:
                const modalCartBtn = document.getElementById('modalAddToCartBtn');
                if (modalCartBtn) {
                    modalCartBtn.dataset.id = dishSlug;                                  // уникальный ключ — slug
                    modalCartBtn.dataset.name = dish.name;
                    modalCartBtn.dataset.price = dish.price;
                    modalCartBtn.dataset.image = document.getElementById('modalImage').src; // берём уже готовый src
                }

            }
        });
    });

    // Закрытие модального окна
    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = ''; // Возвращаем скролл
    }

    modalClose.addEventListener('click', closeModal);
    modalOverlay.addEventListener('click', closeModal);

    // Закрытие по Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeModal();
        }
    });
})();