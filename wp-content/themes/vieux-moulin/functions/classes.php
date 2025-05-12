<?php

function class_body($classes) {
    if (is_page(14)) {
        $classes[] = 'home-page';
    }
    return $classes;
}
add_filter('body_class', 'class_body');