<?php

//Taille d'image
add_theme_support( 'post-thumbnails');
add_image_size('news', 378, 326, true);


//Image responsive
function responsive_image($image, $settings): bool|string
{
    if (empty($image)) {
        return '';
    }

    $image_id = '';

    if (is_numeric($image)) {
        $image_id = $image;
    } elseif (is_array($image) && isset($image['ID'])) {
        $image_id = $image['ID'];
    }

    $alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
    $image_post = get_post($image_id);
    $title = $image_post->post_title ?? '';
    $name = $image_post->post_name ?? '';
    $src = wp_get_attachment_image_url($image_id, 'full');
    $srcset = wp_get_attachment_image_srcset($image_id, 'full');
    $sizes = wp_get_attachment_image_sizes($image_id, 'full');
    $lazy = $settings['lazy'] ?? 'eager';
    $classes = '';
    if (!empty($settings['classes'])) {
        $classes = is_array($settings['classes']) ? implode(' ', $settings['classes']) : $settings['classes'];
    }

    ob_start();
    ?>
    <picture>
        <img
            src="<?= esc_url($src) ?>"
            alt="<?= esc_attr($alt) ?>"
            loading="<?= esc_attr($lazy) ?>"
            srcset="<?= esc_attr($srcset) ?>"
            sizes="<?= esc_attr($sizes) ?>"
            class="<?= esc_attr($classes) ?>">
    </picture>
    <?php
    return ob_get_clean();
}


//Format d'image
function my_own_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'my_own_mime_types');
