<?php
require_once("UserUdappu.php");
require_once("Admin.php");
require_once("Member.php");
require_once("AdminPost.php");
require_once("AdminPostAndImage.php");
require_once("Event.php");
require_once("FriendList.php");
require_once("FriendRequest.php");
require_once("Image.php");
require_once("MemberPost.php");
require_once("MemberPostImage.php");
require_once("Message.php");
require_once("UserComment.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
