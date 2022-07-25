<?php

namespace app\Services;

abstract class AbstractValidator
{
    protected $errors;
    protected $currentEntity;


    public function __construct(array $entity)
    {
        $this->currentEntity = $entity;
    }

    protected function isNameValid(string $name): bool
    {
        // only lowercase and uppercase chars
        $pattern = '/^[A-Za-z]+$/';

        return preg_match($pattern, $name);
    }

    protected function isPasswordValid(string $password): bool
    {
        // length of a password >= 6 and only lowercase and uppercase chars and digits
        $neededLength = 3;
        $pattern = '/^[A-Za-z0-9]+$/';

        return strlen($password) >= $neededLength && (preg_match($pattern, $password));
    }

    protected function isEmailValid(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }


    protected function isEmailUnique(): bool
    {
        return isset($this->currentEntity['email']);
    }

    public function validateEditForm(array $form)
    {
    }

    public function validateСreateForm(array $form)
    {
    }

    public function validateSingUpForm(array $form)
    {
    }

    public function validateSingInForm(array $form)
    {
    }
}
