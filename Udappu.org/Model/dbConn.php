<?php
require_once('startup.php');
error_reporting(~E_NOTICE);
$host="localhost";
$dbname="FYP";
$dbUsername="root";
$dbPassword="";

try {
    $pdo= new PDO("mysql:host=$host;dbname=$dbname", $dbUsername, $dbPassword);
} catch (Exception $e) {
    echo "Connection failed";
}

function checkLogin()
{
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']->role=='Member') {
            return 'Member';
        } elseif ($_SESSION['user']->role=='Admin') {
            return 'Admin';
        }
    } else {
        return false;
    }
}

function getAllUsers()
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `User_Udappu`');
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_CLASS, 'UserUdappu');
    return $result;
}

function getUserBYUserID($userID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `User_Udappu` WHERE userID=:userID');
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'UserUdappu');
    $result=$stmt->fetch();
    return $result;
}

function register($member)
{
    global $pdo;
    $addUser=addUser($member);

    if ($addUser) {
        $user=getUserByUsername($member->username);
        $stmt=$pdo->prepare('INSERT INTO `Udappu_Member`(`firstname`, `surname`, `dob`, `email`, `userID`, `gender`)
        VALUES (:firstname,:surname,:dob,:email,:userID,:gender)');
        $stmt->bindParam(':firstname', $member->firstname);
        $stmt->bindParam(':surname', $member->surname);
        $stmt->bindParam(':dob', $member->dob);
        $stmt->bindParam(':email', $member->email);
        $stmt->bindParam(':userID', $user->userID);
        $stmt->bindParam(':gender', $member->gender);
        $result=$stmt->execute();
        //check if added and if not create a delete user method to remove the user from the user table
        return $result;
    }
}

function checkUsername($username)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT username FROM `User_Udappu` WHERE username=:username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $count=$stmt->rowCount();
    return $count;
}

function checkEmail($email)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Udappu_Member` WHERE email=:email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Member');
    $result=$stmt->fetch();
    return $result;
}


function addUser($user)
{
    global $pdo;
    $stmt=$pdo->prepare('INSERT INTO `User_Udappu`(`role`, `username`, `password`)
    VALUES (:role,:username,:password)');
    $password=password_hash($user->password, PASSWORD_DEFAULT);
    $stmt->bindParam(':role', $user->role);
    $stmt->bindParam(':username', $user->username);
    $stmt->bindParam(':password', $password);
    $result= $stmt->execute();
    return $result;
}

function addAdmin($admin)
{
    global $pdo;
    $addUser=addUser($admin);

    if ($addUser) {
        $user=getUserByUsername($admin->username);
        $stmt=$pdo->prepare('INSERT INTO `Admin`(`firstname`, `surname`, `dob`, `email`, `userID`)
        VALUES (:firstname,:surname,:dob,:email,:userID)');
        $stmt->bindParam(':firstname', $admin->firstname);
        $stmt->bindParam(':surname', $admin->surname);
        $stmt->bindParam(':dob', $admin->dob);
        $stmt->bindParam(':email', $admin->email);
        $stmt->bindParam(':userID', $user->userID);
        $result=$stmt->execute();
        return $result;
    }
}

function getUserByUsername($username)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `User_Udappu` WHERE username=:username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'UserUdappu');
    $result=$stmt->fetch();
    return $result;
}

function addNewAdminPost($post)
{
    global $pdo;
    $stmt=$pdo->prepare('INSERT INTO `Admin_Post`( `title`, `description`, `adminID`)
                          VALUES (:title,:description,:adminID)');
    $stmt->bindParam(':title', $post->title);
    $stmt->bindParam(':description', $post->description);
    $stmt->bindParam(':adminID', $post->adminID);
    $result= $stmt->execute();
    if ($result) {
        $last_id = $pdo->lastInsertId();
        return $last_id;
    } else {
        return $result;
    }
}

function login($username, $password)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `User_Udappu` WHERE username=:username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'UserUdappu');
    $user=$stmt->fetch();
    if (!empty($user)) {
        if (password_verify($password, $user->password)) {
            return $user;
        } else {
            return false;
        }
    }
}

function addImage($image)
{
    global $pdo;
    $stmt=$pdo->prepare('INSERT INTO `image`( `file_Name`, `folder_Name`)
                          VALUES (:file_Name,:folder_Name)');
    $stmt->bindParam(':file_Name', $image->file_Name);
    $stmt->bindParam(':folder_Name', $image->folder_Name);
    $result= $stmt->execute();
    if ($result) {
        $last_id = $pdo->lastInsertId();
        return $last_id;
    } else {
        return $result;
    }
}

function adminPostImage($postID, $imageID)
{
    global $pdo;
    $stmt=$pdo->prepare('INSERT INTO `Admin_Post_Image`(`postID`, `imageID`)
                          VALUES (:postID,:imageID)');
    $stmt->bindParam(':postID', $postID);
    $stmt->bindParam(':imageID', $imageID);
    $result= $stmt->execute();
    return $result;
}
function addEvent($event)
{
    global $pdo;
    $stmt=$pdo->prepare('INSERT INTO `Udappu_Event`( `adminID`, `title`, `description`, `start_Date`, `end_Date`)
                        VALUES (:adminID,:title,:description,:start_Date,:end_Date)');
    $stmt->bindParam(':adminID', $event->adminID);
    $stmt->bindParam(':title', $event->title);
    $stmt->bindParam(':description', $event->description);
    $stmt->bindParam(':start_Date', $event->start_Date);
    $stmt->bindParam(':end_Date', $event->end_Date);
    $result= $stmt->execute();
    return $result;
}

function getAllPosts()
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Admin_Post` ORDER BY `date_Posted` DESC');
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_CLASS, 'AdminPost');
    return $result;
}

