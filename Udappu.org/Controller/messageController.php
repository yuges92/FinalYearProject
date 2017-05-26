<?php require_once('../Model/dbConn.php');
$loginCheck=checkLogin();
if ($loginCheck!='Member') {
    header('location:index.php');
}


$member=getMemberByUserID($_SESSION['user']->userID);
$allMessageNotification=getAllMessageNotificationByMemberID($member->memberID);
$mnn=sizeof($allMessageNotification);
$allMessagers=getMessageSender($member->memberID);
$messageID='';

if (isset($_POST['sendMessage'])) {
    if (!empty($_POST['sendMessage'])) {
        $messageContent= $_POST['sendMessage'];
        $friendID= $_POST['friendID'];
        $memberID=$member->memberID;

        $message= new Message();
        $message->message=$messageContent;
        $message->to_MemberID=$friendID;
        $message->from_MemberID=$memberID;

        if (sendMessage($message)) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}

if (isset($_POST['updateMessageNotification'])) {
    $messageID=$_POST['updateMessageNotification'];
    if (updateMessageNotification($messageID, $member->memberID)) {
        echo "success";
    } else {
        echo "failed";
    }
}
