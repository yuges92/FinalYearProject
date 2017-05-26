<?php require_once '../Controller/addPost.php'; ?>
<!DOCTYPE html>
<html>
  <head>
<?php require_once 'header.php'; ?>
    <title>Add New Post</title>
  </head>
  <body>
      <?php require_once('navigationBar.php'); ?>

    <div class="container">
        <div class="col-sm-10 well col-sm-offset-2">
            <form class="form-horizontal" action="../Controller/addPost.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-sm-9">
                    <input class="form-control" type="text" id="title" name="title" placeholder="Title" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <label for="description">Description</label>
                    <textarea class="form-control" type="text" id="description" name="description" placeholder="Description" required> </textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <input class="form-control" id="file-input" type="file" name="postImages[]" multiple accept="image/*">

                  </div>
                </div>

                  <div id="preview" class="img">
                  </div>

                <div class="form-group">
                  <div class=" col-sm-7">
                    <input class="btn btn-default" type="submit" name="addPostBtn" value="Add">
                    <input class="btn btn-default" type="reset" name="" value="Reset">
                  </div>
                </div>

            </form>
        </div>
    </div>
<?php require_once('footer.php'); ?>
  </body>
</html>