function getImageByID($imageID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Image` WHERE imageID=:imageID');
    $stmt->bindParam(':imageID', $imageID);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Image');
    $result=$stmt->fetch();
    return $result;
}
function getPostANDImageBYID($postID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Admin_Post_Image` WHERE postID=:postID');
    $stmt->bindParam(':postID', $postID);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_CLASS, 'AdminPostImage');
    return $result;
}



function getMemberPostANDImageBYID($postID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Member_Post_Image` WHERE postID=:postID');
    $stmt->bindParam(':postID', $postID);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_CLASS, 'MemberPostImage');
    return $result;
}

function getFriendsPosts($friendID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Member_Post` WHERE memberID=:memberID AND privacy="public" ORDER BY `date_Posted` DESC');
    $stmt->bindParam(':memberID', $friendID);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_CLASS, 'MemberPost');
    return $result;
}

function getAllMemberPostsByMemberID($memberID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Member_Post` WHERE memberID=:memberID ORDER BY `date_Posted` DESC');
    $stmt->bindParam(':memberID', $memberID);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_CLASS, 'MemberPost');
    return $result;
}




function getAllEvents()
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Udappu_Event`ORDER BY `date_Posted` DESC ');
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_CLASS, 'UdappuEvent');
    return $result;
}

function searchUser($search)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT *
                            FROM `Udappu_Member`
                            WHERE firstname
                            LIKE "%":search "%"
                            OR surname LIKE "%":search "%"');
    $stmt->bindParam(':search', $search);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_CLASS, 'Member');
    return $result;
}

function sendFriendRequest($fromID, $toID)
{
    global $pdo;
    $stmt=$pdo->prepare('INSERT INTO `Friend_Request` (`from_MemberID`, `to_MemberID`)
    VALUES (:from_MemberID,:to_MemberID)');
    $stmt->bindParam(':from_MemberID', $fromID);
    $stmt->bindParam(':to_MemberID', $toID);
    $result= $stmt->execute();
    return $result;
}


function getAllFriendRequestsReceived($memberID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Friend_Request` WHERE `to_MemberID`=:memberID AND `decision`!="accepted"');
    $stmt->bindParam(':memberID', $memberID);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_CLASS, 'FriendRequest');
    return $result;
}

function getAllFriendRequestsSend($memberID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Friend_Request` WHERE `from_MemberID`=:memberID AND `decision`!="accepted"');
    $stmt->bindParam(':memberID', $memberID);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_CLASS, 'FriendRequest');
    return $result;
}

