<?php
/**
 * Шаблон интерактивной витрины "Летающее блюдо"
 * Это и есть наша киллер-фича.
 */

$dishes = array(
    array(
        'slug' => 'tagliatelle-truffle',
        'name' => 'Тальятелле с трюфелем',
        'chef' => 'Шеф Марко',
        'rating' => '4.9',
        'desc' => 'Домашняя паста с чёрным трюфелем, пармезаном и сливочным соусом.',
    ),
    array(
        'slug' => 'ravioli-ricotta',
        'name' => 'Равиоли с рикоттой',
        'chef' => 'Шеф Лука',
        'rating' => '4.8',
        'desc' => 'Равиоли с начинкой из рикотты и шпината в соусе из шалфея.',
    ),
    array(
        'slug' => 'pizza-margherita',
        'name' => 'Пицца Маргарита',
        'chef' => 'Шеф Джованни',
        'rating' => '4.9',
        'desc' => 'Классическая неаполитанская пицца с моцареллой, томатами и базиликом.',
    ),
    array(
        'slug' => 'risotto-milanese',
        'name' => 'Ризотто алла миланезе',
        'chef' => 'Шеф Алессандро',
        'rating' => '4.7',
        'desc' => 'Кремовое ризотто с шафраном, пармезаном и костным мозгом.',
    ),
    array(
        'slug' => 'osso-buco',
        'name' => 'Оссобуко',
        'chef' => 'Шеф Франческо',
        'rating' => '4.8',
        'desc' => 'Томлёная телячья голяшка с ризотто и гремолатой.',
    ),
    array(
        'slug' => 'tiramisu',
        'name' => 'Тирамису',
        'chef' => 'Кондитер София',
        'rating' => '5.0',
        'desc' => 'Классический итальянский десерт с маскарпоне, кофе и какао.',
    ),
);
?>

<section class="showcase animate-on-scroll">
    <div class="showcase__container">
        <span class="showcase__eyebrow">Выбор гостей</span>
        <h2 class="showcase__title">Популярные блюда</h2>

        <!-- Главная сцена -->
        <div class="showcase__stage">
            <!-- Блок с характеристиками блюда (слева) -->
            <div class="showcase__details">
                <!-- 1. Время (Часы) -->
                <div class="showcase__detail">
                    <div class="showcase__detail-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="showcase__detail-info">
                        <span class="showcase__detail-value" id="detailTime">25 мин</span>
                        <span class="showcase__detail-label">Время</span>
                    </div>
                </div>

                <!-- 2. Сложность (Слои) -->
                <div class="showcase__detail">
                    <div class="showcase__detail-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                            <polyline points="2 17 12 22 22 17"></polyline>
                            <polyline points="2 12 12 17 22 12"></polyline>
                        </svg>
                    </div>
                    <div class="showcase__detail-info">
                        <span class="showcase__detail-value" id="detailDifficulty">Средняя</span>
                        <span class="showcase__detail-label">Сложность</span>
                    </div>
                </div>

                <!-- 3. Порции (Люди) -->
                <div class="showcase__detail">
                    <div class="showcase__detail-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="showcase__detail-info">
                        <span class="showcase__detail-value" id="detailServings">2 порции</span>
                        <span class="showcase__detail-label">Порции</span>
                    </div>
                </div>

                <!-- 4. Калории (Огонь) -->
                <div class="showcase__detail">
                    <div class="showcase__detail-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"></path>
                        </svg>
                    </div>
                    <div class="showcase__detail-info">
                        <span class="showcase__detail-value" id="detailCalories">650 ккал</span>
                        <span class="showcase__detail-label">Калории</span>
                    </div>
                </div>
            </div>
            <!-- Контейнер для "летающих" блюд -->
            <div class="showcase__dishes">
                <?php foreach ($dishes as $index => $dish): ?>
                    <img 
                        src="<?php echo ITALIAN_TASTE_URI; ?>/assets/images/dishes/<?php echo esc_attr($dish['slug']); ?>.webp" 
                        alt="<?php echo esc_attr($dish['name']); ?>"
                        class="showcase__dish <?php echo $index === 0 ? 'active' : ''; ?>"
                        data-index="<?php echo $index; ?>"
                    >
                <?php endforeach; ?>
            </div>

            <!-- Карточка с информацией (справа) -->
            <div class="showcase__info">
                <div class="showcase__meta">
                    <span class="showcase__rank">#1 Most loved dish</span>
                    <h3 class="showcase__dish-name">Тальятелле с трюфелем</h3>
                </div>
                
                <div class="showcase__rating">
                    <span class="showcase__score">4.9</span>
                    <div class="showcase__stars">★★★★★</div>
                </div>

                <div class="showcase__chef">
                    <h4 class="showcase__chef-name">Шеф Марко</h4>
                    <p class="showcase__chef-desc">Домашняя паста с чёрным трюфелем, пармезаном и сливочным соусом.</p>
                </div>

                <div class="showcase__actions">
                    <button class="btn btn--primary">В корзину</button>
                    <button class="btn btn--outline">Подробнее</button>
                </div>
            </div>
        </div>

        <!-- Миниатюры снизу -->
        <div class="showcase__thumbs">
            <?php foreach ($dishes as $index => $dish): ?>
                <button 
                    class="showcase__thumb <?php echo $index === 0 ? 'active' : ''; ?>" 
                    data-index="<?php echo $index; ?>"
                >
                    <img src="<?php echo ITALIAN_TASTE_URI; ?>/assets/images/dishes/<?php echo esc_attr($dish['slug']); ?>.webp" alt="">
                    <span><?php echo esc_html($dish['name']); ?></span>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>