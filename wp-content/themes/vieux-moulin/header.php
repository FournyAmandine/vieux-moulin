<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= wp_title('•', false, 'right') . get_bloginfo('name') ?></title>
    <link rel="stylesheet" type="text/css" href="<?= dw_asset('css'); ?>">
    <script src="<?= dw_asset('js') ?>" defer></script>
</head>
<body <?php body_class(); ?>>
<header>
    <nav class="nav">
        <h1 class="sro">Navigation principale</h1>
        <ul class="nav__container">
            <?php foreach (dw_get_navigation_links('header') as $link): ?>
                <li class="nav__item nav__item--<?= $link->label; ?>">
                    <a href="<?= $link->href; ?>" class="nav__link"><?= $link->label; ?></a>
                    <?php if (!empty($link->children)): ?>
                        <ul class="nav__submenu">
                            <?php foreach ($link->children as $sublink): ?>
                                <li class="nav__submenu-item">
                                    <a href="<?= $sublink->href; ?>"
                                       class="nav__submenu-link"><?= $sublink->label; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
</header>
<main>