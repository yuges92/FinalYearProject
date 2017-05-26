<?php
require_once('../Model/dbConn.php');
$loginCheck=checkLogin();
if ($loginCheck!='Admin') {
    header('location:index.php');
}

if (!isset($feedback)) {
    $feedback='';
}

if (isset($_GET['adminID'])) {
    $editAdmin=getAdminByAdminID($_GET['adminID']);
    $editUsername=getUserBYUserID($editAdmin->userID)->username;
    $feedback=$_GET['feedback'];
} elseif (isset($_POST['updateAdmin'])) {
    $firstname=($_POST['firstname']);
    $surname=($_POST['surname']);
    $dob=$_POST['dob'];
    $email=($_POST['email']);
    $adminID=($_POST['adminID']);
    $user= new Admin();
    $user->firstname=$firstname;
    $user->surname=$surname;
    $user->dob=$dob;
    $user->email=$email;
    $user->adminID=$adminID;
    $updateAdmin=updateAdmin($user);
    if ($updateAdmin) {
        header("location:../View/editAdmin.php?adminID=$adminID&feedback=success");
    } else {
        header("location:../View/editAdmin.php?adminID=$adminID&feedback=failed");
    }
} else {
    header('location:index.php');
}
