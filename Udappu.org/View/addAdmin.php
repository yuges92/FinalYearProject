<?php require_once '../Controller/addAdminController.php'; ?>
<!DOCTYPE html>
<html>
  <head>
<?php require_once 'header.php'; ?>
    <title>Add New Admin</title>
  </head>
  <body>
        <?php require_once('navigationBar.php'); ?>

    <div class="container">
        <div class="col-sm-10 well col-sm-offset-2">
            <form name='addAdmin' id="formaddAdminForm " class="form-horizontal" action="" method="post">
                <div class="form-group">

                    <label class="control-label col-sm-4" for="firstname">Firstname</label>
                    <div class="col-sm-7">
                    <input class="form-control" type="text" id="firstname" name="firstname" placeholder="Firstname" required>
                  </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="surname">Surname</label>
                    <div class="col-sm-7">
                    <input class="form-control" type="text" id="surname" name="surname" placeholder="Surname" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="email">Email: </label>
                    <div class="col-sm-7">
                      <input class="form-control" type="text" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="col-sm-1">
                      <span id="emailFeedOK" class=" hidden control-label glyphicon glyphicon-ok text-success"></span>
                      <span id="emailFeedNo" class="hidden control-label glyphicon glyphicon-remove text-danger"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="">Date of Birth</label>
                    <div class="col-sm-7">
                    <input class="form-control" type="Date" name="dob" required>
                  </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="username">Username</label>
                  <div class="col-sm-7">
                      <input class="form-control" type="text" id="username" name="username" placeholder="Username" required>
                  </div>
                  <div class="col-sm-1">
                    <span id="usernameFeedOK" class=" hidden control-label glyphicon glyphicon-ok text-success"></span>
                    <span id="usernameFeedNo" class="hidden control-label glyphicon glyphicon-remove text-danger"></span>
                  </div>

                </div>
                <div class="form-group">
                  <div class="col-sm-offset-4 col-sm-7">
                    <input class="btn btn-default" type="submit" name="addAdmin" value="Add">
                    <input class="btn btn-default" type="reset" name="" value="Reset">
                  </div>
                </div>

            </form>
        </div>
    </div>
<?php require_once('footer.php'); ?>
  </body>
</html>
