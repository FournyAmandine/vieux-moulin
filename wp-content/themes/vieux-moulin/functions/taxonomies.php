<?php
register_taxonomy('news_type', ['news'], [
    'labels' => [
        'name' => 'Les types d’actualités',
        'singular' => 'Les types d’actualités'
    ],
    'description' => 'Les types d’actualités',
    'public' => true,
    'hierarchical' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'rewrite' => ['slug' => 'type-d-actualites'],
],
);

register_taxonomy('house', ['composition'], [
    'labels' => [
        'name' => 'La maison',
        'singular_name' => 'La maison'
    ],
    'description' => 'Quelle est la maison qui correspond',
    'public' => true,
    'hierarchical' => true,
    'show_tagcloud' => false,
    'rewrite' => ['slug' => 'maison'],
]);

register_taxonomy('faq_theme', ['faq'], [
    'labels' => [
        'name' => 'Le thème de la question',
        'singular_name' => 'Le thème de la question'
    ],
    'description' => 'Quelle est le thème de la question',
    'public' => true,
    'hierarchical' => true,
    'show_tagcloud' => false,
    'rewrite' => ['slug' => 'theme-question'],
]);
