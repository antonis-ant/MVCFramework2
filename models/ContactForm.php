<?php


namespace app\models;


use tonyanant\phpmvc\Model;

class ContactForm extends Model
{
    public string $subject = '';
    public string $email = '';
    public string $body = '';


    public function rules(): array {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'body' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array {
        return [
            'subject' => 'Enter your subject',
            'email' => 'Email',
            'body' => "Enter your message"
        ];
    }

    public function send() {
        return true;
    }

}