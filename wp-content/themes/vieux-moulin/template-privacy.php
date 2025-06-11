<?php /* Template Name: Page "Mentions légales" */ ?>

<?php
get_header();
?>
<h1 class="privacy__page-title"><?= get_the_title() ?></h1>

<div class="privacy__container">
    <?php if (have_rows('content')) : ?>
        <?php while (have_rows('content')) : the_row(); ?>
            <?php
            $titre = get_sub_field('title');
            $description = get_sub_field('text');
            ?>
            <div class="privacy__content">
                <h2 class="privacy__title"><?= $titre; ?></h2>
                <div class="privacy__text"><?= $description; ?></div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>
</div>


<?php get_footer(); ?>
