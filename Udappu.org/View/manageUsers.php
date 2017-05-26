<?php require_once '../Controller/manageUsers.php'; ?>
<!DOCTYPE html>
<html>

    <head>
<?php require_once 'header.php'; ?>
        <title></title>
    </head>

    <body>
            <?php require_once('navigationBar.php'); ?>
        <div class="container well">

            <div class="text-center">
                <h2>Manage All Users</h2>
            </div>


<div class="well">
  <button class="btn btn-info" data-toggle="collapse" data-target="#changePasswordDiv">Change Password</button>
</div>
            <div class="collapse well " id="changePasswordDiv">
              <form id="updatePasswordForm" action="" class="form-horizontal" method="post">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="password">Current Password</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="Password" id="oldPassword" name="oldPassword" placeholder="Current Password" required>

                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="newPassword">New Password</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="Password" id="newPassword" name="newPassword" placeholder="New Password" required>

                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="confirmPassword">Confirm Password</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="Password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>

                    </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-5 col-sm-10">
                    <input class="btn btn-default" type="submit" name="changePasswordBtn" value="Change Password">
                    <input class="btn btn-warning" type="reset" name="" value="Reset">
                  </div>
                </div>
              </form>
            </div>
            <div class="">
              <div class="col-sm-12">

              <?php if ($_SESSION['feedback']=='success') {
    ?>
                  <div class="alert alert-success alert-dismissable fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Added!</strong> New Admin Successfully Added.

                </div>
              <?php
  $_SESSION['feedback']='';
} elseif ($_SESSION['feedback']=='failed') {
    ?>
                <div class="alert alert-danger alert-dismissable fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Failed!</strong> Failed to Add new Admin.
              </div>
              <?php
  $_SESSION['feedback']='';
} ?>
              </div>
            </div>

            <div class="well">
              <div class="">
                <h3>Admins</h3>
              </div>
                <div class="">
                    <a class="btn btn-primary" href="addAdmin.php">Add New Admin</a>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                          <th>Admin ID</th>
                            <th>Username</th>
                            <th>Firstname</th>
                            <th>Surname </th>
                            <th>DOB</th>
                            <th>Email</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php foreach ($admins as $admin): ?>
                          <tr>
                              <td><?= $admin->adminID ?></td>
                              <td><?= $admin->username ?></td>
                              <td><?= $admin->firstname ?></td>
                              <td><?= $admin->surname ?></td>
                              <td><?= $admin->dob ?></td>
                              <td><?= $admin->email ?></td>

                              <td><a class="btn btn-warning" href="editAdmin.php?adminID=<?= $admin->adminID ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                              <td><a class="<?=($admin->userID==1 || $admin->userID==$_SESSION['user']->userID)?'hidden':'' ?> btn btn-danger" href="#" onclick="deleteUser(<?=$admin->userID?>);"><span class="glyphicon glyphicon-remove"></span></a></td>
                          </tr>
                        <?php endforeach; ?>

                    </table>

                </div>
            </div>

            <div class="well">
              <div class="">
                <h3>Members</h3>
              </div>
                <div class="table-responsive row">
                  <table class="table">
                      <tr>
                        <th>Member ID</th>
                          <th>Username</th>
                          <th>Firstname</th>
                          <th>Surname </th>
                          <th>DOB</th>
                          <th>Email</th>
                          <th></th>
                      </tr>
                      <?php foreach ($members as $member): ?>
                        <tr>
                            <td><?= $member->memberID ?></td>
                            <td><?= $member->username ?></td>
                            <td><?= $member->firstname ?></td>
                            <td><?= $member->surname ?></td>
                            <td><?= $member->dob ?></td>
                            <td><?= $member->email ?></td>
                            <td><a class="btn btn-danger" href="#" onclick="deleteUser(<?=$member->userID?>);"><span class="glyphicon glyphicon-remove"></span></a></td>

                        </tr>
                      <?php endforeach; ?>

                  </table>
                </div>
            </div>
        </div>
        <?php require_once('footer.php'); ?>
        
    </body>

</html>
