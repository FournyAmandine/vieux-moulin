<?php
get_header(); ?>

    <section class="srg">
        <h1 class="srg__title">“Le Vieux Moulin à Strainchamps ce n’est pas juste un SRG, un service résidentiel, c’est
            chez eux.”</h1>
        <div class="srg__content">
            <div class="srg__desc">
                <?= get_field('description') ?>
            </div>
            <figure class="srg__fig">
                <?= wp_get_attachment_image(get_field('profile_image'), 'medium', attr: ['class' => 'srg__img']); ?>
            </figure>
        </div>
    </section>

    <section class="history">
        <h1 class="history__title"><?= get_field('title_of_the_story') ?></h1>
        <div class="history__content">
            <figure class="history__fig">
                <?= wp_get_attachment_image(get_field('additional_image'), size: 'medium', attr: ['class' => 'history__img']); ?>
            </figure>
            <div class="history__desc">
                <?= get_field('history') ?>
            </div>
        </div>
    </section>

    <section class="mission">
        <h1 class="srg__title"><?= get_field('mission_title') ?></h1>
        <button class="carousel__prev">←</button>
        <div class="mission__container">
            <?php
            $missions = new WP_Query([
                'post_type' => 'missions',
                'order' => 'ASC',
            ]);

            if ($missions->have_posts()): while ($missions->have_posts()): $missions->the_post(); ?>
                <article class="mission__article">
                    <div class="mission__card">
                        <h2 class="mission__title"><?= get_the_title(); ?></h2>
                        <div class="mission__content">
                            <div class="mission__text">
                                <?= get_field('text') ?>
                            </div>
                            <figure class="mission__fig">
                                <?= wp_get_attachment_image(get_field('additional_image'), size: 'small', attr: ['class' => 'mission__img']); ?>
                            </figure>
                        </div>
                    </div>
                </article>
            <?php endwhile;
                wp_reset_postdata();
            else: ?>
                <p>Il n’y a pas de missions pour le moment</p>
            <?php endif; ?>
        </div>
        <button class="carousel__next">→</button>
    </section>

    <section class="house">
        <h1 class="house__title-first"><?= get_field('title_houses') ?></h1>
        <button class="carousel__prev">←</button>
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
                        <h2 class="house__title"><?= get_field('title_houses') ?></h2>
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
        <button class="carousel__next">→</button>
    </section>

    <section class="gallery">
        <h1 class="gallery__title"><?= get_field('gallery_title') ?></h1>
        <div class="gallery__images">
            <?php
            $images = get_field('image_gallery');
            foreach ($images as $image):
                echo '<img src="' . esc_url($image['sizes']['medium']) . '" alt="' . esc_attr($image['alt']) . '" />';
            endforeach;
            ?>
        </div>
    </section>

    <section class="videos">
        <h1 class="videos__title">
            <?= esc_html(get_field('video_title')) ?>
        </h1>

        <div class="videos__carousel">

            <div class="videos-videos">
                <?php
                $videos = get_field('videos');
                if (!empty($videos)):
                    foreach ($videos as $index => $single_video):
                        $video = $single_video['video'];
                        if (!$video) continue;

                        $active_class = $index === 0 ? 'active' : '';
                        ?>
                        <video
                                autoplay muted playsinline preload="auto"
                                class="videos-video <?= esc_attr($active_class); ?>">
                            <source src="<?= esc_url($video['url']); ?>"
                                    type="<?= esc_attr($video['mime_type']); ?>">
                            <?= __('Votre navigateur ne supporte pas la lecture de vidéos.', 'textdomain') ?>
                        </video>
                    <?php endforeach;
                endif; ?>
            </div>

        </div>
    </section>


    <section class="partner">
        <h1 class="partner__title"><?= get_field('title_partners') ?></h1>
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
                        <h2 class="partner__title"><?= get_the_title(); ?></h2>
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

