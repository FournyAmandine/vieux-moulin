<?php
get_header();
?>

    <section class="composition">
        <h2><?= get_the_title(); ?></h2>
        <div class="compostion__div">
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
                        'terms' => ['edelweiss'],
                        'include_children' => true,
                        'operator' => 'IN'
                    ]
                ],
            ]);

            if ($rooms->have_posts()): while ($rooms->have_posts()): $rooms->the_post(); ?>
                <div class="composition__card">
                    <h3 class="composition__title"><?= get_the_title(); ?></h3>
                    <?= get_the_content(); ?>
                </div>
            <?php endwhile; wp_reset_postdata(); else: ?>
                <p>Il n’y a pas de pièce pour le moment</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="gallery">
        <h2 class="gallery__title sro"><?= get_field('gallery_title') ?></h2>
        <?php
        $images = get_field('image_gallery');
        foreach ($images as $image):
            echo '<img src="' . esc_url($image['sizes']['medium']) . '" alt="' . esc_attr($image['alt']) . '" />';
        endforeach;
        ?>
    </section>

    <section class="project">
        <h2><?= get_field('') ?></h2>
        <div class="project__div">
            <?php
            $projects = new WP_Query([
                'post_type' => 'projects',
                'order' => 'ASC',
                'posts_per_page' => 1,
            ]);

            if ($projects->have_posts()): while ($projects->have_posts()): $projects->the_post(); ?>
                <div class="project__card">
                    <figure class="house__fig">
                        <?= wp_get_attachment_image(get_field('profile_image'), size: 'small', attr: ['class' => 'house__img']); ?>
                    </figure>
                    <h3 class="project__title"><?= get_the_title(); ?></h3>
                    <p class="project__text"><?= get_field('text'); ?></p>
                </div>
            <?php endwhile;
                wp_reset_postdata(); else: ?>
                <p>Il n’y a pas de projet pour le moment</p>
            <?php endif; ?>
        </div>
    </section>

    <a href="<?= get_field('second_home_link'); ?>">Aller voir le Vieux Moulin</a>

<?php
get_footer();
