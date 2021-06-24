<?php

include_once 'User.php';

class Data
{
    public static $path = 'data.json';

    public static function loadData()
    {
        $dataJson = file_get_contents(self::$path);
        $data = json_decode($dataJson);
        return self::convertUser($data);
    }

    public static function saveData($data)
    {
        $dataJson = json_encode($data);
        file_put_contents(self::$path, $dataJson);
    }

    public static function convertUser($data)
    {
        $users = [];
        foreach ($data as $item) {
            $user = new User($item->name, $item->password,$item->email);
            array_push($users, $user);
        }
        return $users;
    }

    public function addUser($user)
    {
        $users = self::loadData();
        array_push($users, $user);
        self::saveData($users);
    }

    public static function checkLogin($user)
    {
        $users = self::loadData();
        foreach ($users as $item) {
            if ($user->name == $item->name && $user->password == $item->password) {
                return true;
            }
        }
        return false;
    }

    public static function checkUsername($username)
    {
        $pattern = "/^[A-Za-z]{6,}$/";
        if (!preg_match($pattern,$username)){
            session_start();
            $_SESSION['username']="Ugly username!";
        }

    }
    public static function checkEmail($email)
    {
        $pattern = "/^[A-Za-z0-9]+[A-Za-z0-9]*@[A-Za-z0-9]+(\.[A-Za-z0-9]+)$/";
        if (!preg_match($pattern,$email)){
            session_start();
            $_SESSION['email']="This is not a real email!!";
        }

    }
    public static function checkPassword($password)
    {
        $pattern = "/^[A-Za-z]{6,}$/";
        if (!preg_match($pattern,$password)){
            session_start();
            $_SESSION['password']="Stupid password!";
        }

    }

    public static function login($username, $password, $email)
    {
        $user = new User($username, $password, $email);
        if (self::checkUsername($user)) {

            header('location:.../add-product.php');
        } else {
            echo 'Check your register form again';
        }
    }
}