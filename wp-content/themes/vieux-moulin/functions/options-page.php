<?php
function create_site_options_page(): void
{
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Site Options',
            'menu_title' => 'Site Settings',
            'menu_slug' => 'site-options',
            'capability' => 'edit_posts',
            'redirect' => false
        ]);

        foreach (['fr', 'en'] as $lang) {
            acf_add_options_sub_page([
                'page_title' => sprintf(__('Options du site %s', 'hepl-trad'), strtoupper($lang)),
                'menu_title' => sprintf(__('Options du site %s', 'hepl-trad'), strtoupper($lang)),
                'menu_slug' => 'site-options-' . $lang,
                'post_id' => $lang,
                'parent' => 'site-options',
            ]);
        }
    }
}

add_action('acf/init', 'create_site_options_page');


function get__option($field): mixed
{
    return get_field($field, pll_current_language('slug'));
}