<?php require_once('../Model/dbConn.php');

$loginCheck=checkLogin();
if ($loginCheck!='Admin') {
    header('location:index.php');
}
if (!isset($_SESSION['feedback'])) {
    $_SESSION['feedback']='';
}

if (isset($_POST['emailCheck'])) {
    $email= htmlentities($_POST['emailCheck']);
    $result=checkUsername($email);
    print_r($result);
}

if (isset($_POST['addAdmin'])) {
    //parse_str($_POST['addAdmin'], $formdata);
    if (empty($_POST['firstname'])||
  empty($_POST['surname'])||
  empty($_POST['username'])||
  empty($_POST['dob'])||
  empty($_POST['email'])) {
        $_SESSION['feedback']= "Please fill the required fields";
        header("location:../View/addAdmin.php");
    } else {
        $firstname=ucwords($_POST['firstname']);
        $surname=ucwords($_POST['surname']);
        $username=$_POST['username'];
        $password='password';
        $dob=$_POST['dob'];
        $email=($_POST['email']);
        $role='Admin';

        $user= new Admin();
        $user->firstname=$firstname;
        $user->surname=$surname;
        $user->username=$username;
        $user->password=$password;
        $user->dob=$dob;
        $user->email=$email;
        $user->role=$role;
        $addAdmin=addAdmin($user);
        print_r($user);
        if ($addAdmin) {
            $_SESSION['feedback']= "success";
            header("location:../View/manageUsers.php");
        } else {
            $_SESSION['feedback']= "failed";
            header("location:../View/manageUsers.php");
        }
    }
}
