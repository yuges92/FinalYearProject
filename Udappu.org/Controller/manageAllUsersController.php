<?php
require_once '../Model/dbConn.php';
// $loginCheck=checkLogin();
// if ($loginCheck==false) {
//     header('location:index.php');
// }

if (isset($_POST['updatePassword'])) {
    parse_str($_POST['updatePassword'], $data);
    
    if (empty($data['oldPassword'])||
    empty($data['newPassword'])) {
        echo "Empty Field";
    } else {
        $oldPassword=htmlentities($data['oldPassword']);
        $newPassword=htmlentities($data['newPassword']);
        $confirmPassword=htmlentities($data['confirmPassword']);
        if (password_verify($oldPassword, $_SESSION['user']->password)) {
            if ($newPassword==$confirmPassword) {
                $username=$_SESSION['user']->username;
                $result=updatePassword($username, $newPassword);

                if ($result) {
                    echo "password changed";
                } else {
                    echo "password not changed";
                }
            } else {
                echo "new password do not match";
            }
        } else {
            echo "Old password do not match";
        }
    }
}