function getAFriendRequest($memberID, $toMemberID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Friend_Request`
                        WHERE (memberID=:memberID AND to_MemberID=:toMemberID)');
    $stmt->bindParam(':memberID', $memberID);
    $stmt->bindParam(':toMemberID', $toMemberID);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'FriendRequest');
    $result=$stmt->fetch();
    return $result;
}

function addToFriendList($memberID, $friendID)
{
    global $pdo;
    $stmt=$pdo->prepare('INSERT INTO `Friend_List`(`memberID`, `friend_MemberID`)
                        VALUES (:memberID,:friendID)');
    $stmt->bindParam(':memberID', $memberID);
    $stmt->bindParam(':friendID', $friendID);
    $result= $stmt->execute();
    return $result;
}

function getAllFriendsList($memberID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Friend_List`
                        WHERE memberID=:memberID ');
    $stmt->bindParam(':memberID', $memberID);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_CLASS, 'FriendList');
    return $result;
}

function checkIfFriends($memberID, $friendID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Friend_List`
                        WHERE (memberID=:memberID AND friend_MemberID=:friendID) OR (memberID=:friendID AND friend_MemberID=:memberID)');
    $stmt->bindParam(':memberID', $memberID);
    $stmt->bindParam(':friendID', $friendID);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'FriendList');
    $result=$stmt->fetch();
    return $result;
}

function checkFriendRequestSend($memberID, $friendID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Friend_Request`
                        WHERE (from_MemberID=:memberID AND to_MemberID=:friendID)');
    $stmt->bindParam(':memberID', $memberID);
    $stmt->bindParam(':friendID', $friendID);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'FriendRequest');
    $result=$stmt->fetch();
    return $result;
}

function checkFriendRequestReceived($memberID, $friendID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Friend_Request`
                        WHERE (from_MemberID=:friendID AND to_MemberID=:memberID)');
    $stmt->bindParam(':memberID', $memberID);
    $stmt->bindParam(':friendID', $friendID);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'FriendRequest');
    $result=$stmt->fetch();
    return $result;
}

function confirmFriendRequest($fromID, $toID)
{
    global $pdo;
    $stmt=$pdo->prepare(
    'INSERT INTO `Friend_Request` (`from_MemberID`, `to_MemberID`,`decision`)
    VALUES (:from_MemberID,:to_MemberID,"accepted");
    UPDATE `Friend_Request` SET `decision`="accepted"
    WHERE from_MemberID=:to_MemberID and to_MemberID=:from_MemberID
    ');
    $stmt->bindParam(':from_MemberID', $fromID);
    $stmt->bindParam(':to_MemberID', $toID);
    $result= $stmt->execute();
    return $result;
}

function rejectFriendRequest($fromID, $toID)
{
    global $pdo;
    $stmt=$pdo->prepare(
    'DELETE FROM `Friend_Request` WHERE `from_MemberID`=:from_MemberID AND `to_MemberID`=:to_MemberID');
    $stmt->bindParam(':from_MemberID', $fromID);
    $stmt->bindParam(':to_MemberID', $toID);
    $result= $stmt->execute();
    return $result;
}

function deleteFromFriendList($fromID, $toID)
{
    global $pdo;
    $stmt=$pdo->prepare(
    'DELETE FROM `Friend_List` WHERE `memberID`=:memberID AND `friend_MemberID`=:friendID;
     DELETE FROM `Friend_List` WHERE `memberID`=:friendID AND `friend_MemberID`=:memberID;
     DELETE FROM `Friend_Request` WHERE `from_MemberID`=:memberID AND `to_MemberID`=:friendID;
     DELETE FROM `Friend_Request` WHERE `from_MemberID`=:friendID AND `to_MemberID`=:memberID;');
    $stmt->bindParam(':memberID', $fromID);
    $stmt->bindParam(':friendID', $toID);
    $result= $stmt->execute();
    return $result;
}

function deleteFromFriendRequest($fromID, $toID)
{
    global $pdo;
    $stmt=$pdo->prepare(
    'DELETE FROM `Friend_List` WHERE `memberID`=:from_MemberID AND `friend_MemberID`=:to_MemberID');
    $stmt->bindParam(':from_MemberID', $fromID);
    $stmt->bindParam(':to_MemberID', $toID);
    $result= $stmt->execute();
    return $result;
}



function addNewUserPost($post)
{
    global $pdo;
    $stmt=$pdo->prepare('INSERT INTO `Member_Post`( `title`, `description`, `memberID`, `privacy`)
                        VALUES (:title,:description,:memberID,:privacy)');
    $stmt->bindParam(':title', $post->title);
    $stmt->bindParam(':description', $post->description);
    $stmt->bindParam(':memberID', $post->memberID);
    $stmt->bindParam(':privacy', $post->privacy);
    $result= $stmt->execute();
    if ($result) {
        $last_id = $pdo->lastInsertId();
        return $last_id;
    } else {
        return $result;
    }
}

function memberPostAndImage($postID, $imageID)
{
    global $pdo;
    $stmt=$pdo->prepare('INSERT INTO `Member_Post_Image`(`postID`, `imageID`)
                          VALUES (:postID,:imageID)');
    $stmt->bindParam(':postID', $postID);
    $stmt->bindParam(':imageID', $imageID);
    $result= $stmt->execute();
    return $result;
}


function getAllMembers()
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Udappu_Member`');
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_CLASS, 'Member');
    return $result;
}
function getAllAdmins()
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Admin`');
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_CLASS, 'Admin');
    return $result;
}

function getMemberByUserID($userID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Udappu_Member` WHERE userID=:userID');
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Member');
    $result=$stmt->fetch();
    return $result;
}

