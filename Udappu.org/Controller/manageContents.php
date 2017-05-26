<?php
require_once('../Model/dbConn.php');
$loginCheck=checkLogin();
if ($loginCheck!='Admin') {
    header('location:index.php');
}

$events=getAllEvents();
$posts=getAllPosts();
