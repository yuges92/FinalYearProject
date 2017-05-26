<?php require_once('../Model/dbConn.php');
$loginCheck=checkLogin();
if ($loginCheck!='Member') {
    header('location:index.php');
}

$member=getMemberByUserID($_SESSION['user']->userID);

if (isset($_POST['updateProfile'])) {
    parse_str($_POST['updateProfile'], $formdata);

    $firstname=ucwords($formdata['firstname']);
    $surname=ucwords($formdata['surname']);
    $dob=($formdata['dob']);
    $gender=($formdata['gender']);
    $email=($formdata['email']);
    $role='Member';

    $user= new Member();
    $user->firstname=$firstname;
    $user->surname=$surname;
    $user->dob=$dob;
    $user->gender=$gender;
    $user->email=$email;
    $user->userID=$_SESSION['user']->userID;
    $updateMember=updateMember($user);

    if ($updateMember) {
        echo "success";
    } else {
        echo "failed";
    }
}
