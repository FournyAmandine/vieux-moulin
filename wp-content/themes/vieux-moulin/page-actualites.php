<?php

get_header();?>

    <section>
        <h1>
            Nos actualités
        </h1>
        <div class="news">
            <?php
            $news = new WP_Query([
                'post_type' => 'news',
                'order' => 'DESC',
                'orderby' => 'date',
                'posts_per_page' => 6,
            ]);

            if($news->have_posts()): while($news->have_posts()): $news->the_post(); ?>
                <article class="news__article">
                    <a href="<?= get_the_permalink(); ?>" class="news__link">
                        <span class="sro"><?= get_the_title(); ?></span>
                    </a>
                    <div class="news__card">
                        <figure class="news__fig">
                            <?= get_the_post_thumbnail(size: 'small', attr: ['class' => 'news__img']); ?>
                        </figure>
                        <h2 class="news__title"><?= get_the_title(); ?></h2>
                        <p><time datetime="<?= date('c', $date = get_field('date')); ?>"><?= date_i18n('d F Y', $date); ?></time></p>

                        <?= get_the_excerpt();?>
                    </div>
                </article>
            <?php endwhile; else: ?>
                <p>Il n’y a pas d’actualités récentes pour le moment</p>
            <?php endif; ?>
        </div>
    </section>

<?php




