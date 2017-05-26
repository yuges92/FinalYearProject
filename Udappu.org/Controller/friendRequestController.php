<?php
require_once('../Model/dbConn.php');

if (isset($_SESSION['user'])&& $_SESSION['user']->role=='Member') {
    $member=getMemberByUserID($_SESSION['user']->userID);
    if (isset($_POST['sendFriendRequest'])) {
        $to_MemberID=$_POST['sendFriendRequest'];
        $from_MemberID=$member->memberID;
        if ($to_MemberID==$from_MemberID) {
            echo "logged in user";
            die();
        }
        $result=sendFriendRequest($from_MemberID, $to_MemberID);
        if ($result) {
            echo "requested";
        } else {
            echo "failed";
        }
    }
    if (isset($_POST['confirmFriendRequest'])) {
        $to_MemberID=$_POST['confirmFriendRequest'];
        $from_MemberID=$member->memberID;
        if ($to_MemberID==$from_MemberID) {
            echo "logged in user";
            die();
        }
        $confirmFriendRequest=confirmFriendRequest($from_MemberID, $to_MemberID);
        if ($confirmFriendRequest) {
            if (addToFriendList($from_MemberID, $to_MemberID) && addToFriendList($to_MemberID, $from_MemberID)) {
                echo "confirmed";
            } else {
                echo "failed";
            }
        } else {
            echo "failed";
        }
    }

    if (isset($_POST['rejectFriendRequest'])) {
        $to_MemberID=$_POST['rejectFriendRequest'];
        $from_MemberID=$member->memberID;
        //used the opposite so that when clicked on reject it will delete the row from the database
        $rejectFriendRequest=rejectFriendRequest($to_MemberID, $from_MemberID);
        if ($rejectFriendRequest) {
            echo "rejected";
        } else {
            echo "failed";
        }
    }
}
