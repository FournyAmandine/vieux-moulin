<?php
get_header();
?>

    <section class="composition">
        <h1><?= get_the_title(); ?></h1>
        <div class="compostion__container">
            <?php
            $rooms = new WP_Query([
                'post_type' => 'composition',
                'order' => 'ASC',
                'posts_per_page' => 3,
                'tax_query' => [
                    'relation' => 'AND',
                    [
                        'taxonomy' => 'house',
                        'field' => 'slug',
                        'terms' => ['vieux-moulin'],
                        'include_children' => true,
                        'operator' => 'IN'
                    ]
                ],
            ]);

            if ($rooms->have_posts()): while ($rooms->have_posts()): $rooms->the_post(); ?>
                <div class="composition__card">
                    <h2 class="composition__title"><?= get_the_title(); ?></h2>
                    <div class="composition__text">
                        <?= get_the_content(); ?>
                    </div>
                </div>
            <?php endwhile;
                wp_reset_postdata(); else: ?>
                <p><?= __trad('Il n’y a pas de pièce pour le moment') ?></p>
            <?php endif; ?>
        </div>
    </section>

    <section class="galerie">
        <?php
        $images = get_field('image_gallery');
        foreach ($images as $image):
            echo '<img src="' . esc_url($image['sizes']['medium']) . '" alt="' . esc_attr($image['alt']) . '" />';
        endforeach;
        ?>
    </section>

    <section class="layout">
        <div class="layout__div">
            <?php
            $layouts = new WP_Query([
                'post_type' => 'secondary',
                'order' => 'ASC',
                'posts_per_page' => 2,
            ]);

            if ($layouts->have_posts()): while ($layouts->have_posts()): $layouts->the_post(); ?>
                <div class="layout__card">
                    <h2 class="layout__title"><?= get_the_title(); ?></h2>
                    <p class="layout__text"><?= get_the_content(); ?></p>
                    <div class="layout__fig">
                        <?php
                        $images = get_field('image_gallery');
                        if ($images):
                            foreach ($images as $image):
                                echo '<img src="' . esc_url($image['sizes']['medium']) . '" alt="' . esc_attr($image['alt']) . '" />';
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
            <?php endwhile;
                wp_reset_postdata(); else: ?>
                <p><?= __trad('Il n’y a pas d’autre aménagement pour vous') ?></p>
            <?php endif; ?>
        </div>
    </section>

    <section class="project">
        <h1><?= get_field('title_projects') ?></h1>
        <button class="carousel__prev">←</button>
        <div class="project__div">
            <?php
            $projects = new WP_Query([
                'post_type' => 'projects',
                'order' => 'ASC',
            ]);

            if ($projects->have_posts()): while ($projects->have_posts()): $projects->the_post(); ?>
                <div class="project__card">
                    <figure class="project__fig">
                        <?= wp_get_attachment_image(get_field('profile_image'), size: 'small', attr: ['class' => 'house__img']); ?>
                    </figure>
                    <div class="project__content">
                        <h2 class="project__title"><?= get_the_title(); ?></h2>
                        <div class="project__text"><?= get_field('text'); ?></div>
                    </div>
                </div>
            <?php endwhile;
                wp_reset_postdata(); else: ?>
                <p>Il n’y a pas de projets pour le moment</p>
            <?php endif; ?>
        </div>
        <button class="carousel__next">→</button>
    </section>

    <a class="link" href="<?= get_permalink(46); ?>">Aller voir l’Edelweiss</a>


<?php
get_footer();
