<?php

namespace app\Users\Models;

use app\Core\Model as Model;


class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers()
    {
        $users = [];
        $sql = "SELECT * FROM";

        $stmt = $this->db->query($sql);
        $users = $this->db->fetchAll($stmt);

        return $users;
    }

    public function getUser($fieldsToGet)
    {
        // creating sql query string
        $sql = "SELECT * FROM users WHERE ";
        foreach (array_keys($fieldsToGet) as $key) {
            $sql .= "`$key`=?and ";
        }
        $sql = trim($sql, 'and ');

        // preparing and execution sql query
        $user = [];
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_values($fieldsToGet));

        if ($tmp = $this->db->fetch($stmt)) {
            $user = [
                'id' => $tmp['id'],
                'email' => $tmp['email'],
                'name' => $tmp['name'],
                'password' => $tmp['password'],
                'token' => $tmp['token'],
                'status' => $tmp['status'],
                'is_deleted' => $tmp['is_deleted'],
                'avatar' => $tmp['avatar'],
            ];
        }
        
        return $user;
    }

    public function getUsersPerPage($from, $recordsOnPage)
    {
        $users = [];
        $sql = "SELECT * FROM users WHERE (id>0 AND is_deleted=0) ORDER BY id DESC LIMIT $from,$recordsOnPage";

        $stmt = $this->db->query($sql);
        $users = $this->db->fetchAll($stmt);

        return $users;
    }

    public function getCountOfUsers()
    {
        $count = 0;
        $sql = "SELECT COUNT(*) as count FROM users WHERE is_deleted=0";

        $stmt = $this->db->query($sql);
        $count = $this->db->fetch($stmt)['count'];

        return $count;
    }

    public function insertUser(array $userInfo)
    {
        $isDeleted = 0;
        $sql = "INSERT INTO users VALUES (NULL,?,?,?,?,?,$isDeleted, 'default.png')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userInfo['email'], $userInfo['name'], $userInfo['password'], $userInfo['token'], $userInfo['status']]);
    }

    public function updateUser(array $fieldsToUpdate)
    {
        // id should be the last field!
        // creating sql query string
        $sql = "UPDATE `users` SET ";

        foreach (array_keys($fieldsToUpdate) as $key) {
            if ($key != 'id') {
                $sql .= "`$key`=?, ";
            }
        }
        $sql = trim($sql, ', ') . ' WHERE `id`=?';

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_values($fieldsToUpdate));
    }
}
