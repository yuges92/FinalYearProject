<?php
require_once('../Model/dbConn.php');
$loginCheck=checkLogin();
if ($loginCheck!='Member' && $loginCheck!='Admin') {
    header('location:index.php');
}

if (isset($_POST['deletePost'])) {
    $postID=$_POST['deletePost'];
    $allPostAndImages=getMemberPostANDImageBYID($postID);

    if ($allPostAndImages) {
        foreach ($allPostAndImages as $post) {
            $imageID=$post->imageID;
            $image=getImageByID($imageID);

            if (unlink($image->folder_Name.$image->file_Name)) {
                deleteImage($imageID);
            } else {
                die();
            }
        }
    }

    if (deleteMemberPost($postID)) {
        echo "deleted";
    } else {
        echo "failed to delete";
    }
}


if (isset($_POST['deleteAdminPost'])) {
    $postID=$_POST['deleteAdminPost'];
    $allPostAndImages=getPostANDImageBYID($postID);
    if ($allPostAndImages) {
        foreach ($allPostAndImages as $post) {
            $imageID=$post->imageID;
            $image=getImageByID($imageID);

            if (unlink($image->folder_Name.$image->file_Name)) {
                deleteImage($imageID);
            } else {
                die();
            }
        }
    }

    if (deleteAdminPost($postID)) {
        echo "deleted";
    } else {
        echo "failed to delete";
    }
}

if (isset($_POST['deleteEvent'])) {
    $eventID=$_POST['deleteEvent'];

    if (deleteEvent($eventID)) {
        echo "deleted";
    } else {
        echo "failed to delete";
    }
}

if (isset($_POST['deleteUser'])) {
    if (checkLogin()=='Admin') {
        $userID=$_POST['deleteUser'];

        if ($userID==1 || $userID==$_SESSION['user']->userID) {
            echo "you cannot do that";
        } else {
            if (deleteUser($userID)) {
                echo "deleted";
            } else {
                echo "failed to delete";
            }
        }
    }
}
