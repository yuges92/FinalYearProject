<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid ">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand " href="index.php"><span class="brand-colour">Udappu</span> Community</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <?php if (isset($_SESSION['user'])) {
    if ($_SESSION['user']->role=='Member') {
        ?>
        <?php
        $allFriendRequest=getAllFriendRequestsReceived($member->memberID);
        $allMessageNotification=getAllMessageNotificationByMemberID($member->memberID);
        $fnn=sizeof($allFriendRequest);
        $mnn=sizeof($allMessageNotification); ?>

            <li><a href="profile.php">Profile</a></li>
            <li><a href="timeLine.php">TimeLine</a></li>
            <li><a href="friends.php">Friends <span class="badge danger"><?= ($fnn>0) ? $fnn:''  ?></span></a></li>
            <li><a href="messages.php">Messages <span name="messageBadge" class="badge danger"><?= ($mnn>0) ? $mnn:''  ?></span></a></li>


          <?php

    } else {
        ?>
        <li><a href="manageContents.php">Manage Contents</a></li>
        <li><a href="manageUsers.php">Manage Users</a></li>
  <?php

    } ?>

        <?php

} else {
    ?>
  </ul>
  <ul class="nav navbar-nav navbar-right">
    <?php if (isset($_SESSION['user']) && ($_SESSION['user']->role=='Admin')) {
    } else {
        ?>
      <li ><a class="text-success" href="register.php"><span class="text-info glyphicon glyphicon-user"></span> Register</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
  <?php

    } ?>

        <?php

} ?>
<?php if (isset($_SESSION['user'])) {
    $user='';
    if ($_SESSION['user']->role=='Admin') {
        $user=getAdminByUserID($_SESSION['user']->userID);
    } else {
        $user=getMemberByUserID($_SESSION['user']->userID);
    } ?>
  </ul>
  <ul class="nav navbar-nav navbar-right">
    <li class="navbar-form"><?php require_once('search.php'); ?></li>
      <li><a href="profile.php"><span class="text-success"><?=$user->firstname  ?></span> </a></li>
        <li><a href="../Controller/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        <?php

}
    ?>
      </ul>
    </div>
  </div>
</nav>

<?php require_once('footer.php'); ?>
