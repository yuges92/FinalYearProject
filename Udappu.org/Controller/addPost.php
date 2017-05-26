<?php
require_once('../Model/dbConn.php');
$loginCheck=checkLogin();
if ($loginCheck!='Admin') {
    header('location:index.php');
}
$imageExtensions = array('jpeg', 'jpg', 'png', 'gif');
$folder = '../contents/images/';

if (isset($_POST['addPostBtn'])) {
    $title=$_POST['title'];
    $description=$_POST['description'];
    $admin=getAdminByUserID($_SESSION['user']->userID);
    $adminID=$admin->adminID;
    $post= new AdminPost();
    $post->title=$title;
    $post->description=$description;
    $post->adminID=$adminID;
    $postID=addNewAdminPost($post);


    if ($postID>0) {
        if ($_FILES['postImages']['error']>0) {
            header('location: ../View/manageContents.php');
        }
        foreach ($_FILES['postImages']['name'] as $image=>$name) {
            $pic = rand(1000, 100000).$_FILES['postImages']['name'][$image];
            $pic_loc = $_FILES['postImages']['tmp_name'][$image];
            $folder="../contents/images/";

            $ext=pathinfo($pic, PATHINFO_EXTENSION);

            if (in_array($ext, $imageExtensions)) {
                if (move_uploaded_file($pic_loc, $folder.$pic)) {
                    $image= new Image();
                    $image->file_Name=$pic;
                    $image->folder_Name=$folder;
                    $imageID=addImage($image);

                    if ($imageID>0) {
                        $result=  adminPostImage($postID, $imageID);
                        if ($result) {
                            echo "Successfuly Uploaded";
                            header('location: ../View/manageContents.php');
                        } else {
                            echo "Failed to Upload";
                        }
                    }
                } else {
                    echo "Failed to Upload";
                }
            }
        }
    }
}
