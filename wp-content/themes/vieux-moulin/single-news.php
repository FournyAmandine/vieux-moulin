<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= wp_title('•', false, 'right') . get_bloginfo('name') ?></title>
    <link rel="stylesheet" type="text/css" href="<?= dw_asset('css'); ?>">
    <script src="<?= dw_asset('js') ?>" defer></script>
</head>
<body class="actu">
<?php
if (have_posts()): while (have_posts()):
the_post(); ?>
<header class="actu__header">
    <a class="actu__retour" href="javascript:history.back()">Retour</a>
    <h1 class="actu__title"><?= get_the_title(); ?></h1>
</header>
<main class="actu__main">
    <article class="actu__article">
        <div class="actu__text">
            <h2 class="actu__article-title"><?= get_field('subtitle'); ?></h2>
            <div class="actu__article-text">
                <?= wpautop(get_field('presentation')); ?>
            </div>
        </div>
        <div class="actu__figures">
            <figure class="actu__fig-one">
                <?= wp_get_attachment_image(get_field('profile_image'), 'news', attr: ['class' => 'actu__img']); ?>
            </figure>
            <figure class="actu__fig-two">
                <?= wp_get_attachment_image(get_field('additional_image'), 'news', attr: ['class' => 'actu__img']); ?>
            </figure>
        </div>
    </article>

    <?php
    endwhile;
    else: ?>
        <p><?= __trad('Cette actualité n’existe pas') ?></p>
    <?php endif; ?>
</main>
</body>

