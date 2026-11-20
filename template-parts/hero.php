<?php
/**
 * Шаблон Hero-секции (первый экран)
 * 
 * Структура:
 * - Двухколоночная сетка: текст слева, фото справа
 * - На мобильных — одна колонка (текст сверху, фото снизу)
 * - Высота ~90vh для эффекта "первого экрана"
 * 
 * Почему template-parts:
 * - front-page.php собирает страницу из таких частей
 * - Каждый блок изолирован, легко править/переиспользовать
 */
?>

<section class="hero animate-on-scroll">
    <div class="hero__container">
        <!-- Левая колонка: текст -->
        <div class="hero__content">
            <span class="hero__eyebrow">Аутентичная итальянская кухня</span>
            <h1 class="hero__title">Вкус, созданный с душой</h1>
            <p class="hero__subtitle">
                Настоящая карбонара, свежая паста ручной работы и атмосфера итальянской траттории в сердце города.
            </p>
            <div class="hero__actions">
                <a href="#booking" class="btn btn--primary">Забронировать стол</a>
                <a href="#menu" class="btn btn--outline">Смотреть меню</a>
            </div>
        </div>
        
        <!-- Правая колонка: фото -->
        <div class="hero__image">
            <img 
                src="<?php echo ITALIAN_TASTE_URI; ?>/assets/images/carbonara.webp" 
                alt="Спагетти карбонара с жидким желтком, гуанчале и пармезаном" 
                class="hero__photo"
            >
        </div>
    </div>
    <!-- Декоративный блоб справа -->
    <div class="hero__blob" aria-hidden="true"></div>
</section>