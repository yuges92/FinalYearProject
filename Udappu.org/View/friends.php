<?php require_once '../Controller/friends.php'; ?>
<!DOCTYPE html>
<html>
  <head>
<?php require_once 'header.php'; ?>
    <title>Friends</title>
  </head>
  <body>
      <?php require_once('navigationBar.php'); ?>
<div class="">
  <?php require_once('search.php'); ?>
</div>


    <div class="container well">
        <div class=" text-center">
          <h3>My Profile</h3>
        </div>

        <div class="">
          <ul class="nav nav-pills nav-stacked col-sm-3 well">
            <li class="active"><a data-toggle="tab" href="#myFriends">My Friends</a></li>
            <li><a data-toggle="tab" href="#friendRequestReceived">Friend Request Received<span class="badge danger"><?= ($fnn>0) ? $fnn:''  ?></a></li>
            <li><a data-toggle="tab" href="#friendRequestSend">Friend Request Send</a></li>
          </ul>
        </div>


<div class="col-sm-8  tab-content">
  <div id="myFriends" class="tab-pane fade in active" >

  <div class="panel panel-info ">
    <div class="panel-heading text-center">
      <h4>My Friends</h4>
    </div>
    <?php foreach ($friends as $fd): ?>
      <?php $friend=getMemberByMemberID($fd->friend_MemberID); ?>
      <div class="panel-body">
        <div class="col-sm-8">
          <a href="user.php?userID=<?= $friend->memberID?>"><?= $friend->firstname.' '.$friend->surname  ?></a>
        </div>
        <div class="col-sm-4">
          <a name="unfriendBtn" href="" onclick="unfriend(rel);return false;" rel="<?= $friend->memberID?>">unfriend</a>

        </div>
      </div>
    <?php endforeach; ?>
  </div>
  </div>




  <div id="friendRequestSend" class="tab-pane fade " >

  <div class="panel panel-info">
    <div class="panel-heading text-center">
      <h4>Friend Request Send</h4>
        </div>
<?php foreach ($allFriendRequestsSend as $request): ?>
  <?php $friend=getMemberByMemberID($request->to_MemberID);?>
          <div class="panel-body">
            <div class="col-sm-6">
              <a href="user.php?userID=<?= $friend->memberID?>"><?= $friend->firstname.' '.$friend->surname  ?></a>
            </div>
            <div class="col-sm-6">
              <a name="cancelFriendRequestBtn" href="" onclick="cancelFriendRequest(rel);return false;" rel="<?= $friend->memberID?>">Cancel Friend Request</a>
            </div>
          </div>
<?php endforeach; ?>
  </div>
</div>


<div id="friendRequestReceived" class="tab-pane fade " >

  <div class="panel panel-info">
    <div class="panel-heading text-center">
      <h4>Friend Request Received</h4>
        </div>
        <?php foreach ($allFriendRequestsReceived as $received): ?>
          <?php $friend=getMemberByMemberID($received->from_MemberID); ?>
          <div class="panel-body">
            <div class="col-sm-6">
              <a href="user.php?userID=<?= $friend->memberID?>"><?= $friend->firstname.' '.$friend->surname  ?></a>
            </div>
            <div class="col-sm-3">
              <a name="sendFriendRequestBtn" href="" onclick="confirmFriendRequest(rel);return false;" rel="<?= $friend->memberID?>">Confirm</a>
            </div>
            <div class="col-sm-3">
              <a name="rejectFriendRequestBtn" href="" onclick="rejectFriendRequest(rel);return false;" rel="<?= $friend->memberID?>">Reject</a>
            </div>
          </div>
        <?php endforeach; ?>

  </div>
</div>
</div>
  </div>
<?php require_once('footer.php'); ?>
  </body>
</html>
