<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= wp_title('•', false, 'right') . get_bloginfo('name') ?></title>
    <link rel="stylesheet" type="text/css" href="<?= dw_asset('css'); ?>">
    <script src="<?= dw_asset('js') ?>" defer></script>
    <link rel="icon" type="image/png" href="resources/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="resources/favicon/favicon.svg" />
    <link rel="shortcut icon" href="resources/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="resources/favicon/apple-touch-icon.png" />
    <link rel="manifest" href="resources/favicon/site.webmanifest" />
</head>
<body <?php body_class(); ?>>
<header>
    <nav class="nav" aria-label="Navigation principale">
        <div class="nav__phone">
            <a class="nav__item--Accueil" hreflang="fr" href="<?= get_home_url() ?>" title="Aller à la page d'accueil"><span>Vieux Moulin</span></a>
            <input class="nav__check" type="checkbox" id="menu-toggle">
            <label class="nav__toggle" aria-expanded="false" aria-label="Menu principal" for="menu-toggle">
                <svg class="nav__svg" width="30" height="30" viewBox="0 0 30 30" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path class="nav__path" d="M6.25 9.30469H23.75" stroke-width="2"></path>
                    <path class="nav__path" d="M6.25 15.554H23.75" stroke-width="2"></path>
                    <path class="nav__path" d="M6.25 21.8047H23.75" stroke-width="2"></path>
                </svg>
            </label>
            <ul class="nav__container">
                <?php foreach (dw_get_navigation_links('header') as $link): ?>
                    <li class="nav__item nav__item--<?= $link->label; ?>">
                        <a title="Aller vers <?= $link->label; ?>" href="<?= $link->href; ?>" class="nav__link"><?= $link->label; ?></a>
                        <?php if (!empty($link->children)): ?>
                            <span class="arrow">▼</span>
                            <ul class="nav__submenu">
                                <?php foreach ($link->children as $sublink): ?>
                                    <li class="nav__submenu-item">
                                        <a title="Aller vers <?= $sublink->label; ?>" href="<?= $sublink->href; ?>"
                                           class="nav__submenu-link"><?= $sublink->label; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="nav__soutenir">
                <a href="<?= get_permalink(30) ?>" title="Aller faire un don" class="nav__soutenir-link">Nous soutenir</a>
            </div>
        </div>
    </nav>
</header>
<main>