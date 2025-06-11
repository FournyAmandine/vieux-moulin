<?php


use DW_Theme\Forms\ContactForm;

require __DIR__ . '/../forms/ContactForm.php';

add_action('admin_post_nopriv_dw_submit_contact_form', 'dw_handle_contact_form');
add_action('admin_post_dw_submit_contact_form', 'dw_handle_contact_form');

function dw_handle_contact_form()
{

    $form = (new ContactForm('contact_message'))

        ->rule('firstname', 'required')
        ->rule('lastname', 'required')
        ->rule('email', 'required')
        ->rule('email', 'email')
        ->rule('subject', 'required')
        ->rule('subject', 'in_collection')
        ->rule('message', 'required')
        ->rule('message', 'no_test')
        ->sanitize('firstname', 'sanitize_text_field')
        ->sanitize('lastname', 'sanitize_text_field')
        ->sanitize('email', 'sanitize_text_field')
        ->sanitize('subject', 'sanitize_text_field')
        ->sanitize('message', 'sanitize_textarea_field');

    return $form->handle($_POST);
}