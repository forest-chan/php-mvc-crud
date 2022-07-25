<?php


return [

    "login" => [
        "controller" => "app/Accounts/Controllers/AccountController",
        "action" => "login"
    ],

    "register" => [
        "controller" => "app/Accounts/Controllers/AccountController",
        "action" => "register"
    ],

    "users" => [
        "controller" => "app/Users/Controllers/UserController",
        "action" => "index"
    ],

    "users/logout" => [
        "controller" => "app/Users/Controllers/UserController",
        "action" => "logout"
    ],

    "users/myprofile" => [
        "controller" => "app/Users/Controllers/UserController",
        "action" => "myprofile"
    ],

    "users/create" => [
        "controller" => "app/Users/Controllers/UserController",
        "action" => "create"
    ],

    "users/(\d+)" => [
        "controller" => "app/Users/Controllers/UserController",
        "action" => "view"
    ],

    "users/(\d+)/edit" => [
        "controller" => "app/Users/Controllers/UserController",
        "action" => "edit"
    ],

    "users/(\d+)/delete" => [
        "controller" => "app/Users/Controllers/UserController",
        "action" => "delete"
    ],



];
