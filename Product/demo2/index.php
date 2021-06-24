<?php
include_once 'Data.php';
include_once 'User.php';
session_start();

if ($_SERVER['REQUEST_METHOD']=='POST')
{
    $u = $_POST['uname'];
    $p = $_POST['psw'];
    $mail = $_POST['email'];
    $user = new User($u,$p,$mail);
    Data::checkUsername($u);
    Data::checkEmail($mail);
    Data::checkPassword($p);
} else
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $u = $_POST['uname'];
    $p = $_POST['psw'];
    $mail = $_POST['email'];
    if (empty($u) || empty($p) || empty($mail)) {
        echo '<b> Please enter username and password!</b>';
    }
     else {
        $user = new  User($u, $p, $mail);
        Data::addUser($user);
        header('location:lesson12.module2/Product/product-list.php');
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            background: #C5E1A5;
        }
        form {
            width: 60%;
            margin: 60px auto;
            background: #efefef;
            padding: 60px 120px 80px 120px;
            text-align: center;
            -webkit-box-shadow: 2px 2px 3px rgba(0,0,0,0.1);
            box-shadow: 2px 2px 3px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            position: relative;
            margin: 40px 0px;
        }
        .label-txt {
            position: absolute;
            top: -1.6em;
            padding: 10px;
            font-family: sans-serif;
            font-size: .8em;
            letter-spacing: 1px;
            color: rgb(120,120,120);
            transition: ease .3s;
        }
        .input {
            width: 100%;
            padding: 10px;
            background: transparent;
            border: none;
            outline: none;
        }

        .line-box {session_start();
            position: relative;
            width: 100%;
            height: 2px;
            background: #BCBCBC;
        }

        .line {
            position: absolute;
            width: 0%;
            height: 2px;
            top: 0px;
            left: 50%;
            transform: translateX(-50%);
            background: #8BC34A;
            transition: ease .6s;
        }

        .input:focus + .line-box .line {
            width: 100%;
        }

        .label-active {
            top: -3em;
        }

        button {
            display: inline-block;
            padding: 12px 24px;
            background: rgb(220,220,220);
            font-weight: bold;
            color: rgb(120,120,120);
            border: none;
            outline: none;
            border-radius: 3px;
            cursor: pointer;
            transition: ease .3s;
        }

        button:hover {
            background: #8BC34A;
            color: #ffffff;
        }
    </style>
</head>
<body>
<form method="post">
    <label>
        <p class="label-txt"></p>
        <input type="text" placeholder="ENTER YOUR EMAIL" class="input" name="email">
        <p class=" text-danger"><?php ; if (isset($_SESSION['email'])){ echo $_SESSION['email']; session_destroy();} ?></p>
        <div class="line-box">
            <div class="line"></div>
        </div>
    </label>
    <label>
        <p class="label-txt"></p>
        <input type="text" placeholder="ENTER YOUR NAME" class="input" name="uname">
        <p class="text-danger"><?php ; if (isset($_SESSION['username'])){ echo $_SESSION['username'];session_destroy(); } ?></p>
        <div class="line-box">
            <div class="line"></div>
        </div>
    </label>
    <label>
        <p class="label-txt"></p>
        <input type="text" placeholder="ENTER YOUR PASSWORD" class="input" name="psw">
        <p class=" text-danger"><?php ; if (isset($_SESSION['password'])){ echo $_SESSION['password']; session_destroy();} ?></p>
        <div class="line-box">
            <div class="line"></div>
        </div>
    </label>
    <button >submit</button>
</form>
</body>
<script>
    $(document).ready(function(){

        $('.input').focus(function(){
            $(this).parent().find(".label-txt").addClass('label-active');
        });

        $(".input").focusout(function(){
            if ($(this).val() == '') {
                $(this).parent().find(".label-txt").removeClass('label-active');
            };
        });

    });
</script>
</html>
