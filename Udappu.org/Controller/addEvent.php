<?php
require_once('../Model/dbConn.php');

$loginCheck=checkLogin();
if ($loginCheck!='Admin') {
    header('location:index.php');
}

if (isset($_POST['addEventBtn'])) {
    $adminID=1;
    $title=$_POST['title'];
    $description=$_POST['description'];
    $start_Date=$_POST['start_Date'];
    $end_Date=$_POST['end_Date'];

    $udappuEvent = new UdappuEvent();
    $udappuEvent->adminID=$adminID;
    $udappuEvent->title=$title;
    $udappuEvent->description=$description;
    $udappuEvent->start_Date=$start_Date;
    $udappuEvent->end_Date=$end_Date;

    $result=  addEvent($udappuEvent);
    if ($result) {
        echo "Successfuly Added";
        header('location: ../View/manageContents.php');
    } else {
        echo "Failed to Add";
    }
}
