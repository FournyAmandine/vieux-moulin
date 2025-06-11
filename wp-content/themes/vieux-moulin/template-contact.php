<?php /* Template Name: Page "Contact" */ ?>

<?php get_header(); ?>
        <h1 class="contact__title">Contactez-nous!</h1>
 <?php
if(have_posts()): while(have_posts()): the_post(); ?>

    <section class="contact">
        <div class="contact__hook">
            <?= get_field('contact_hook')?>
        </div>
        <div class="contact__right">
            <?php
            $errors = $_SESSION['contact_form_errors'] ?? [];
            unset($_SESSION['contact_form_errors']);
            $success = $_SESSION['contact_form_success'] ?? false;
            unset($_SESSION['contact_form_success']);

            if($success): ?>
                <div class="contact__success">
                    <p><?= $success; ?></p>
                </div>
            <?php else: ?>
                <form action="<?= admin_url('admin-post.php'); ?>" method="POST" class="contact__form">
                    <fieldset class="contact__form__fields">
                        <div class="contact__form-name">
                            <div class="contact__field">
                                <label for="firstname" class="contact__field-label">Entrez votre prénom</label>
                                <input type="text" name="firstname" id="firstname" class="contact__field-input" placeholder="Laurent">
                                <?php if(isset($errors['firstname'])): ?>
                                    <p class="contact__field-error"><?= $errors['firstname']; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="contact__field">
                                <label for="lastname" class="contact__field-label">Entrez votre nom</label>
                                <input type="text" name="lastname" id="lastname" class="contact__field-input" placeholder="Bourguignon">
                                <?php if(isset($errors['lastname'])): ?>
                                    <p class="contact__field-error"><?= $errors['lastname']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="contact__field">
                            <label for="email" class="contact__field-label">Entrez votre adresse email</label>
                            <input type="email" name="email" id="email" class="contact__field-input" placeholder="Laurent.bourguignon@gmail.be">
                            <?php if(isset($errors['email'])): ?>
                                <p class="contact__field-error"><?= $errors['email']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="contact__field">
                            <label for="subject" class="contact__field-label">Sélectionner votre sujet</label>
                            <select class="contact__field-select" name="subject" id="subject">
                                <option value="Choix">Choisissez une option</option>
                                <option value="Dons">Dons</option>
                                <option value="Bénévolat">Bénévolat</option>
                                <option value="Foyers">Foyers</option>
                                <option value="Journée">Journée</option>
                                <option value="Informations juridiques">Informations juridiques</option>
                                <option value="Autre">Autre</option>
                            </select>
                            <?php if(isset($errors['subject'])): ?>
                                <p class="contact__field-error"><?= $errors['subject']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="contact__field">
                            <label for="message" class="contact__field-label">Entrez votre message</label>
                            <textarea name="message" id="message" class="contact__field-input" placeholder="J'aimerai faire un don..."></textarea>
                            <?php if(isset($errors['message'])): ?>
                                <p class="contact__field-error"><?= $errors['message']; ?></p>
                            <?php endif; ?>
                        </div>
                    </fieldset>
                    <div class="contact__form-submit">
                        <input type="hidden" name="action" value="dw_submit_contact_form">
                        <button type="submit" class="contact__btn">Envoyer votre message</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </section>

<?php
endwhile; else: ?>
    <p>Il n’y a rien sur cette page</p>
<?php endif; ?>
<?php get_footer('link'); ?>