function getMemberByMemberID($memberID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Udappu_Member` WHERE `memberID`=:memberID');
    $stmt->bindParam(':memberID', $memberID);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Member');
    $result=$stmt->fetch();
    return $result;
}

function getAdminByAdminID($adminID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Admin` WHERE `adminID`=:adminID');
    $stmt->bindParam(':adminID', $adminID);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Admin');
    $result=$stmt->fetch();
    return $result;
}

function getAdminByUserID($userID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Admin` WHERE userID=:userID');
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Admin');
    $result=$stmt->fetch();
    return $result;
}


function updateMember($member)
{
    global $pdo;
    $stmt=$pdo->prepare('UPDATE `Udappu_Member`
        SET `firstname`=:firstname,`surname`=:surname,`dob`=:dob,`email`=:email,`gender`=:gender
        WHERE `userID`=:userID');
    $stmt->bindParam(':firstname', $member->firstname);
    $stmt->bindParam(':surname', $member->surname);
    $stmt->bindParam(':dob', $member->dob);
    $stmt->bindParam(':email', $member->email);
    $stmt->bindParam(':userID', $member->userID);
    $stmt->bindParam(':gender', $member->gender);

    $result=$stmt->execute();
    return $result;
}

function updateAdmin($admin)
{
    global $pdo;
    $stmt=$pdo->prepare('UPDATE `Admin`
        SET `firstname`=:firstname,`surname`=:surname,`dob`=:dob,`email`=:email
        WHERE `adminID`=:adminID');
    $stmt->bindParam(':firstname', $admin->firstname);
    $stmt->bindParam(':surname', $admin->surname);
    $stmt->bindParam(':dob', $admin->dob);
    $stmt->bindParam(':email', $admin->email);
    $stmt->bindParam(':adminID', $admin->adminID);
    $result=$stmt->execute();
    return $result;
}

function deleteAdminPost($postID)
{
    global $pdo;
    $stmt=$pdo->prepare('DELETE FROM `Admin_Post` WHERE `postID`=:postID');
    $stmt->bindParam(':postID', $postID);
    $result=$stmt->execute();
    return $result;
}

function deleteEvent($eventID)
{
    global $pdo;
    $stmt=$pdo->prepare('DELETE FROM `Udappu_Event` WHERE `eventID`=:eventID');
    $stmt->bindParam(':eventID', $eventID);
    $result=$stmt->execute();
    return $result;
}

function deleteMemberPost($postID)
{
    global $pdo;
    $stmt=$pdo->prepare('DELETE FROM `Member_Post` WHERE `postID`=:postID');
    $stmt->bindParam(':postID', $postID);
    $result=$stmt->execute();
    return $result;
}

function deleteImage($imageID)
{
    global $pdo;
    $stmt=$pdo->prepare('DELETE FROM `Image` WHERE `imageID`=:imageID');
    $stmt->bindParam(':imageID', $imageID);
    $result=$stmt->execute();
    return $result;
}

function sendMessage($message)
{
    global $pdo;
    $stmt=$pdo->prepare('INSERT INTO `Message`(`from_MemberID`, `to_MemberID`, `message`)
                        VALUES (:from_MemberID,:to_MemberID,:message)');
    $stmt->bindParam(':from_MemberID', $message->from_MemberID);
    $stmt->bindParam(':to_MemberID', $message->to_MemberID);
    $stmt->bindParam(':message', $message->message);
    $result= $stmt->execute();
    return $result;
}

function getAllMessageByMemberIDs($memberID, $toMemberID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Message` WHERE `from_MemberID`=:memberID AND to_MemberID=:toMemberID order BY `messageID` DESC limit 1  ');
    $stmt->bindParam(':memberID', $memberID);
    $stmt->bindParam(':toMemberID', $toMemberID);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_CLASS, 'Message');
    return $result;
}

