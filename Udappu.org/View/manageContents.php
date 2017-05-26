<?php require_once '../Controller/manageContents.php'; ?>
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
                <h2>Manage Contents</h2>
            </div>

            <div class="well">
                <div class="">
                    <a class="btn btn-primary" href="addPost.php">Add New Post</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Post ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>images</th>
                            <th>Created Date </th>
                            <th>Posted By</th>
                            <th></th>
                        </tr>
                        <?php foreach ($posts as $post): ?>
                          <tr>
                              <td><?= $post->postID ?></td>
                              <td><?= $post->title ?></td>
                              <td><?= $post->description ?></td>
                              <?php $postAndImages=getPostANDImageBYID($post->postID);?>
                              <td>  <?php foreach ($postAndImages as $postAndImage): ?>

                                <a href="viewImage.php?image=<?=$postAndImage->imageID?>"><?=$postAndImage->imageID ?></a>
                                <?php endforeach; ?></td>
                              <td><?= $post->date_Posted ?></td>
                              <td><?= $post->adminID ?></td>
                              <td><a class="btn btn-danger" rel="<?= $post->postID?>" href="" onclick="deleteAdminPost(rel);return false;"><span class="glyphicon glyphicon-remove"></span></a></td>

                          </tr>
                        <?php endforeach; ?>

                    </table>

                </div>
            </div>

            <div class="well">
                <div class="">
                    <a class="btn btn-primary" href="addEvent.php">Add New Event</a>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created Date </th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php foreach ($events as $event): ?>
                          <tr>
                              <td><?= $event->title ?></td>
                              <td><?= $event->description ?></td>
                              <td><?= $event->date_Posted?></td>
                              <td><a class="btn btn-danger" rel="<?= $event->eventID?>" href="" onclick="deleteEvent(rel);return false;"><span class="glyphicon glyphicon-remove"></span></a></td>

                          </tr>
                        <?php endforeach; ?>

                    </table>
                </div>
            </div>
        </div>
        <?php require_once('footer.php'); ?>
        
    </body>

</html>
