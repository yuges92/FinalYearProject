<?php
require_once('../Model/dbConn.php');
if (isset($_GET['image'])) {
    $id=$_GET['image'];
    $image=getImageByID($id);
}
