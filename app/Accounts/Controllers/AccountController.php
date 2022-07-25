<?php

namespace app\Accounts\Controllers;

use app\Core\Controller as Controller;
use app\Accounts\Validation\AccountValidator as AccountValidator;
use app\Users\Models\UserModel;
use app\Services\Auth as Auth;

class AccountController extends Controller
{
    private $currentUser;

    public function __construct($routeParams)
    {
        parent::__construct($routeParams);
        $this->currentUser = isset($_SESSION['token']) ? (new UserModel())->getUser(['token' => $_SESSION['token']]) : [];
    }

    public function login()
    {
        if ((new Auth())->isAuth($this->currentUser)) {
            $this->redirect('/users');
        } else {
            $title = 'Login';
            $content = [];

            //проверка на то, что уже авторизован. редирект на /users
            if ($this->routeParams['requestMethod'] == 'GET') {
                $this->render($title, $content);
            } else if ($this->routeParams['requestMethod'] == 'POST') {

                extract($_POST);

                $form = [
                    'email' => $email,
                    'password' => $password,
                ];

                $errors = (new AccountValidator())->validateSingInForm($form);

                if (!empty($errors)) {
                    $content['errors'] = $errors;
                    $content['user'] = $form;
                    $this->render($title, $content);
                } else {
                    $form['password'] = md5($password);
                    $user = (new UserModel())->getUser($form);

                    if (!empty($user) && $user['is_deleted'] === 0) {
                        $_SESSION["token"] = $user['token'];
                        $this->redirect('/users');
                    } else {
                        $content['errors'] = ['Incorrect email or password'];
                        $content['user'] = $form;
                        $this->render($title, $content);
                    }
                }
            }
        }
    }

    public function register()
    {
        if ((new Auth())->isAuth($this->currentUser)) {
            $this->redirect('/users');
        } else {
            $title = 'Register';
            $content = [];

            //проверка на то, что уже авторизован. редирект на /users
            if ($this->routeParams['requestMethod'] == 'GET') {
                $this->render($title, $content);
            } else if ($this->routeParams['requestMethod'] == 'POST') {

                extract($_POST);

                $form = [
                    'email' => $email,
                    'name' => $name,
                    'password' => $password,
                    'repeatPassword' => $repeatPassword,
                ];

                if ($password !== $repeatPassword) {
                    $content['errors'] = ['Passwords don\'t match'];
                    $content['user'] = $form;
                    $this->render($title, $content);
                } else {

                    $errors = (new AccountValidator())->validateSingUpForm($form);

                    if (!empty($errors)) {
                        $content['errors'] = $errors;
                        $content['user'] = $form;
                        $this->render($title, $content);
                    } else {
                        $form['password'] = md5($password);
                        $form['token'] = (string)(time() . rand());
                        $form['status'] = 0;

                        (new UserModel())->insertUser($form);
                        $this->redirect('/login');
                    }
                }
            }
        }
    }
}
