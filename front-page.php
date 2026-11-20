<?php
/**
 * Шаблон главной страницы
 * 
 * WordPress автоматически использует front-page.php для главной страницы,
 * если он существует (приоритет выше, чем у index.php).
 * 
 * Структура: собираем страницу из template-parts.
 * Это позволяет легко добавлять/убирать секции без правки одного огромного файла.
 */

get_header(); ?>

<main>
    <?php get_template_part( 'template-parts/hero' ); ?>
    <?php get_template_part( 'template-parts/about' ); ?>
    <?php get_template_part( 'template-parts/features' ); ?>
    <?php get_template_part( 'template-parts/menu' ); ?>
    <?php get_template_part( 'template-parts/showcase' ); ?>
    <?php get_template_part( 'template-parts/reviews' ); ?>
    <?php get_template_part( 'template-parts/booking' ); ?>
    
    <!-- Здесь будут другие секции: преимущества, меню, отзывы и т.д. -->
</main>

<?php get_footer(); ?>