<?php
require_once('../Model/dbConn.php');
$loginCheck=checkLogin();
if ($loginCheck!='Member') {
    header('location:index.php');
}
$member=getMemberByUserID($_SESSION['user']->userID);
$memberPosts=getAllMemberPostsByMemberID($member->memberID);
$friends=getAllFriendsList($member->memberID);
