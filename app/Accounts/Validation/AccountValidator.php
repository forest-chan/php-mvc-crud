<?php


namespace app\Accounts\Validation;

use app\Services\AbstractValidator as AbstractValidator;


class AccountValidator extends AbstractValidator
{
    public function __construct()
    {
        
    }

    public function validateSingUpForm(array $form)
    {
        if (!$this->isEmailValid($form['email'])) {
            $this->errors['email'] = 'Email isn\'t valid.';
        }
        if (!$this->isPasswordValid($form['password'])) {
            $this->errors['password'] = 'Password isn\'t valid. It should contain only numbers and letters and be more than 3 symbols.';
        }
        if (!$this->isNameValid($form['name'])) {
            $this->errors['name'] = 'Name isn\'t valid. It should contain only letters.';
        }
        if ($this->isEmailUnique()) {
            $this->errors['emailUnique'] = 'User with such email already exists';
        }

        return $this->errors;
    }

    public function validateSingInForm(array $form)
    {
        if (!$this->isEmailValid($form['email']) || !$this->isPasswordValid($form['password'])) {
            $this->errors['email'] = 'Incorrect email or password';
        }

        return $this->errors;
    }
}
