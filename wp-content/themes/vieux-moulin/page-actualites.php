<?php
get_header();
?>

<section>
    <h1>Nos actualités</h1>
    <div class="news">
        <?php
        $news = new WP_Query([
            'post_type' => 'news',
            'posts_per_page' => 6,
            'orderby' => 'date',
            'order' => 'DESC',
        ]);

        if ($news->have_posts()):
            while ($news->have_posts()): $news->the_post(); ?>
                <article class="news__article">
                    <a href="<?= esc_url(get_the_permalink()); ?>" class="news__link">
                        <span class="sro"><?= esc_html(get_the_title()); ?></span>
                    </a>
                    <div class="news__card">
                        <figure class="news__fig">
                            <?= get_the_post_thumbnail(null, 'small', ['class' => 'news__img']); ?>
                        </figure>
                        <h2 class="news__title"><?= esc_html(get_the_title()); ?></h2>

                        <?php
                        $date = get_field('date');
                        if ($date): ?>
                            <p>
                                <time datetime="<?= esc_attr(date('c', $date)); ?>">
                                    <?= esc_html(date_i18n('d F Y', $date)); ?>
                                </time>
                            </p>
                        <?php endif; ?>

                        <?= get_the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile;
            wp_reset_postdata();
        else: ?>
            <p>Il n’y a pas d’actualités récentes pour le moment</p>
        <?php endif; ?>
    </div>
</section>
