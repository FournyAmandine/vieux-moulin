<?php
get_header();
?>

    <section class="composition">
        <h1><?= get_the_title(); ?></h1>
        <div class="composition__div">
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
                    <h2 class="composition__title"><?= get_the_title(); ?></h2>
                    <?= get_the_content(); ?>
                </div>
            <?php endwhile; wp_reset_postdata(); else: ?>
                <p>Il n’y a pas de pièce pour le moment</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="galerie" aria-labelledby="galerie__title">
        <h2 id="galerie__title" class="sro">Galerie d’images du foyer</h2>
        <?php if( have_rows('image_gallery') ): ?>
            <div class="gallery__images">
                <?php while( have_rows('image_gallery') ): the_row();
                    $image = get_sub_field('image_alone');
                    if ($image): ?>
                        <img src="<?= esc_url($image['sizes']['medium']) ?>" alt="<?= esc_attr($image['alt']) ?>" />
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </section>

    <section class="project">
        <h2><?= get_field('title_projects') ?></h2>
        <button id="prev-el" aria-label="Projet précédent" class="carousel__prev js-only">←</button>
        <div class="project__div">
            <?php
            $projects = new WP_Query([
                'post_type' => 'projects',
                'order' => 'ASC',
            ]);

            if ($projects->have_posts()): while ($projects->have_posts()): $projects->the_post(); ?>
                <article class="project__card">
                    <figure class="project__fig">
                        <?= wp_get_attachment_image(get_field('profile_image'), size: 'small', attr: ['class' => 'house__img']); ?>
                    </figure>
                    <div class="project__content">
                        <h3 class="project__title"><?= get_the_title(); ?></h3>
                        <div class="project__text"><?= get_field('text'); ?></div>
                    </div>
                </article>
            <?php endwhile;
                wp_reset_postdata(); else: ?>
                <p>Il n’y a pas de projet pour le moment</p>
            <?php endif; ?>
        </div>
        <button id="next-el" aria-label="Projet suivant" class="carousel__next js-only">→</button>
    </section>

    <a class="link" title="Aller voir le second foyer" href="<?= get_the_permalink(50); ?>">Aller voir le Vieux Moulin</a>

<?php
get_footer();
