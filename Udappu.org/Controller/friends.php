<?php
require_once('../Model/dbConn.php');
$loginCheck=checkLogin();
if ($loginCheck!='Member') {
    header('location:index.php');
}

$member=getMemberByUserID($_SESSION['user']->userID);
$friends=getAllFriendsList($member->memberID);
$allFriendRequestsReceived=getAllFriendRequestsReceived($member->memberID);
$allFriendRequestsSend=getAllFriendRequestsSend($member->memberID);

if (isset($_POST['unfriend'])) {
    $fromID=$member->memberID;
    $toID=$_POST['unfriend'];
    $result=deleteFromFriendList($fromID, $toID);
    if ($result) {
        echo "deleted";
    } else {
        echo "failed";
    }
}

if (isset($_POST['cancelFriendRequest'])) {
    $fromID=$member->memberID;
    $toID=$_POST['cancelFriendRequest'];
    $result=rejectFriendRequest($fromID, $toID);
    if ($result) {
        echo "deleted";
    } else {
        echo "failed";
    }
}
