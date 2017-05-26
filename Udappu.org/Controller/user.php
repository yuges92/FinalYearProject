<?php
require_once('../Model/dbConn.php');
$loginCheck=checkLogin();
if ($loginCheck==false) {
    header('location:index.php');
}


if (isset($_GET['userID'])) {
    $otherUserPost=array();
    $member=getMemberByUserID($_SESSION['user']->userID);
    $friends=getAllFriendsList($_GET['userID']);

    foreach ($friends as $list) {
        if ($list->friend_MemberID==$member->memberID) {
            $otherUserPost=getFriendsPosts($_GET['userID']);
        }
    }
    $otherUser=getMemberByMemberID($_GET['userID']);
    $gender=$otherUser->gender;
    
    $CheckFriendRequest=checkFriendRequestSend($member->memberID, $otherUser->memberID);

    if ($CheckFriendRequest->decision=='Pending') {
        $btn='Requested';
    } elseif ($CheckFriendRequest->decision=='accepted') {
        $btn='Friends';
    } else {
        $CheckFriendRequest=checkFriendRequestReceived($member->memberID, $otherUser->memberID);
        if ($CheckFriendRequest->decision=='Pending') {
            $btn='friend request received';
        } elseif ($CheckFriendRequest->decision=='accepted') {
            $btn='Friends';
        } else {
            $btn='Add Friend';
        }
    }
} else {
    header('location: ../index.php');
}
