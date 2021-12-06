<?php


namespace app\models;


use tonyanant\phpmvc\Application;
use tonyanant\phpmvc\Model;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules(): array {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function login() {
        $user = new User();
        $user = $user->findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'User with this email does not exist');
            return false;
        }

        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Incorrect password');
            return false;
        }

        return Application::$app->login($user);
    }

    public function labels(): array {
        return [
          'email' => 'Your email',
          'password' => 'Password'
        ];
    }
}