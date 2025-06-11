<?php /* Template Name: Template News */ ?>

<?php get_header(); ?>
<h1 class="news__page-title">Nos actualités</h1>
<section class="news__section">
<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$taxonomy = isset($_GET['filter']) ? sanitize_text_field($_GET['filter']) : '';
$args = [
    'post_type' => 'news',
    'meta_key' => 'date_news',
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'posts_per_page' => 6,
    'paged' => $paged,
];

if ($taxonomy !== '') {
    $args['tax_query'] = [
        [
            'taxonomy' => 'news_type',
            'field' => 'slug',
            'terms' => $taxonomy,
        ]
    ];
}

$query = new WP_Query($args);
?>

<?php
$terms = get_terms([
    'taxonomy' => 'news_type',
    'hide_empty' => false,
]);

$current_filter = isset($_GET['filter']) ? sanitize_text_field($_GET['filter']) : '';
?>

    <div class="news__filters">
        <a href="<?= esc_url(get_permalink()); ?>" class="<?= ($current_filter === '') ? 'news__active' : 'news__filter'; ?>">
            <?= __('Tout', 'hepl-trad'); ?>
        </a>

        <?php foreach ($terms as $term): ?>
            <a href="<?= esc_url(get_permalink()) . '?filter=' . $term->slug; ?>"
               class="<?= ($current_filter === $term->slug) ? 'news__active' : 'news__filter'; ?>">
                <?= esc_html($term->name); ?>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="news__articles">
    <button class="carousel__prev">←</button>
<?php
if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
        ?>
        <article class="news__article">
            <a href="<?= get_the_permalink(); ?>" class="news__link">
                <span class="sro"><?= get_the_title(); ?></span>
            </a>
            <div class="news__card">
                <figure class="news__fig">
                    <?= wp_get_attachment_image(get_field('profile_image'), 'news'); ?>
                </figure>
                <h2 class="news__title"><?= get_the_title(); ?></h2>
                <p class="news__date">
                    <time datetime="<?= date('c', $date = get_field('date')); ?>"><?= date_i18n('d F Y', $date); ?></time>
                </p>

                <div class="news__text"><?= get_the_excerpt(); ?></div>
            </div>
        </article>
    <?php
    endwhile; ?>
    </div>

    <button class="carousel__next"  id="next__news">→</button>
</section>


    <?php echo '<div class="pagination">';
    echo paginate_links(array(
        'total' => $query->max_num_pages,
        'current' => $paged,
        'prev_text' => '&laquo; Précédent',
        'next_text' => 'Suivant &raquo;',
    ));
    echo '</div>';

    wp_reset_postdata();
else :
    echo '<p>Aucune actualité n’a été trouvée</p>';
endif;

?>



<?php get_footer('link'); ?>