<?php
require_once '../Model/dbConn.php';

$loginCheck=checkLogin();
if (!$loginCheck==false) {
    header('location:index.php');
}



echo "$password";
if (!isset($_SESSION['user'])) {
    if (isset($_POST['login'])) {
        $username=htmlentities($_POST['username']);
        $password=htmlentities($_POST['password']);
        $user=login($username, $password);
        if ($user) {
            $_SESSION['user']=$user;
            if ($user->role=='Admin') {
                echo 'Admin';
            } else {
                echo "Member";
            }
        } else {
            echo "false";
        }
    }
}
