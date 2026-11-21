<?php
/**
 * Шаблон страницы записей (Блог)
 * WordPress использует этот файл для /blog/ когда в Настройки → Чтение выбрана "Страница записей"
 */
get_header();
?>

<main class="blog-archive animate-on-scroll">
    <div class="blog-archive__container">
        
        <!-- Заголовок -->
        <header class="blog-archive__header">
            <span class="blog-archive__eyebrow">Блог Italian Taste</span>
            <h1 class="blog-archive__title">Все статьи</h1>
        </header>

        <!-- Цикл WordPress -->
        <?php if (have_posts()) : ?>
            <div class="blog-archive__grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="post-card animate-child">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="post-card__image">
                                <?php the_post_thumbnail('medium_large', array('loading' => 'lazy')); ?>
                            </a>
                        <?php endif; ?>
                        
                        <div class="post-card__content">
                            <div class="post-card__meta">
                                <time datetime="<?php echo get_the_date('c'); ?>">
                                    <?php echo get_the_date('d.m.Y'); ?>
                                </time>
                            </div>
                            
                            <h2 class="post-card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <p class="post-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                            
                            <a href="<?php the_permalink(); ?>" class="post-card__link">Читать далее →</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Пагинация -->
            <div class="blog-archive__pagination">
                <?php 
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => '← Назад',
                    'next_text' => 'Вперёд →',
                )); 
                ?>
            </div>
        <?php else : ?>
            <p class="blog-archive__empty">Статей пока нет. Создайте первую запись в админке!</p>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>