function getAllMessageNotificationByMemberID($memberID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT p1.*
FROM Message p1
INNER JOIN
(
    SELECT max(messageID) messageID, from_MemberID
    FROM Message
    WHERE to_MemberID=:memberID
    GROUP BY from_MemberID) table2
    ON  p1.`messageID` = table2.`messageID`
    WHERE p1.seen="no"
    AND p1.to_MemberID=:memberID
    order by p1.messageID desc');
    $stmt->bindParam(':memberID', $memberID);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_CLASS, 'Message');
    return $result;
}



function getAllMessagesByfromMemberIDANDToMemberID($memberID, $toMemberID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `Message` WHERE (from_MemberID= :memberID AND `to_MemberID`=:toMemberID) or (from_MemberID=:toMemberID AND `to_MemberID`=:memberID) ');
    $stmt->bindParam(':memberID', $memberID);
    $stmt->bindParam(':toMemberID', $toMemberID);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_CLASS, 'Message');
    return $result;
}


function getMessageSender($memberID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT from_MemberID from Message where to_MemberID = :memberID
    union select to_MemberID from Message where from_MemberID = :memberID');
    $stmt->bindParam(':memberID', $memberID);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function deleteMessage($messageID)
{
    global $pdo;
    $stmt=$pdo->prepare('DELETE FROM `Message` WHERE messageID:messageID');
    $stmt->bindParam(':messageID', $messageID);
    $result=$stmt->execute();
    return $result;
}

function updateMessageNotification($messageID, $memberID)
{
    global $pdo;
    $stmt=$pdo->prepare('UPDATE `Message` SET `seen`="yes" WHERE `messageID`=:messageID AND to_MemberID = :memberID');
    $stmt->bindParam(':messageID', $messageID);
    $stmt->bindParam(':memberID', $memberID);
    $result=$stmt->execute();
    return $result;
}


function postComment($comment)
{
    global $pdo;
    $stmt=$pdo->prepare('INSERT INTO `User_Comment`(`postID`, `memberID`, `comment` )
                         VALUES (:postID,:memberID,:comment)');
    $stmt->bindParam(':postID', $comment->postID);
    $stmt->bindParam(':memberID', $comment->memberID);
    $stmt->bindParam(':comment', $comment->comment);
    $result= $stmt->execute();
    return $result;
}

function getCommentsByPostID($postID)
{
    global $pdo;
    $stmt=$pdo->prepare('SELECT * FROM `User_Comment` WHERE `postID`=:postID  order BY`date_Posted` ');
    $stmt->bindParam(':postID', $postID);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_CLASS, 'UserComment');
    return $result;
}

function updatePassword($username, $password)
{
    global $pdo;
    $password=password_hash($password, PASSWORD_DEFAULT);
    $stmt=$pdo->prepare('UPDATE User_Udappu SET password=:password WHERE username=:username');
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $result=$stmt->execute();
    return $result;
}

function deleteUser($userID)
{
    global $pdo;
    $stmt=$pdo->prepare('DELETE FROM `User_Udappu` WHERE `userID`=:userID');
    $stmt->bindParam(':userID', $userID);
    $result=$stmt->execute();
    return $result;
}

function deleteComment($value='')
{
}

function likePost($value='')
{
}

function addProfilePicture($value='')
{
}
