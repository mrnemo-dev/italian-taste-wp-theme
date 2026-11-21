<?php
/**
 * Шаблон секции "Меню"
 */

// Массив блюд. Обратите внимание: price теперь число, добавлен id
$dishes = array(
    array(
        'id' => 1,
        'slug' => 'tagliatelle-truffle',
        'name' => 'Тальятелле с трюфелем',
        'category' => 'pasta',
        'price' => 890,
        'description' => 'Домашняя паста с чёрным трюфелем, пармезаном и сливочным соусом.',
        'ingredients' => 'Тальятелле, трюфель, пармезан, сливки, сливочное масло',
    ),
    array(
        'id' => 2,
        'slug' => 'ravioli-ricotta',
        'name' => 'Равиоли с рикоттой',
        'category' => 'pasta',
        'price' => 750,
        'description' => 'Равиоли с начинкой из рикотты и шпината в соусе из шалфея.',
        'ingredients' => 'Равиоли, рикотта, шпинат, шалфей, пармезан',
    ),
    array(
        'id' => 3,
        'slug' => 'pizza-margherita',
        'name' => 'Пицца Маргарита',
        'category' => 'pizza',
        'price' => 650,
        'description' => 'Классическая неаполитанская пицца с моцареллой, томатами и базиликом.',
        'ingredients' => 'Тесто, моцарелла, томаты, базилик, оливковое масло',
    ),
    array(
        'id' => 4,
        'slug' => 'risotto-milanese',
        'name' => 'Ризотто алла миланезе',
        'category' => 'risotto',
        'price' => 820,
        'description' => 'Кремовое ризотто с шафраном, пармезаном и костным мозгом.',
        'ingredients' => 'Рис арборио, шафран, пармезан, костный мозг, белое вино',
    ),
    array(
        'id' => 5,
        'slug' => 'osso-buco',
        'name' => 'Оссобуко',
        'category' => 'risotto',
        'price' => 1200,
        'description' => 'Томлёная телячья голяшка с ризотто и гремолатой.',
        'ingredients' => 'Телячья голяшка, ризотто, гремолата, белое вино, овощи',
    ),
    array(
        'id' => 6,
        'slug' => 'tiramisu',
        'name' => 'Тирамису',
        'category' => 'dessert',
        'price' => 450,
        'description' => 'Классический итальянский десерт с маскарпоне, кофе и какао.',
        'ingredients' => 'Маскарпоне, савоярди, эспрессо, какао, яйца, сахар',
    ),
);

$categories = array(
    'all' => 'Все',
    'pasta' => 'Паста',
    'pizza' => 'Пицца',
    'risotto' => 'Ризотто и горячее',
    'dessert' => 'Десерты',
);
?>

<section class="menu animate-on-scroll" id="menu">
    <div class="menu__container">
        <span class="menu__eyebrow">Наше меню</span>
        <h2 class="menu__title">Блюда, созданные с любовью</h2>

        <!-- Фильтр категорий -->
        <div class="menu__filter">
            <?php foreach ($categories as $slug => $name): ?>
                <button 
                    class="menu__filter-btn <?php echo $slug === 'all' ? 'active' : ''; ?>" 
                    data-category="<?php echo esc_attr($slug); ?>"
                >
                    <?php echo esc_html($name); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Сетка карточек -->
        <div class="menu__grid">
            <?php foreach ($dishes as $dish): 
                // Формируем URL картинки один раз для удобства
                $image_url = ITALIAN_TASTE_URI . '/assets/images/dishes/' . $dish['slug'] . '.webp';
            ?>
                <div class="dish-card" data-category="<?php echo esc_attr($dish['category']); ?>">
                    <div class="dish-card__image">
                        <img 
                            src="<?php echo esc_url($image_url); ?>" 
                            alt="<?php echo esc_attr($dish['name']); ?>"
                            loading="lazy"
                        >
                    </div>
                    <div class="dish-card__content">
                        <h3 class="dish-card__name"><?php echo esc_html($dish['name']); ?></h3>
                        <p class="dish-card__description"><?php echo esc_html($dish['description']); ?></p>
                        <div class="dish-card__footer">
                            <span class="dish-card__price"><?php echo esc_html($dish['price']); ?> ₽</span>
                            
                            <!-- КНОПКА В КОРЗИНУ С DATA-АТРИБУТАМИ -->
                            <button type="button" class="btn btn--primary btn-add-to-cart"
                                data-id="<?php echo esc_attr($dish['slug']); ?>"
                                data-name="<?php echo esc_attr($dish['name']); ?>"
                                data-price="<?php echo esc_attr($dish['price']); ?>"
                                data-image="<?php echo esc_url($image_url); ?>">
                                В корзину
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Модальное окно с деталями блюда -->
    <div class="modal" id="dishModal">
        <div class="modal__overlay"></div>
        <div class="modal__content">
            <button class="modal__close" aria-label="Закрыть">&times;</button>
            <div class="modal__body">
                <div class="modal__image">
                    <img id="modalImage" src="" alt="">
                </div>
                <div class="modal__info">
                    <h3 class="modal__title" id="modalTitle"></h3>
                    <p class="modal__description" id="modalDescription"></p>
                    <div class="modal__ingredients">
                        <h4>Состав:</h4>
                        <p id="modalIngredients"></p>
                    </div>
                    <div class="modal__footer">
                        <span class="modal__price" id="modalPrice"></span>
                        
                        <!-- Кнопка в корзине внутри модалки (тоже с data-атрибутами, они обновятся через JS) -->
                        <button type="button" class="btn btn--primary btn-add-to-cart" id="modalAddToCartBtn"
                            data-id="" data-name="" data-price="" data-image="">
                            В корзину
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>