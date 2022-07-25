<?php

namespace app\Users\Controllers;

use app\Core\Controller as Controller;
use app\Services\Pagination as Pagination;
use app\Users\Validation\UserValidator as UserValidator;
use app\Services\AvatarSettingsService as AvatarSettingsService;
use app\Services\Auth as Auth;

class UserController extends Controller
{
    private $currentUser;

    public function __construct($routeParams)
    {
        parent::__construct($routeParams);
        $this->currentUser = isset($_SESSION['token']) ? $this->model->getUser(['token' => $_SESSION['token']]) : [];
    }

    public function index()
    {
        if (!(new Auth())->isAuth($this->currentUser)) {
            require $_SERVER['DOCUMENT_ROOT'] . '/views/errors/401.php';
            die;
        } else {
            $recordsOnPage = 8;
            $pagination = new Pagination($this->model->getCountOfUsers(), $recordsOnPage);
            $countOfPages = $pagination->getCountOfPages();
            $currentPage = $pagination->getCurrentPage();

            $users = $this->model->getUsersPerPage($pagination->getOffset(), $pagination->getRecodsOnPage());
            $adminState = $this->currentUser['status'];
            $title = 'Users';

            $content = [
                'currentUser' => $this->currentUser,
                'users' => $users,
                'currentPage' => $currentPage,
                'countOfPages' => $countOfPages,
                'adminState' => $adminState,
            ];

            $this->render($title, $content);
        }
    }

    public function view()
    {
        if (!(new Auth())->isAuth($this->currentUser)) {
            require $_SERVER['DOCUMENT_ROOT'] . '/views/errors/401.php';
            die;
        } else {
            if (isset($this->routeParams['id']) && $this->routeParams['requestMethod'] == 'GET') {
                $id = $this->routeParams['id'];
                $user = $this->model->getUser(['id' => $id]);


                $title = 'View user';
                $content = [
                    'user' => $user,
                    'adminState' => $this->currentUser['status'],
                ];

                $this->render($title, $content);
            }
        }
    }

    public function create()
    {

        if (!(new Auth())->isAdmin($this->currentUser)) {
            require $_SERVER['DOCUMENT_ROOT'] . '/views/errors/401.php';
            die;
        } else {
            $title = 'Create user';
            $content = [];

            if ($this->routeParams['requestMethod'] == 'GET') {

                $this->render($title, $content);
            } elseif ($this->routeParams['requestMethod'] == 'POST') {

                extract($_POST);

                $form = [
                    'email' => $email,
                    'name' => $name,
                    'password' => $password,
                ];

                $newUser = $this->model->getUser(['email' => $email]);
                $errors = (new UserValidator($newUser))->validateCreateForm($form);

                if (!empty($errors)) {
                    unset($form['password']);
                    $content['errors'] = $errors;
                    $content['form'] = $form;
                    $this->render($title, $content);
                } else {
                    $form['password'] = md5($password);
                    $form['token'] = (string)(time() . rand());
                    $form['status'] = isset($isAdmin) ? 1 : 0;

                    $this->model->insertUser($form);
                    $this->redirect('/users');
                }
            }
        }
    }

    public function edit()
    {
        if (!((new Auth())->isAdmin($this->currentUser) || $this->routeParams['id'] == $this->currentUser['id'])) {
            require $_SERVER['DOCUMENT_ROOT'] . '/views/errors/401.php';
            die;
        } else {
            if (isset($this->routeParams['id']) && $this->routeParams['requestMethod'] == 'GET') {
                $id = $this->routeParams['id'];
                $user = $this->model->getUser(['id' => $id]);

                $title = 'Edit user';
                $content = [
                    'user' => $user,
                    'adminState' => $this->currentUser['status'],
                ];

                $this->render($title, $content);
            } elseif (isset($this->routeParams['id']) && $this->routeParams['requestMethod'] == 'POST') {

                extract($_POST);

                $form = [
                    'email' => $email,
                    'name' => $name,
                    'password' => $password,
                ];

                $currentUser = $this->model->getUser(['id' => $this->routeParams['id']]);

                if ($currentUser['email'] == $email) {
                    unset($form['email']);
                }
                if (empty($form['password'])) {
                    unset($form['password']);
                }

                $errors = (new UserValidator($currentUser))->validateEditForm($form);

                $form['password'] = isset($form['password']) ? md5($form['password']) : $currentUser['password'];
                $form['email'] = !isset($form['email']) ? $currentUser['email'] : $form['email'];
                $form['id'] = $id;

                if (!empty($errors)) {
                    $title = 'Edit user';
                    $content = [
                        'user' => $form,
                        'errors' => $errors,
                    ];

                    $this->render($title, $content);
                } else {
                    $this->model->updateUser($form);
                    $this->redirect('/users');
                }
            }
        }
    }

    public function delete()
    {
        if (!(new Auth())->isAdmin($this->currentUser)) {
            require $_SERVER['DOCUMENT_ROOT'] . '/views/errors/401.php';
            die;
        } else {
            if (isset($this->routeParams['id']) && $this->routeParams['requestMethod'] == 'GET') {
                $id = $this->routeParams['id'];


                if ($id == $this->currentUser['id']) {
                    $this->redirect('/users');
                } else {
                    $fieldsToUpdate = [
                        'is_deleted' => 1,
                        'id' => $id,
                    ];

                    $this->model->updateUser($fieldsToUpdate);
                    $this->redirect('/users');
                }
            }
        }
    }

    public function myprofile()
    {
        if (!(new Auth())->isAuth($this->currentUser)) {
            require $_SERVER['DOCUMENT_ROOT'] . '/views/errors/401.php';
            die;
        } else {
            if ($this->routeParams['requestMethod'] == 'GET') {
                $title = 'My profile';
                $adminState = $this->currentUser['status'];
                $content = [
                    'user' => $this->currentUser,
                    'adminState' => $adminState,
                ];

                $this->render($title, $content);
            } elseif ($this->routeParams['requestMethod'] == 'POST') {
                if (!empty($_POST) && isset($_POST['submit'])) {
                    if (isset($_FILES['avatar']) and $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
                        if ($filename = (new AvatarSettingsService($_FILES))->setAvatar($this->currentUser)) {
                            $fieldsToUpdate = [
                                'avatar' => $filename,
                                'id' => $this->currentUser['id'],
                            ];
                            $this->model->updateUser($fieldsToUpdate);
                        }
                    }
                }
                $this->redirect('/users/myprofile');
            }
        }
    }

    public function logout()
    {
        if (!empty($_SESSION) && isset($_SESSION['token'])) {
            unset($_SESSION['token']);
            $this->redirect('/login');
        } else {
            $this->redirect('/users');
        }
    }
}
