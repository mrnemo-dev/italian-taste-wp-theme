<?php
/**
 * Шаблон одиночной записи (Статья блога)
 */
get_header();
?>

<main class="single-post animate-on-scroll">
    <article class="single-post__container">
        
        <!-- Навигация назад -->
        <div class="single-post__back">
            <a href="<?php echo get_post_type_archive_link('post'); ?>">← Все статьи</a>
        </div>

        <!-- Заголовок и мета -->
        <header class="single-post__header">
            <div class="single-post__meta">
                <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('d.m.Y'); ?></time>
                <?php 
                $categories = get_the_category();
                if ($categories) {
                    echo '<span>•</span><a href="' . get_category_link($categories[0]->term_id) . '">' . esc_html($categories[0]->name) . '</a>';
                }
                ?>
            </div>
            <h1 class="single-post__title"><?php the_title(); ?></h1>
        </header>

        <!-- Главное изображение -->
        <?php if (has_post_thumbnail()) : ?>
            <div class="single-post__featured-image">
                <?php the_post_thumbnail('large', array('loading' => 'eager')); ?>
            </div>
        <?php endif; ?>

        <!-- Контент статьи -->
        <div class="single-post__content">
            <?php the_content(); ?>
        </div>

        <!-- Теги (если есть) -->
        <?php 
        $tags = get_the_tags();
        if ($tags) : ?>
            <div class="single-post__tags">
                <span>Теги:</span>
                <?php foreach ($tags as $tag) : ?>
                    <a href="<?php echo get_tag_link($tag->term_id); ?>" class="single-post__tag">#<?php echo esc_html($tag->name); ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </article>
</main>

<?php get_footer(); ?>