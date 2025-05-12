<?php
register_nav_menu('header', 'Le menu de navigation principale en haut de page');
register_nav_menu('footer', 'Le menu de navigation principale en fin de page');
function dw_get_navigation_links(string $location): array
{
    $locations = get_nav_menu_locations();

    if (!isset($locations[$location])) {
        return [];
    }

    $nav_id = $locations[$location];
    $nav = wp_get_nav_menu_items($nav_id);

    $links = [];
    $temp_links = [];

    foreach ($nav as $post) {
        $link = new stdClass();
        $link->href = $post->url;
        $link->label = $post->title;
        $link->children = [];
        $link->parent_id = $post->menu_item_parent;

        $temp_links[$post->ID] = $link;

        if ($link->parent_id == 0) {
            $links[] = $link;
        }
    }

    foreach ($nav as $post) {
        if ($post->menu_item_parent != 0) {
            $parent_id = $post->menu_item_parent;
            $sublink = new stdClass();
            $sublink->href = $post->url;
            $sublink->label = $post->title;
            $sublink->icon = get_field('icon', $post);

            $temp_links[$parent_id]->children[] = $sublink;
        }
    }

    return $links;
}
