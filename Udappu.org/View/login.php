<?php require_once '../Controller/login.php'; ?>
<!DOCTYPE html>
<html>

    <head>
        <?php require_once 'header.php'; ?>
        <title>Login</title>
    </head>

    <body>
        <?php require_once('navigationBar.php'); ?>
        <!--  -->
        <div class="container">

            <div class="center-align col-sm-6 col-sm-offset-3">
                <div class=" panel panel-info">
                    <div class="panel-heading text-center"> <strong class="">Login</strong>
                    </div>
                    <div class="panel-body ">
                        <div id="loginError" class="hidden alert alert-warning alert-dismissable fade in">
                            <a onclick="addHidden()" href="#" class="close" aria-label="close">&times;</a>
                            <strong>Please Check Your Login Details</strong>
                        </div>
                        <form class="form-horizontal" id="loginForm" action="" method="post">

                            <div class="form-group ">
                                <label class="col-sm-3 control-label" for="username">Username:</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="username" name="username" placeholder="Username" required>
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="col-sm-3 control-label" for="password">Password: </label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="Password" id="password" name="password" placeholder="Password" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <input class="btn btn-default" type="submit" name="loginBtn" value="Login">
                                    <input class="btn btn-default" type="reset" name="" value="Reset">
                                </div>
                                <div class="">
                                  <a href="#" class="btn btn-link col-sm-offset-3" data-toggle="modal" data-target="#forgotPasswordModel">Forgot password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="forgotPasswordModel" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Please Enter your Email Address</h4>
        </div>
        <div class="modal-body">
          <div class="">
            <form class="" action="../Controller/resetPassword.php" method="post">
              <div class="form-group">
                <div class="col-sm-7">
                  <input class="form-control " type="text" name="email" value="" placeholder="Please Enter your Email Address" required>
                </div>
                <div class="">
                  <input class="btn btn-info" type="submit" name="resetPassword" value="Submit">
                </div>

              </div>
            </form>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
        </div>

    </body>
<?php require_once('footer.php'); ?>
</html>
