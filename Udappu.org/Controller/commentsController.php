<?php
require_once('../Model/dbConn.php');
$loginCheck=checkLogin();
if ($loginCheck!='Member') {
    header('location:index.php');
}

$imageExtensions = array('jpeg', 'jpg', 'png', 'gif');
$folder = '../contents/images/';

if (isset($_POST['postComment'])) {
    $member=getMemberByUserID($_SESSION['user']->userID);
    $comment=$_POST['postComment'];
    $postID=$_POST['postID'];
    $memberID=$member->memberID;

    $com= new UserComment();
    $com->comment=$comment;
    $com->postID=$postID;
    $com->memberID=$memberID;

    $addComment=postComment($com);
    if ($addComment) {
        echo "success";
    } else {
        echo "failed";
    }
}
//use ajax to get comments as jason objects
if (isset($_POST['getComments'])) {
    $postID=$_POST['getComments'];
    $comments=getCommentsByPostID($postID);
}
