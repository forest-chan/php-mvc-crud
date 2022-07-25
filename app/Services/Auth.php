<?php

namespace app\Services;


class Auth
{
    public function isAuth($user)
    {
        if (!empty($_SESSION) && isset($_SESSION['token'])) {
            return $_SESSION['token'] == $user['token'];
        }
        return false;
    }

    public function isAdmin($user)
    {
        if (!empty($_SESSION) && isset($_SESSION['token'])) {
            return $user['status'] == 1;
        }
        return false;
    }

}