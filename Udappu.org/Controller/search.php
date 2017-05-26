<?php
require_once '../Model/dbConn.php';
$searchResult=array();
if (isset($_GET['search'])) {
    $search=htmlentities($_GET['search']);
    $searchResult=searchUser($search);
}
