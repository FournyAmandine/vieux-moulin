<?php



function enqueue_assets_from_vite_manifest(): void
{
    $manifestPath = get_theme_file_path('public/.vite/manifest.json');

    if (file_exists($manifestPath)) {
        $manifest = json_decode(file_get_contents($manifestPath), true);

        // Vérifier et ajouter le fichier JavaScript
        if (isset($manifest['wp-content/themes/dw/resources/js/main.js'])) {
            wp_enqueue_script('dw',
                get_theme_file_uri('public/' . $manifest['wp-content/themes/dw/resources/js/main.js']['file']), [], null, true);
        }

        // Vérifier et ajouter le fichier CSS
        if (isset($manifest['wp-content/themes/dw/resources/css/styles.scss'])) {
            wp_enqueue_style('dw',
                get_theme_file_uri('public/' . $manifest['wp-content/themes/dw/resources/css/styles.scss']['file']));
        }
    }
}

enqueue_assets_from_vite_manifest();


function dw_asset(string $file): string
{
    $manifestPath = get_theme_file_path('public/.vite/manifest.json');

    if (file_exists($manifestPath)) {
        $manifest = json_decode(file_get_contents($manifestPath), true);

        if (isset($manifest['wp-content/themes/vieux-moulin/resources/js/main.js']) && $file === 'js') {
            return get_theme_file_uri('public/' . $manifest['wp-content/themes/vieux-moulin/resources/js/main.js']['file']);
        }

        if (isset($manifest['wp-content/themes/vieux-moulin/resources/css/styles.scss']) && $file === 'css') {
            return get_theme_file_uri('public/' . $manifest['wp-content/themes/vieux-moulin/resources/css/styles.scss']['file']);
        }
    }

    return get_template_directory_uri() . '/public/' . $file;
}

