<?php get_header(); ?>
<h1 class="front__title"><?= get_the_title(); ?></h1>

<section class="srg">
    <div class="srg__container">
        <div class="srg__text">
            <h2 class="srg__title"><?= get_field('title_srg'); ?></h2>
            <?= get_field('text_srg') ?>
            <a class="srg__link" href="<?= esc_url(get_field('link_srg')) ?>">En découvrir plus sur le Vieux Moulin</a>
        </div>
        <div class="srg__figures">
            <figure class="srg__fig-one">
                <?= wp_get_attachment_image(get_field('image_one_srg'), size: 'small', attr: ['class' => 'srg__img']); ?>
            </figure>
            <figure class="srg__fig-two">
                <?= wp_get_attachment_image(get_field('image_two_srg'), size: 'small', attr: ['class' => 'srg__img']); ?>
            </figure>
        </div>
    </div>
</section>

<section class="news">
    <h2>
        Dernières actualités
    </h2>
    <button class="carousel__prev js-only" aria-label="Voir l'actualité précédente">←</button>
    <div class="news__container">
        <?php
        $news = new WP_Query([
            'post_type' => 'news',
            'meta_key' => 'date_news',
            'orderby' => 'meta_value',
            'order' => 'DESC',
            'posts_per_page' => 3,
        ]);

        if ($news->have_posts()): while ($news->have_posts()): $news->the_post(); ?>
            <article class="news__article--<?= esc_attr(get_post_field('post_name')); ?>">
                <a href="<?= get_the_permalink(); ?>" class="news__link">
                    <span class="sro"><?= get_the_title(); ?></span>
                </a>
                <div class="news__card">
                    <div class="news__text">
                        <figure class="news__fig">
                            <?= get_the_post_thumbnail(size: 'small', attr: ['class' => 'news__img']); ?>
                        </figure>
                        <?php
                        $images = get_field('image_gallery');
                        if ($images):
                            foreach ($images as $image):
                                echo '<img src="' . esc_url($image['sizes']['medium']) . '" alt="' . esc_attr($image['alt']) . '" />';
                            endforeach;
                        endif;
                        ?>
                        <h3 class="news__title"><?= get_the_title(); ?></h3>
                        <?php
                        $date = get_field('date');
                        if ($date): ?>
                            <p class="news__date">
                                <time datetime="<?= date('c', $date) ?>">
                                    <?= date_i18n('d F Y', $date); ?>
                                </time>
                            </p>
                        <?php endif; ?>
                        <?= get_the_excerpt(); ?>
                    </div>
                </div>
            </article>
        <?php endwhile; wp_reset_postdata(); else: ?>
            <p>Il n’y a pas d’actualités récentes pour le moment</p>
        <?php endif; ?>
    </div>
    <button class="carousel__next js-only" aria-label="Voir l'actualité suivante">→</button>
    <a class="news__more" href="<?= get_permalink(88) ?>">Voir plus d'actualités</a>
</section>

<section class="house">
    <h2 class="house__title-first"><?= get_field('title_houses') ?></h2>
    <button aria-labelledby="Foyer précédent" class="carousel__prev js-only">←</button>
    <div class="house__container">
        <?php
        $houses = new WP_Query([
            'post_type' => 'houses',
            'order' => 'ASC',
            'posts_per_page' => 2,
        ]);

        if ($houses->have_posts()): while ($houses->have_posts()): $houses->the_post(); ?>
            <article class="house__article">
                    <figure class="house__fig">
                        <?= wp_get_attachment_image(get_field('profile_image'), size: 'small', attr: ['class' => 'house__img']); ?>
                    </figure>
                    <div class="house__text">
                        <h3 class="house__title"><?= get_field('title_houses') ?></h3>
                        <div class="house__description">
                            <?= get_the_excerpt(); ?>
                        </div>
                            <a class="house__link" href="<?=get_field('home_link'); ?>">Voir plus</a>
                    </div>
            </article>
        <?php endwhile;
            wp_reset_postdata();
        else: ?>
            <p>Il n’y a pas de foyer pour vous</p>
        <?php endif; ?>
    </div>
    <button aria-label="Foyer suivant" class="carousel__next js-only">→</button>
</section>

<section class="donations">
    <div class="donations__container">
        <div class="donations__content">
            <div class="donations__text">
                <h2 class="donations__title"><?= get_field('title_donations'); ?></h2>
                <div class="donations__explanation">
                    <?= get_field('text_donations') ?>
                </div>
                <a class="donations__link" href="<?= get_permalink(30) ?>">Nous soutenir</a>
            </div>
            <figure class="donations__fig">
                <?= wp_get_attachment_image(get_field('image_one_donations'), size: 'small', attr: ['class' => 'donations__img']); ?>
            </figure>
        </div>
    </div>
</section>

<section class="family">
    <div class="family__container">
        <div class="family__content">
            <div class="family__text">
                <h2 class="family__title"><?= get_field('title_family'); ?></h2>
                <?= get_field('text_family') ?>
            </div>
            <div class="family__figures">
                <figure class="family__fig-one">
                    <?= wp_get_attachment_image(get_field('image_one_family'), size: 'small', attr: ['class' => 'family__img']); ?>
                </figure>
                <figure class="family__fig-two">
                    <?= wp_get_attachment_image(get_field('image_two_family'), size: 'small', attr: ['class' => 'family__img']); ?>
                </figure>
            </div>
        </div>
    </div>
</section>

<section class="faq">
    <h2 class="faq__title">FAQ</h2>
    <div class="faq__container">
        <?php
        $themes = get_terms([
            'taxonomy' => 'faq_theme',
            'hide_empty' => false
        ]);

        $last_index = count($themes) - 1;

        foreach ($themes as $index => $theme):
            $faqs = new WP_Query([
                'post_type' => 'faq',
                'posts_per_page' => 10,
                'tax_query' => [
                    [
                        'taxonomy' => 'faq_theme',
                        'field'    => 'term_id',
                        'terms'    => $theme->term_id,
                    ],
                ],
            ]);

            if ($faqs->have_posts()):
                while ($faqs->have_posts()): $faqs->the_post(); ?>
                    <div class="faq__item">
                        <button class="faq__question"><?= get_the_title(); ?> <span class="arrow">▼</span></button>
                        <div class="faq__answer">
                            <?= get_the_content(); ?>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            endif;

            if ($index < $last_index):
                echo '<div class="faq__separator"><img src="/wp-content/themes/vieux-moulin/resources/img/svg/Separateur.svg" alt=""></div>';
            endif;

        endforeach;
        ?>
    </div>
</section>

<section class="helper">
    <h2 class="helper__title"><?= get_field('title_helpers') ?></h2>
    <div class="helper__container">
        <?php
        $helpers = new WP_Query([
            'post_type' => 'helpers',
            'order' => 'ASC',
            'posts_per_page' => 2,
        ]);

        if ($helpers->have_posts()): while ($helpers->have_posts()): $helpers->the_post(); ?>
            <div class="helper__card">
                <figure class="helper__fig">
                    <?= wp_get_attachment_image(get_field('profile_image'), size: 'small', attr: ['class' => 'helper__img']); ?>
                </figure>
            </div>
        <?php endwhile;
            wp_reset_postdata();
        else: ?>
            <p>Il n’y a pas d’aide pour le moment</p>
        <?php endif; ?>
    </div>
</section>


<figure class="moulin__fig-phone">
    <img src="/wp-content/themes/vieux-moulin/resources/img/svg/Moulin.svg" alt="Vieux Moulin en dessin">
</figure>

<?php get_footer(); ?>

