<?php

get_header();

?>
    <h2>Ressources</h2>

    <div class="resource">
        <?php
        $resources = new WP_Query([
            'post_type' => 'resources',
            'order' => 'ASC',
            'posts_per_page' => 5,
        ]);

        if ($resources->have_posts()): while ($resources->have_posts()): $resources->the_post();
            $file = get_field('downloadable_file'); ?>

            <div class="resource__item">
                <button class="resource__title"><?= get_the_title(); ?> <span class="arrow">▼</span></button>
                <?php if ($file): ?>
                    <div class="resource__content">
                        <a href="<?= esc_url($file['url']); ?>" download>
                            Télécharger <?= esc_html($file['filename']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile;
            wp_reset_postdata();
        else: ?>
            <p>Il n’y a pas de missions pour le moment</p>
        <?php endif; ?>
    </div>

<?php

get_footer('link');