<?php require_once('../Controller/profile.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <?php require_once 'header.php'; ?>

    <title>My Profile</title>
  </head>
  <body>
    <div class="">
      <?php require_once('navigationBar.php'); ?>
    </div>

    <div class="container well">
      <div class="col-sm-12">
        <div class="col-sm-3 ">
          <div class="well">
            <img src="../contents/images/<?= ($member->gender=='Male')?'profilelogo.jpg':'profilelogofemale.jpg'?>" class="img-profile"/>
          </div>
        </div>
      </div>
      <div class="text-center">
        <h3>My Profile</h3>
      </div>
      <div class="">
        <ul class="nav nav-pills nav-stacked col-sm-3 well">
          <li class="active"><a data-toggle="tab" href="#updatePersonalDetaile">Update Personal Details</a></li>
          <li><a data-toggle="tab" href="#changePassword">Change Password</a></li>
        </ul>
      </div>

      <div class=" col-sm-8 tab-content">
        <div class="tab-pane fade in active well" id="updatePersonalDetaile">
          <form id="updateProfileForm" class="form-horizontal" action="" method="post">
              <div class="form-group">
                  <label for='firstname' class="control-label col-sm-2" for="firstname">Firstname:</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="text" id="firstname" name="firstname" placeholder="Firstname" value="<?=$member->firstname?>" required>
                  </div>
              </div>

              <div class="form-group">
                  <label for="surname" class="control-label col-sm-2">Surname:</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="text" id="surname" name="surname" placeholder="Surname" value="<?=$member->surname?>" required>
                  </div>
              </div>

              <div class="form-group">
                  <label for="email" class="control-label col-sm-2">Email:</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="text" id="email" name="email" placeholder="Email" value="<?=$member->email?>" required>
                  </div>
              </div>

              <div class="form-group">
                  <label for="" class="control-label col-sm-2">Date of Birth:</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="Date" name="dob" value="<?=$member->dob?>" required>
                  </div>
              </div>

              <div class="form-group">
                  <label for="gender" class="control-label col-sm-2">Gender:</label>
                  <div class="col-sm-3">

                      <select class="form-control" name="gender" id="gender" required>
                        <option value=""></option>
                        <option <?= ($member->gender=='Male')?'selected="selected"':'' ?> value="Male">Male</option>
                        <option <?= ($member->gender=='Female')?'selected="selected"':'' ?> value="Female">Female</option>
                      </select>
                  </div>

              </div>
              <div class="form-group" >
                <div class="col-sm-offset-5 col-sm-10">
                  <input class="btn btn-default" type="submit" name="updateBtn" value="Update">
                  <a class="btn btn-warning" href="profile.php">Reset</a>
                </div>

              </div>
          </form>
        </div>

        <div class="tab-pane fade well " id="changePassword">

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
      </div>
</div>
  </body>
</html>
