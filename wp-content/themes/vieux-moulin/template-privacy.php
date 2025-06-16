<?php /* Template Name: Page "Mentions légales" */ ?>

<?php get_header(); ?>

<h1 class="privacy__page-title"><?= esc_html(get_the_title()); ?></h1>

<div class="privacy__container">
    <?php if (have_rows('content')) : ?>
        <?php while (have_rows('content')) : the_row(); ?>
            <?php
            $title = get_sub_field('title');
            $text  = get_sub_field('text');
            ?>

            <?php if ($title || $text): ?>
                <section class="privacy__content">
                    <?php if ($title): ?>
                        <h2 class="privacy__title"><?= esc_html($title); ?></h2>
                    <?php endif; ?>

                    <?php if ($text): ?>
                        <div class="privacy__text">
                            <?= wp_kses_post($text); ?>
                        </div>
                    <?php endif; ?>
                </section>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php else: ?>
        <p><?= esc_html__('Aucune mention légale disponible pour le moment.', 'hepl-trad'); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
