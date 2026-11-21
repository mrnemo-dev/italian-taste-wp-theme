<?php
/**
 * Шаблон Hero-секции (первый экран)
 * Данные подтягиваются из ACF.
 */

// Получаем данные из ACF. Если поле пустое — запасной вариант.
$eyebrow   = get_field('hero_eyebrow') ?: 'Аутентичная итальянская кухня';
$title     = get_field('hero_title') ?: 'Вкус, созданный с душой';
$subtitle  = get_field('hero_subtitle') ?: 'Настоящая карбонара, свежая паста ручной работы и атмосфера итальянской траттории в сердце города.';
$image_url = get_field('hero_image');

if (empty($image_url)) {
    $image_url = get_template_directory_uri() . '/assets/images/carbonara.webp';
}
?>

<section class="hero animate-on-scroll">
    <!-- Декоративный блоб справа -->
    <div class="hero__blob" aria-hidden="true"></div>

    <div class="hero__container">
        <!-- Левая колонка: текст -->
        <div class="hero__content">
            <span class="hero__eyebrow animate-child"><?php echo esc_html($eyebrow); ?></span>
            <h1 class="hero__title animate-child"><?php echo esc_html($title); ?></h1>
            <p class="hero__subtitle animate-child"><?php echo esc_html($subtitle); ?></p>
            <div class="hero__actions animate-child">
                <a href="#booking" class="btn btn--primary">Забронировать стол</a>
                <a href="#menu" class="btn btn--outline">Смотреть меню</a>
            </div>
        </div>
        
        <!-- Правая колонка: фото -->
        <div class="hero__image animate-child">
            <img 
                src="<?php echo esc_url($image_url); ?>" 
                alt="Спагетти карбонара" 
                class="hero__photo"
                width="500"
                height="500"
            >
        </div>
    </div>
</section>