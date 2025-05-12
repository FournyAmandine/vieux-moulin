</main>
<footer class="more">
    <h2 class="more__title">Vous souhaitez en apprendre plus? </h2>
    <?php
    $related_pages = get_field('related_pages');
    if ($related_pages): ?>
    <ul class="more__list">
        <li class="more__home">
            <a class="more__home-link" href="<?= get_home_url() ?>">Accueil</a>
        </li>
        <?php foreach ($related_pages as $page): ?>
            <li class="more__item">
                <a class="more__link" href="<?= get_permalink($page->ID); ?>">
                    <?= get_the_title($page->ID); ?>
                </a>
                <span class="more__text">
                    <?= get_field('cards_presentation', $page->ID) ?>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</footer>
