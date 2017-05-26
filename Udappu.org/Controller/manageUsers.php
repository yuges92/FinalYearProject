<?php
require_once('../Model/dbConn.php');
$loginCheck=checkLogin();
if ($loginCheck!='Admin') {
    header('location:index.php');
}

$admins=getAllAdmins();
$members=getAllMembers();

if (isset($_GET['userID'])) {
}
