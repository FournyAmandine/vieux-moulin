<?php
get_header();
?>

    <section class="presentation">
        <h1><?= esc_html(get_the_title()); ?></h1>
        <div class="presentation__subtitle">
            <?= get_field('subtitle'); ?>
        </div>
        <div class="presentation__text">
            <?= get_field('text') ?>
        </div>
    </section>

    <section class="code">
        <figure class="code__fig">
            <?= wp_get_attachment_image(get_field('profile_image'), size: 'small', attr: ['class' => 'code__img']); ?>
        </figure>
        <div class="code__container">
            <h2><?= get_field('title_qr_code') ?></h2>
            <?= get_field('informations') ?>
        </div>
    </section>

    <section class="activities">
        <h2><?= get_field('title_activities'); ?></h2>
        <button id="prev-activity" aria-label="Voir l'activité précédente" class="carousel__prev js-only">←</button>
        <div class="activities__container">
            <?php
            $activities = new WP_Query([
                'post_type' => 'news',
                'order' => 'ASC',
                'posts_per_page' => 2,
                'tax_query' => [
                    'relation' => 'AND',
                    [
                        'taxonomy' => 'news_type',
                        'field' => 'slug',
                        'terms' => ['dons'],
                        'include_children' => true,
                        'operator' => 'IN'
                    ]
                ],
            ]);


            if ($activities->have_posts()): while ($activities->have_posts()): $activities->the_post(); ?>
                <div class="activities__card">
                    <figure class="activities__fig">
                        <?= get_the_post_thumbnail(size: 'small', attr: ['class' => 'activities__img']); ?>
                        <?php if( have_rows('image_gallery') ): ?>
                            <div class="activities__images">
                                <?php while( have_rows('image_gallery') ): the_row();
                                    $image = get_sub_field('image_alone');
                                    if ($image): ?>
                                        <img src="<?= esc_url($image['sizes']['medium']) ?>" alt="<?= esc_attr($image['alt']) ?>" />
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </figure>
                    <h3 class="activities__title"><?= get_the_title(); ?></h3>
                    <?php
                    $date = get_field('date');
                    if ($date): ?>
                        <p class="activities__date">
                            <time datetime="<?= date('c', $date) ?>">
                                <?= date_i18n('d F Y', $date); ?>
                            </time>
                        </p>
                    <?php endif; ?>
                    <p class="activities__text">
                        <?= get_the_excerpt(); ?>
                    </p>
                </div>
            <?php endwhile;
                wp_reset_postdata(); else: ?>
                <p>Il n’y a pas d’actualités pour le moment</p>
            <?php endif; ?>
                <button id="next-activity" aria-label="Voir l'activité suivante" class="carousel__next js-only">→</button>
    </section>

    <section class="partner">
        <h2 class="partner__title"><?= get_field('title_partners') ?></h2>
        <div class="partner__container">
            <?php
            $partners = new WP_Query([
                'post_type' => 'partners',
                'order' => 'ASC',
                'posts_per_page' => 3,
            ]);

            if ($partners->have_posts()): while ($partners->have_posts()): $partners->the_post(); ?>
                <article class="partner__article">
                    <a href="<?= get_field('site_link'); ?>">
                        <span class="sro"> Aller sur le site partenaire</span>
                    </a>
                    <div class="partner__card">
                        <figure class="partner__fig">
                            <?= wp_get_attachment_image(get_field('profile_image'), size: 'small', attr: ['class' => 'partner__img']); ?>
                        </figure>
                        <h3 class="partner__title"><?= get_the_title(); ?></h3>
                    </div>
                </article>
            <?php endwhile; wp_reset_postdata(); else: ?>
                <p>Il n’y a pas de partenaires pour le moment</p>
            <?php endif; ?>
        </div>
    </section>
<?php
get_footer('link');
