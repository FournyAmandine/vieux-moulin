<?php


register_post_type('news', [
    'label' => 'Actualités',
    'description' => 'Les actualités concernant le vieux moulin',
    'menu_position' => 5,
    'menu_icon' => 'dashicons-media-document',
    'public' => true,
    'rewrite' => [
        'slug' => 'actualites'
    ],
    'supports' => [
        'title',
        'excerpt',
    ]
]);

register_post_type('houses', [
    'label' => 'Foyers',
    'description' => 'Les foyers qui accueilleront les enfants',
    'menu_position' => 5,
    'menu_icon' => 'dashicons-admin-home',
    'public' => true,
    'rewrite' => [
        'slug' => 'foyers'
    ],
    'supports' => [
        'title',
        'excerpt',
        'thumbnail',
    ]
]);

register_post_type('missions', [
    'label' => 'Missions',
    'description' => 'Les différentes missions/valeurs que le vieux moulin transmet',
    'menu_position' => 5,
    'menu_icon' => 'dashicons-awards',
    'public' => true,
    'rewrite' => [
        'slug' => 'missions'
    ],
    'supports' => [
        'title',
        'thumbnail',
    ]
]);

register_post_type('partners', [
    'label' => 'Partenaires',
    'description' => 'Les partenaires du vieux moulin',
    'menu_position' => 5,
    'menu_icon' => 'dashicons-businessman',
    'public' => true,
    'rewrite' => [
        'slug' => 'partenaires'
    ],
    'supports' => [
        'title',
        'thumbnail',
    ]
]);

register_post_type('resources', [
    'label' => 'Ressources',
    'description' => 'Les différentes resources nécessaires à mettre',
    'menu_position' => 5,
    'menu_icon' => 'dashicons-list-view',
    'public' => true,
    'rewrite' => [
        'slug' => 'resources'
    ],
    'supports' => [
        'title',
    ]
]);

register_post_type('projects', [
    'label' => 'Projets',
    'description' => 'Les projets que le vieux moulin aimerait réaliser',
    'menu_position' => 5,
    'menu_icon' => 'dashicons-hammer',
    'public' => true,
    'rewrite' => [
        'slug' => 'projets'
    ],
    'supports' => [
        'title',
        'thumbnail',
    ]
]);

register_post_type('composition', [
    'label' => 'Composition foyer',
    'description' => 'Les éléments qui composent les différents foyer',
    'menu_position' => 5,
    'menu_icon' => 'dashicons-admin-network',
    'public' => true,
    'rewrite' => [
        'slug' => 'composition'
    ],
    'supports' => [
        'title',
        'editor',
    ]
]);


register_post_type('secondary', [
    'label' => 'Aménagements secondaires',
    'description' => 'Des aménagements secondaires du Vieux Moulin qui sont disponibles',
    'menu_position' => 5,
    'menu_icon' => 'dashicons-admin-home',
    'public' => true,
    'rewrite' => [
        'slug' => 'secondary_development'
    ],
    'supports' => [
        'title',
        'editor',
    ]
]);

register_post_type('team', [
    'label' => 'Equipe',
    'description' => 'Les membres de l’équipe du Vieux Moulin',
    'menu_position' => 5,
    'menu_icon' => 'dashicons-groups',
    'public' => true,
    'rewrite' => [
        'slug' => 'team'
    ],
    'supports' => [
        'title',
        'editor',
        'thumbnail',
    ]
]);

register_post_type('helpers', [
    'label' => 'Aides',
    'description' => 'Les aides du Vieux Moulin',
    'menu_position' => 5,
    'menu_icon' => 'dashicons-groups',
    'public' => true,
    'rewrite' => [
        'slug' => 'team'
    ],
    'supports' => [
        'title',
        'thumbnail',
    ]
]);

register_post_type('faq', [
    'label' => 'FAQ',
    'description' => 'Les questions que les utilisateurs pourraient se poser',
    'menu_position' => 5,
    'menu_icon' => 'dashicons-format-status',
    'public' => true,
    'rewrite' => [
        'slug' => 'faq'
    ],
    'supports' => [
        'title',
        'editor',
    ]
]);

register_post_type('contact_message', [
    'label' => 'Message de contact',
    'description' => 'Les envois de formulaire via la page de contact',
    'menu_position' => 5,
    'menu_icon' => 'dashicons-email',
    'public' => true,
    'has_archive' => false,
    'supports' => [
        'title',
        'editor',
    ]
]);


/*function create_custom_post_type($slug, $name, $description, $supports = ['title', 'editor'], $menu_position = 5, $menu_icon = 'dashicons-admin-post') {
    $labels = [
        'name'                  => $name . 's',
        'singular_name'         => $name,
        'menu_name'             => $name . 's',
        'name_admin_bar'        => $name,
        'add_new'               => 'Ajouter ' . $name,
        'add_new_item'          => 'Ajouter un ' . $name,
        'edit_item'             => 'Modifier ' . $name,
        'new_item'              => 'Nouveau ' . $name,
        'view_item'             => 'Voir ' . $name,
        'search_items'          => 'Rechercher des ' . $name . 's',
        'not_found'             => 'Aucun ' . $name . ' trouvé',
        'not_found_in_trash'    => 'Aucun ' . $name . ' dans la corbeille',
    ];

    register_post_type($slug, [
        'labels'                => $labels,
        'description'           => $description,
        'public'                => true,
        'rewrite'               => [
            'slug' => strtolower($name) // Optionnel : choisis un slug propre pour l'URL
        ],
        'supports'              => $supports,
        'menu_position'         => $menu_position,
        'menu_icon'             => $menu_icon,
        'has_archive'           => true,
    ]);
}*/
