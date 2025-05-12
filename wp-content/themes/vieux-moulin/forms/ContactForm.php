<?php

namespace DW_Theme\Forms;

class ContactForm
{
    protected array $rules = [];
    protected array $sanitizers = [];

    public function __construct(string $post_type)
    {

    }

    public function rule(string $field, string $rule): static
    {
        if(! array_key_exists($field, $this->rules)) {
            $this->rules[$field] = [];
        }

        $this->rules[$field][] = $rule;

        return $this;
    }

    public function sanitize(string $field, string $callback): static
    {
        $this->sanitizers[$field] = $callback;

        return $this;
    }

    public function handle(array $data): void
    {
        if(is_array($errors = $this->validate($data))) {
            $_SESSION['contact_form_errors'] = $errors;
            wp_safe_redirect($_SERVER['HTTP_REFERER']);
            exit();
        }

        $data = $this->cleanData($data);

        // Sauvegarder le formulaire envoyé en base de données.
        // TODO.

        wp_insert_post([
            'post_type' => 'contact_message',
            'post_title' => $data['first_name'] . ' ' . $data['lastname'],
            'post_content' => $this->generateEmailContent($data),
            'post_status' => 'publish',
        ]);
        wp_mail(
            to: 'amandine.fourny@student.hepl.be',
            subject: 'Nouveau message de contact',
            message: $this->generateEmailContent($data),
        );

        $_SESSION['contact_form_success'] = 'Merci, '.$data['firstname'].'! Votre message a bien été envoyé.';
        wp_safe_redirect($_SERVER['HTTP_REFERER']);
        exit();
    }

    protected function validate(array $data): bool|array
    {
        $errors = [];

        foreach ($this->rules as $field => $rules) {
            foreach ($rules as $rule) {
                $method = 'check_'.$rule;
                $validation = $this->$method($field, $data[$field] ?? null);
                if($validation === true) continue;
                $errors[$field] = $validation;
                break;
            }
        }

        return $errors ?: true;
    }

    protected function check_required(string $field, mixed $value): bool|string
    {
        if($value || $value == 0) {
            return true;
        }

        return 'Veuillez renseigner ce champ.';
    }

    protected function check_email(string $field, mixed $value): bool|string
    {
        if(filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return 'Adresse invalide.';
    }

    protected function check_no_test(string $field, mixed $value): bool|string
    {
        if(! is_string($value)) {
            return true;
        }

        if(strpos($value, 'test') === false) {
            return true;
        }

        return 'Ce champ ne peut pas contenir le mot "test".';
    }

    protected function check_in_collection(string $field): bool|string
    {
        $collection = require __DIR__ . '/../config/subjects.php';
        if (array_key_exists($field, $_REQUEST) &&
            trim($_REQUEST[$field]) !== '' &&
            !array_key_exists($_REQUEST[$field], $collection)) {
            return 'Cette proposition ne fait pas partie de celles proposées.';
        }

        return true;
    }

    protected function cleanData(array $data): array
    {
        $cleaned = [];

        foreach($this->sanitizers as $field => $callback) {
            $cleaned[$field] = call_user_func($callback, $data[$field] ?? null);
        }

        return $cleaned;
    }

    protected function generateEmailContent(array $data): string
    {
        return 'Bonjour,'.PHP_EOL
            .'Vous avez un nouveau message de '.$data['firstname'].' '.$data['lastname'].':'.PHP_EOL
            .'Le sujet est '.$data['subject'].PHP_EOL
            .$data['message'].PHP_EOL.PHP_EOL
            .'----'.PHP_EOL
            .'Adresse mail: '.$data['email'];
    }

}