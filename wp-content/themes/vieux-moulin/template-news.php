<?php /* Template Name: Template News */ ?>

<?php get_header(); ?>
<h2 class="news__page-title">Nos actualités</h2>
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

    <div class="news__filter">
        <a href="<?= esc_url(get_permalink()); ?>" class="<?= ($current_filter === '') ? 'active-news' : ''; ?>">
            <?= __('Tout', 'hepl-trad'); ?>
        </a>

        <?php foreach ($terms as $term): ?>
            <a href="<?= esc_url(get_permalink()) . '?filter=' . $term->slug; ?>"
               class="<?= ($current_filter === $term->slug) ? 'active-news' : ''; ?>">
                <?= esc_html($term->name); ?>
            </a>
        <?php endforeach; ?>
    </div>
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
                        <?= get_the_post_thumbnail(size: 'small', attr: ['class' => 'news__img']); ?>
                    </figure>
                    <h3 class="news__title"><?= get_the_title(); ?></h3>
                    <p>
                        <time datetime="<?= date('c', $date = get_field('date')); ?>"><?= date_i18n('d F Y', $date); ?></time>
                    </p>

                    <p><?= the_excerpt(); ?></p>
                </div>
            </article>
    <?php
    endwhile;

    echo '<div class="pagination">';
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