<?php require_once '../Controller/addEvent.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <?php require_once 'header.php'; ?>
    <title>Add New Event</title>
  </head>
  <body>
      <?php require_once('navigationBar.php'); ?>
    <div class="container">
        <div class="col-sm-10 well col-sm-offset-2">
            <form class="form-horizontal" action="../Controller/addEvent.php" method="post">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="title">Title:</label>
                    <div class="col-sm-7">
                    <input class="form-control" type="text" id="title" name="title" placeholder="Title" required>
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="description">Description:</label>
                    <div class="col-sm-7">
                    <textarea class="form-control" type="text" id="description" name="description" placeholder="Description" required> </textarea>
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="startDate">Start Date:</label required>
                      <div class="col-sm-7">
                    <input class="form-control" type="Date" id="startDate" min="<?=date("Y-m-d");?>" name="start_Date">
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="endDate">End Date:</label required>
                      <div class="col-sm-7">
                    <input class="form-control" type="Date" id="endDate" min="<?=date("Y-m-d");?>" name="end_Date" >
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-4 col-sm-7">
                    <input class="btn btn-default" type="submit" name="addEventBtn" value="Add">
                    <input class="btn btn-default" type="reset" value="Reset">
                  </div>
                </div>

            </form>
        </div>
    </div>
<?php require_once('footer.php'); ?>
  </body>
</html>
