<?php require_once '../Controller/editAdminController.php'; ?>
<!DOCTYPE html>
<html>
  <head>
<?php require_once 'header.php'; ?>
    <title>Edit Admin</title>
  </head>
  <body>
        <?php require_once('navigationBar.php'); ?>

    <div class="container">
      <div class="col-sm-10 col-sm-offset-2">

      <?php if ($feedback=='success') {
    ?>
          <div class="alert alert-success alert-dismissable fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Updated!</strong> Successfully updated.

        </div>
      <?php

} elseif ($feedback=='failed') {
    ?>
        <div class="alert alert-danger alert-dismissable fade in">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>Failed!</strong> failed to Update.
 </div>
    <?php

} ?>
</div>


        <div class="col-sm-10 well col-sm-offset-2">
            <form id="updateAdminForm" class="form-horizontal" action="../Controller/editAdminController.php" method="post">
              <div class="form-group">
                <label class="control-label col-sm-4" for="firstname">Admin ID</label>
                <div class="col-sm-2">
                <input readonly class="form-control" value="<?=$editAdmin->adminID ?>" type="text" name="adminID">
              </div>
              </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="firstname">Firstname</label>
                    <div class="col-sm-7">
                    <input class="form-control" value="<?=$editAdmin->firstname ?>" type="text" id="firstname" name="firstname" placeholder="Firstname" required>
                  </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="surname">Surname</label>
                    <div class="col-sm-7">
                    <input class="form-control" value="<?=$editAdmin->surname ?>" type="text" id="surname" name="surname" placeholder="Surname" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="email">Email: </label>
                    <div class="col-sm-7">
                      <input class="form-control" value="<?=$editAdmin->email ?>" type="text" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="col-sm-1">
                      <span id="emailFeedOK" class=" hidden control-label glyphicon glyphicon-ok text-success"></span>
                      <span id="emailFeedNo" class="hidden control-label glyphicon glyphicon-remove text-danger"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="">Date of Birth</label>
                    <div class="col-sm-7">
                    <input class="form-control" value="<?=$editAdmin->dob ?>" type="Date" name="dob" required>
                  </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="username">Username</label>
                  <div class="col-sm-7">
                      <input class="form-control" value="<?=$editUsername ?>" type="text" id="username" name="username" placeholder="Username" required readonly>
                  </div>
                  <div class="col-sm-1">
                    <span id="usernameFeedOK" class=" hidden control-label glyphicon glyphicon-ok text-success"></span>
                    <span id="usernameFeedNo" class="hidden control-label glyphicon glyphicon-remove text-danger"></span>
                  </div>

                </div>
                <div class="form-group">
                  <div class="col-sm-offset-4 col-sm-7">
                    <input class="btn btn-default" class="danger" type="submit" name="updateAdmin" value="update">
                    <input class="btn btn-default" type="reset" name="" value="Reset">
                  </div>
                </div>

            </form>
        </div>
    </div>
<?php require_once('footer.php'); ?>
  </body>
</html>
