</main>
<footer class="more">
    <h1 class="more__title">Vous souhaitez en apprendre plus? </h1>
    <?php
    $related_pages = get_field('related_pages');
    if ($related_pages): ?>
    <ul class="more__list">
        <li class="more__home">
            <a class="more__home-link" href="<?= get_home_url() ?>"><span class="more__home-span">Accueil</span></a>
        </li>
        <?php foreach ($related_pages as $page): ?>
            <li class="more__item">
                <a class="more__link" href="<?= get_permalink($page->ID); ?>">
                    <?= get_the_title($page->ID); ?>
                    <span class="more__text">
                    <?= get_field('cards_presentation', $page->ID) ?>
                </span>
                </a>

            </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</footer>
