<?php require_once '../Model/dbConn.php';

if (isset($_POST['resetPassword'])) {
    $email=$_POST['email'];
    $emailMember=checkEmail($email);

    if ($emailMember) {
        $to = $email;
        $subject = "Password Reset";
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr(str_shuffle($chars), 0, 8);
        $txt = "Your new password is: $password";
        $headers = "From: info@udappu.org.uk";

        if (mail($to, $subject, $txt, $headers)) {
            if (updatePassword(getUserBYUserID($emailMember->userID)->username, $password)) {
                echo "<script>
                alert('A new password has been sent to your email');
                window.location.href='../View/login.php';
                </script>";
            }
        }
    } else {
        echo "<script>
      alert('The email address do not match with our records');
      window.location.href='../View/login.php';
      </script>";
    }
} else {
    header("location:../View/index.php");
}
