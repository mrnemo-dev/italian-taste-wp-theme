<?php
/**
 * Шаблон секции "О нас"
 *
 * Структура:
 * - Коллаж из 4 фото слева (наложение друг на друга, как в Foodeza)
 * - Текст справа (эйли, заголовок, описание, кнопка)
 * - Декоративный SVG blob справа, обрезан по краю экрана
 *
 * Почему blob через CSS-маску, а не inline SVG:
 * - Один файл красится в любой цвет через var(--color-accent-primary)
 * - При переключении темы цвет меняется автоматически, без JS
 * - Меньше вес проекта (4 файла вместо 8)
 */
?>

<section class="about animate-on-scroll" id="about">
    <!-- Декоративный blob: цвет = акцент текущей темы, обрезан справа -->
    <div class="about__blob" aria-hidden="true"></div>

    <div class="about__container">
        <!-- Левая колонка: коллаж из 4 фото -->
        <div class="about__images">
            <div class="about__image about__image--1">
                <img src="<?php echo ITALIAN_TASTE_URI; ?>/assets/images/about-1.webp" alt="Шеф-повар готовит пасту вручную" loading="lazy">
            </div>
            <div class="about__image about__image--2">
                <img src="<?php echo ITALIAN_TASTE_URI; ?>/assets/images/about-2.webp" alt="Свежие итальянские ингредиенты" loading="lazy">
            </div>
            <div class="about__image about__image--3">
                <img src="<?php echo ITALIAN_TASTE_URI; ?>/assets/images/about-3.webp" alt="Уютный интерьер траттории" loading="lazy">
            </div>
            <div class="about__image about__image--4">
                <img src="<?php echo ITALIAN_TASTE_URI; ?>/assets/images/about-4.webp" alt="Фирменное блюдо от шефа" loading="lazy">
            </div>
        </div>

        <!-- Правая колонка: текст -->
        <div class="about__content">
            <span class="about__eyebrow">О нашем ресторане</span>
            <h2 class="about__title">История, рождённая из любви к Италии</h2>
            <p class="about__text">
                Мы верим, что настоящая итальянская кухня — это не просто рецепты, а философия.
                Наши шеф-повара привезли традиции из маленьких тратторий Тосканы и Сицилии,
                чтобы каждый гость мог ощутить вкус настоящей Италии.
            </p>
            <p class="about__text">
                Свежие ингредиенты, ручная работа и страсть к делу — вот три кита,
                на которых стоит Italian Taste.
            </p>
            <a href="#about" class="btn btn--primary">Наша история</a>
        </div>
    </div>
</section>