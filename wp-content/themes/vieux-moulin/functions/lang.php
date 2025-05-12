<?php

function trad_load_textdomain(): void
{
    load_theme_textdomain('hepl-trad', get_template_directory() . '/locales');
}

add_action('after_setup_theme', 'trad_load_textdomain');

function __trad(string $translation, array $replacements = [])
{
    $base = __($translation, 'hepl-trad');

    foreach ($replacements as $key => $value) {
        $variable = ':' . $key;
        $base = str_replace($variable, $value, $base);
    }

    return $base;
}