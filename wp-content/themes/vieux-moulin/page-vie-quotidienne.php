<?php

get_header();

?>
    <section class="program">
        <h2><?= get_the_title(); ?></h2>
        <figure class="program__fig">
            <?= wp_get_attachment_image(get_field('profile_image'), size: 'small', attr: ['class' => 'program__img']); ?>
        </figure>
    </section>

    <section class="group">
        <h2><?= get_field('group_title') ?></h2>
        <div class="group__container">
            <figure class="program__fig">
                <?= wp_get_attachment_image(get_field('additional_image'), size: 'small', attr: ['class' => 'program__img']); ?>
            </figure>
            <?= get_field('explanation') ?>
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

    <section class="activity">
        <h2><?= get_field('title_activities'); ?></h2>
        <div class="activity__container">
            <?php
            $activities = new WP_Query([
                'post_type' => 'news',
                'order' => 'ASC',
                'posts_per_page' => 3,
                'tax_query' => [
                    'relation' => 'AND',
                    [
                        'taxonomy' => 'news_type',
                        'field' => 'slug',
                        'terms' => ['enfants'],
                        'include_children' => true,
                        'operator' => 'IN'
                    ]
                ],
            ]);

            if ($activities->have_posts()): while ($activities->have_posts()): $activities->the_post(); ?>
                <div class="activity__card">
                    <figure class="activity__fig">
                        <?= get_the_post_thumbnail(size: 'small', attr: ['class' => 'activity__img']); ?>
                    </figure>
                    <h3 class="activity__title"><?= get_the_title(); ?></h3>
                    <p><time datetime="<?= date('c', $date = get_field('date')); ?>"><?= date_i18n('d F Y', $date); ?></time></p>
                    <?= get_the_excerpt(); ?>
                </div>
            <?php endwhile;
                wp_reset_postdata(); else: ?>
                <p>Il n’y a pas d’actualités pour le moment</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="team">
        <h2 class="team__title"><?= get_field('') ?></h2>
        <div class="team_container">
            <?php
            $people = new WP_Query([
                'post_type' => 'team',
                'order' => 'ASC',
                'posts_per_page' => 6,
            ]);

            if ($people->have_posts()): while ($people->have_posts()): $people->the_post(); ?>
                <article class="team__article">
                    <figure class="team__fig">
                        <?= wp_get_attachment_image(get_field('profile_image'), size: 'small', attr: ['class' => 'team__img']); ?>
                    </figure>
                    <h3 class="team__title"><?= get_the_title(); ?></h3>
                    <?= get_the_content(); ?>
                </article>
            <?php endwhile;
                wp_reset_postdata();
            else: ?>
                <p>Il n’y a pas d’employé pour le moment</p>
            <?php endif; ?>
        </div>
    </section>

<?php

get_footer('link');
