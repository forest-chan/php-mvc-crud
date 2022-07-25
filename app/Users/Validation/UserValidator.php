<?php

namespace app\Users\Validation;

use app\Services\AbstractValidator as AbstractValidator;


class UserValidator extends AbstractValidator
{

    public function __construct($user)
    {
        parent::__construct($user);
    }

    public function validateCreateForm(array $form)
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

    public function validateEditForm(array $form)
    {
        if (!$this->isNameValid($form['name'])) {
            $this->errors['name'] = 'Name isn\'t valid. It should contain only letters.';
        }
        if (isset($form['password'])) {
            if (!$this->isPasswordValid($form['password'])) {
                $this->errors['password'] = 'Password isn\'t valid. It should contain only numbers and letters and be more than 3 symbols.';
            }
        }
        if (isset($form['email'])) {
            if ($this->isEmailUnique()) {
                $this->errors['emailUnique'] = 'User with such email already exists';
            }
            if (!$this->isEmailValid($form['email'])) {
                $this->errors['email'] = 'Email isn\'t valid';
            }
        }

        return $this->errors;
    }

}
