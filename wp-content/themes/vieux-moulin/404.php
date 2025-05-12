<?php
 get_header(); ?>

    <div class="not-found">
        <h1 class="not-found__title">Page non trouvée</h1>
        <p class="not-found__message">Désolé, la page que vous recherchez n’existe pas ou a été déplacée.</p>
        <p class="not-found__message">
            Retour à la
            <a href="<?= home_url(); ?>" title="Retour à la page d’accueil" class="not-found__link">
                page d’accueil
            </a>
        </p>
    </div>

<?php get_footer(); ?>