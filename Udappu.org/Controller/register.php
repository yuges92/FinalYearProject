<?php
require_once('../Model/dbConn.php');
$loginCheck=checkLogin();
if ($loginCheck!=false && $loginCheck!='Admin') {
    header('location:index.php');
}


if (isset($_POST['checkUsername'])) {
    $username= $_POST['checkUsername'];
    $result=checkUsername($username);
    if ($result) {
        echo "exist";
    } else {
        echo "available";
    }
}

if (isset($_POST['emailCheck'])) {
    $email= htmlentities($_POST['emailCheck']);
    $result=checkEmail($email);
    if ($result) {
        echo "exist";
    } else {
        echo "available";
    }
}

if (isset($_POST['register'])) {
    parse_str($_POST['register'], $formdata);
    if (empty($formdata['firstname'])||
  empty($formdata['surname'])||
  empty($formdata['username'])||
  empty($formdata['password'])||
  empty($formdata['confirmPassword'])||
  empty($formdata['dob'])||
  empty($formdata['gender'])||
  empty($formdata['email'])) {
        echo "Please fill the required fields";
    } else {
        $firstname=ucwords($formdata['firstname']);
        $surname=ucwords($formdata['surname']);
        $username=$formdata['username'];
        $password=$formdata['password'];
        $dob=($formdata['dob']);
        $gender=($formdata['gender']);
        $email=($formdata['email']);
        $role='Member';

        $user= new Member();
        $user->firstname=$firstname;
        $user->surname=$surname;
        $user->username=$username;
        $user->password=$password;
        $user->dob=$dob;
        $user->gender=$gender;
        $user->email=$email;
        $user->role=$role;
        $addMember=register($user);

        if ($addMember) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
