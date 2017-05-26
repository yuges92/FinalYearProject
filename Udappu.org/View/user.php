<?php require_once('../Controller/user.php'); ?>
<!DOCTYPE html>
<html>

    <head>
<?php require_once 'header.php'; ?>
        <title><?= $otherUser->firstname.' '.$otherUser->surname?></title>
    </head>

    <body>
      <?php require_once('navigationBar.php'); ?>

      <div class="container well">
        <div class=" well">
          <div class="">
            <div class="">
              <img src="../contents/images/<?= ($gender=='Male')?'profilelogo.jpg':'profilelogofemale.jpg'?>" class="img-profile"/>
            </div>
          <a href="user.php?userID=<?= $otherUser->memberID?>"><?= $otherUser->firstname.' '.$otherUser->surname ?></a>
          </div>
          <div class="comment-margin">
          <?php if ($btn=='friend request received') {
    ?>
            <a class="btn btn-sm btn-success" name="confirmFriendRequestBtn" href="" onclick="confirmFriendRequest(rel);return false;" rel="<?= $otherUser->memberID?>">Confirm</a>
            <a class="btn btn-sm btn-warning" name="rejectFriendRequestBtn" href="" onclick="rejectFriendRequest(rel);return false;" rel="<?= $otherUser->memberID?>">Reject</a>
          <?php

} elseif ($btn=='Friends') {
    ?>
            <a class="btn btn-sm btn-danger btn-md" name="unfriendBtn" href="" onclick="unfriend(rel);return false;" rel="<?= $otherUser->memberID?>">unfriend</a>
          <?php

} else {
    ?>
            <a <?= ($btn=='Requested')?'hidden' :'class="btn btn-sm btn-info"' ?> name="sendFriendRequestBtn" href="" onclick="sendFriendRequest(rel);return false;" id="friend<?= $otherUser->memberID?>" rel="<?= $otherUser->memberID?>"><?=$btn  ?></a>
            <a <?= ($btn!='Requested')?'hidden':'class="btn btn-sm btn-warning"' ?> name="cancelFriendRequestBtn" href="" onclick="cancelFriendRequest(rel);return false;" rel="<?= $otherUser->memberID?>">Cancel Friend Request</a>

          <?php

} ?>
          </div>
          <div class="">
            <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#newMessage">Send Message</button>
          </div>

        </div>



<div class="">
    <div class="modal fade" id="newMessage" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">New Message</h4>
          </div>
          <div class="modal-body">
            <div class="">
              To: <span class="title"><?= $otherUser->firstname.' '.$otherUser->surname ?></span>
            </div>
            <div class="">
              <textarea class="form-control" rows="5" id="message<?= $otherUser->memberID?>" name="message<?= $otherUser->memberID?>" required> </textarea>
            </div>
          </div>
          <div class="modal-footer">
            <a href="" id="<?= $otherUser->memberID?>" class="btn btn-success" onclick="sendMessage(this.id);return false;" >Send</a>
            <a href="" class="btn btn-default" data-dismiss="modal">Close</a>
          </div>
        </div>
      </div>
    </div>
</div>


<div class=" col-sm-10 col-sm-offset-2">
  <div id="friendsPost" class="" >
    <div class="col-sm-10">
      <div class="text-center">
          <h4>Friends Posts</h4>
      </div>
<?php foreach ($otherUserPost as $post): ?>


        <div class="panel panel-danger" >
            <div class="panel-heading">
              <a href="user.php?userID=<?=$otherUser->memberID ?>"><strong><?= $otherUser->firstname.' '.$otherUser->surname?></strong></a>
               posted <strong class="title"><?=$post->title ?></strong>
            </div>
            <div class="panel-content">
              <div class="text-center">
                <?= $post->description?>
              </div>
              <div class="">
              <?php $postAndImages=getMemberPostANDImageBYID($post->postID);?>
                  <?php  foreach ($postAndImages as $postAndImage):

              $image=getImageByID($postAndImage->imageID); ?>

                <a href="" data-toggle="modal" data-target="#myModal<?= $image->imageID ?>"><img src="<?= $image->folder_Name ?>/<?= $image->file_Name?>" class="img-thumbnail"/></a>


              <div class="modal fade box" id="myModal<?= $image->imageID ?>" role="dialog">
              <div class="modal-dialog">
              <div class="modal-body">
              <img data-dismiss="modal" class="imgBig" src="<?= $image->folder_Name ?>/<?= $image->file_Name?>"/>
              </div>
              </div>
              </div>
                  <?php
              endforeach ?>
              </div>
            </div>
            <div class="panel-footer">
      <div class="">
        <a class="btn" href="#">Like</a>
        <a href="#comment<?= $post->postID?>" class="btn btn-info" data-toggle="collapse">Comment</a>
        <span class="datePosted col-sm-offset-4"> <?=$post->date_Posted ?></span>

      </div>
            </div>

            <div id="comment<?= $post->postID?>" class="collapse">
              <div class="pre-scrollable">

                  <?php foreach (getCommentsByPostID($post->postID) as $userComment): ?>
                    <?php $commentBy=getMemberByMemberID($userComment->memberID); ?>
                    <div class="">
                      <div class="col-sm-10 col-sm-offset-1">
                        <a href="user.php?userID=<?= $commentBy->memberID?>"><?= $commentBy->firstname.' '.$commentBy->surname ?></a>
                        Commented on:  <span class="datePosted text-right"><?=$userComment->date_Posted ?></span>
                        <div class="well row-fluid">
                          <?=$userComment->comment ?>
                        </div>
                      </div>

                    </div>
                  <?php endforeach; ?>
              </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <textarea maxlength="200" class="form-control" rows="5" id="comment<?= $post->postID?>" name="comment<?= $post->postID?>"> </textarea>
                  </div>
                </div>
                  <div class="">
                  <a class="btn btn-info" href="" onclick="submitComment(this.id);return false;" id="<?= $post->postID?>">Comment</a>
                  </div>

            </div>

        </div>
<?php endforeach; ?>
    </div>
  </div>

      </div>
    </body>

</html>
