<?php require_once('../Controller/register.php');?>
<!DOCTYPE html>
<html>

    <head>
<?php require_once 'header.php'; ?>
        <title>Udappu Community Member Registeration</title>
    </head>

    <body>
      <?php require_once('navigationBar.php'); ?>
        <!--  -->
        <div class="container ">
            <div class="col-sm-10 well col-sm-offset-2">
                <form class="form-horizontal" action="" method="post" id="registerForm">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="firstname">Firstname: </label>
                      <div class="col-sm-7">
                          <input class="form-control" type="text" id="firstname" name="firstname" placeholder="Firstname" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" for="surname">Surname: </label>
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
                        <label class="control-label col-sm-4" for="">Date of Birth:</label>
                      <div class="col-sm-7">
                          <input class="form-control" type="Date" name="dob" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="gender">Gender:</label>
                      <div class="col-sm-7">
                        <div class="col-sm-7">
                          <div class=" radio col-sm-7">
                            <input  type="radio" name="gender" value="male" id="male" required><label for="male">Male</label>
                          </div>
                          <div  class="radio col-sm-7">
                            <input  type="radio" name="gender" value="female" id="female" required><label for="female" >Female</label>
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="username">Username:</label>
                      <div class="col-sm-7">
                          <input class="form-control" type="text" id="username" name="username" placeholder="Username" required>
                        </div>
                        <div class="col-sm-1">
                          <span id="usernameFeedOK" class=" hidden control-label glyphicon glyphicon-ok text-success"></span>
                          <span id="usernameFeedNo" class="hidden control-label glyphicon glyphicon-remove text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="password">Password:</label>
                      <div class="col-sm-7">
                          <input class="form-control" type="Password" id="password" name="password" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" for="confirmPassword">Confirm Password:</label>
                      <div class="col-sm-7">
                          <input class="form-control" type="Password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                        </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-offset-4 col-sm-7">
                          <input class="btn btn-default" type="submit" name="registerBtn" value="Register">
                        <input class="btn btn-default" type="reset" name="" value="Reset">
                      </div>
                    </div>

                </form>
            </div>
        </div>

    </body>

</html>
