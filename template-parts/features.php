<?php
/**
 * Шаблон секции "Преимущества"
 *
 * Структура:
 * - Волнистый разделитель сверху (связывает с Hero)
 * - Заголовок секции по центру
 * - 3 карточки-преимущества в ряд (иконка + заголовок + описание)
 * - Декоративные точки по бокам (как рассыпанные специи)
 *
 * Почему не блоб: секция низкая (~400px), блоб будет доминировать.
 * Точки + wave дают ритм без перегруза.
 */
?>

<section class="features animate-on-scroll">
    <!-- Волнистый разделитель сверху -->
    <div class="features__wave" aria-hidden="true">
        <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
            <path d="M0,50 C360,100 720,0 1080,50 C1260,75 1380,60 1440,50 L1440,0 L0,0 Z" fill="var(--color-bg-primary)"/>
        </svg>
    </div>

<!-- Декоративные точки (хаотично разбросаны по всей секции) -->
<div class="features__dots" aria-hidden="true">
    <span class="features__dot" style="width: 8px; height: 8px; top: 15%; left: 8%;"></span>
    <span class="features__dot" style="width: 12px; height: 12px; top: 25%; left: 15%;"></span>
    <span class="features__dot" style="width: 6px; height: 6px; top: 35%; left: 5%;"></span>
    <span class="features__dot" style="width: 14px; height: 14px; top: 45%; left: 12%;"></span>
    <span class="features__dot" style="width: 7px; height: 7px; top: 55%; left: 18%;"></span>
    <span class="features__dot" style="width: 10px; height: 10px; top: 65%; left: 7%;"></span>
    <span class="features__dot" style="width: 9px; height: 9px; top: 75%; left: 14%;"></span>
    <span class="features__dot" style="width: 11px; height: 11px; top: 85%; left: 10%;"></span>
    
    <span class="features__dot" style="width: 10px; height: 10px; top: 20%; left: 85%;"></span>
    <span class="features__dot" style="width: 7px; height: 7px; top: 30%; left: 92%;"></span>
    <span class="features__dot" style="width: 13px; height: 13px; top: 40%; left: 88%;"></span>
    <span class="features__dot" style="width: 8px; height: 8px; top: 50%; left: 95%;"></span>
    <span class="features__dot" style="width: 12px; height: 12px; top: 60%; left: 90%;"></span>
    <span class="features__dot" style="width: 6px; height: 6px; top: 70%; left: 87%;"></span>
    <span class="features__dot" style="width: 14px; height: 14px; top: 80%; left: 93%;"></span>
    <span class="features__dot" style="width: 9px; height: 9px; top: 90%; left: 89%;"></span>
    
    <!-- Несколько точек в центре для баланса -->
    <span class="features__dot" style="width: 5px; height: 5px; top: 30%; left: 45%;"></span>
    <span class="features__dot" style="width: 8px; height: 8px; top: 70%; left: 55%;"></span>
    <span class="features__dot" style="width: 6px; height: 6px; top: 50%; left: 50%;"></span>
</div>

    <div class="features__container">
        <span class="features__eyebrow">Почему выбирают нас</span>
        <h2 class="features__title">Три кита Italian Taste</h2>

        <div class="features__grid">
            <!-- Карточка 1: Быстрая доставка -->
            <div class="feature-card">
                <div class="feature-card__icon">
                    <?php include ITALIAN_TASTE_DIR . '/assets/images/icons/motorcycle.svg'; ?>
                </div>
                <h3 class="feature-card__title">Быстрая доставка</h3>
                <p class="feature-card__text">Доставим горячее блюдо за 30 минут или вернём деньги. Свежесть не ждёт.</p>
            </div>

            <!-- Карточка 2: Свежие продукты -->
            <div class="feature-card">
                <div class="feature-card__icon">
                    <?php include ITALIAN_TASTE_DIR . '/assets/images/icons/leaf.svg'; ?>
                </div>
                <h3 class="feature-card__title">Свежие продукты</h3>
                <p class="feature-card__text">Ингредиенты с фермерских рынков каждое утро. Никаких заморозок и консервантов.</p>
            </div>

            <!-- Карточка 3: Мастерство шефа -->
            <div class="feature-card">
                <div class="feature-card__icon">
                    <?php include ITALIAN_TASTE_DIR . '/assets/images/icons/utensils.svg'; ?>
                </div>
                <h3 class="feature-card__title">Мастерство шефа</h3>
                <p class="feature-card__text">20 лет опыта в лучших ресторанах Италии. Каждое блюдо — произведение искусства.</p>
            </div>
        </div>
    </div>
</section>