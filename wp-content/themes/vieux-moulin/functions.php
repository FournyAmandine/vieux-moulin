<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



include_once('functions/gutenberg.php');
include_once('functions/head.php');
include_once ('functions/manifest-functions.php');
include_once('functions/images.php');
include_once('functions/post-types.php');
include_once('functions/taxonomies.php');
include_once('functions/navigations.php');
include_once('functions/contact-forms.php');
include_once('functions/options-page.php');
include_once('fields.php');
include_once('functions/classes.php');
require_once __DIR__ . '/../../../vendor/autoload.php';
