<?php
get_header(); ?>

    <section class="srg">
        <h2 class="srg__title">“Le Vieux Moulin à Strainchamps ce n’est pas juste un SRG, un service résidentiel, c’est
            chez eux.”</h2>
        <?= get_field('description') ?>
        <figure class="srg_fig">
            <?= wp_get_attachment_image(get_field('profile_image'), 'medium', attr: ['class' => 'srg__img']); ?>
        </figure>
    </section>

    <section class="history">
        <h2 class="history__title"><?= get_field('title_of_the_story') ?></h2>
        <figure class="history__fig">
            <?= wp_get_attachment_image(get_field('additional_image'), size: 'medium', attr: ['class' => 'history__img']); ?>
        </figure>
        <?= get_field('history') ?>
    </section>

    <section class="mission">
        <h2 class="srg__title"><?= get_field('mission_title') ?></h2>
        <div class="mission__container">
            <?php
            $missions = new WP_Query([
                'post_type' => 'missions',
                'order' => 'ASC',
                'posts_per_page' => 1,
            ]);

            if ($missions->have_posts()): while ($missions->have_posts()): $missions->the_post(); ?>
                <article class="mission__article">
                    <div class="mission__card">
                        <h3 class="mission__title"><?= get_the_title(); ?></h3>
                        <?= get_field('text') ?>
                        <figure class="mission__fig">
                            <?= wp_get_attachment_image(get_field('additional_image'), size: 'small', attr: ['class' => 'mission__img']); ?>
                        </figure>
                    </div>
                </article>
            <?php endwhile;
                wp_reset_postdata();
            else: ?>
                <p>Il n’y a pas de missions pour le moment</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="house">
        <h3 class="house__title-first"><?= get_field('title_houses') ?></h3>
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
                        <h4 class="house__title"><?= get_field('title_houses') ?></h4>
                        <span class="house__description">
                            <?= get_the_excerpt(); ?>
                        </span>
                        <a class="house__link" href="<?= get_the_permalink(); ?>">Voir plus</a>
                    </div>
                </article>
            <?php endwhile;
                wp_reset_postdata();
            else: ?>
                <p>Il n’y a pas de foyer pour vous</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="gallery">
        <h2 class="gallery__title"><?= get_field('gallery_title') ?></h2>
        <?php
        $images = get_field('image_gallery');
        foreach ($images as $image):
            echo '<img src="' . esc_url($image['sizes']['medium']) . '" alt="' . esc_attr($image['alt']) . '" />';
        endforeach;
        ?>
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
                        <span class="sro">Aller sur le site partenaire</span>
                    </a>
                    <div class="partner__card">
                        <figure class="partner__fig">
                            <?= wp_get_attachment_image(get_field('profile_image'), size: 'small', attr: ['class' => 'partner__img']); ?>
                        </figure>
                        <h3 class="partner__title"><?= get_the_title(); ?></h3>
                    </div>
                </article>
            <?php endwhile;
                wp_reset_postdata(); else: ?>
                <p>Il n’y a pas de partenaires pour le moment</p>
            <?php endif; ?>
        </div>
    </section>


<?php
get_footer('link');

