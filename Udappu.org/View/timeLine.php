<?php require_once '../Controller/timeLineController.php'; ?><!DOCTYPE html>
<html>

    <head>
<?php require_once 'header.php'; ?>
        <title>My Timeline</title>
    </head>

    <body>
      <?php require_once('navigationBar.php'); ?>

        <div class="container well">
            <div class="text-center">
                <h3>Time Line</h3>
            </div>

            <div class="">
              <ul class="nav nav-pills nav-stacked col-sm-3 well">
                <li><a data-toggle="tab" href="#newPost">New Post</a></li>
                <li class="active"><a data-toggle="tab" href="#myPosts">My Posts</a></li>
                <li><a data-toggle="tab" href="#friendsPost">Friends Posts</a></li>
              </ul>
            </div>

            <div class="tab-content col-sm-8">

              <div class="tab-pane fade well grey" id="newPost">
                <div class="text-center">
                    <h4>New Post</h4>
                </div>
                <form id="memberPostForm" class="form-horizontal " action="../Controller/addMemberPostController.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="col-sm-9">
                        <input class="form-control" type="text" name="title" id="title" placeholder="Title" required>
                      </div>
                      <div class="form-group col-sm-3">
                          <select class="form-control" name="privacy">
                            <option value="public">public</option>
                            <option value="private">private</option>
                          </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-12">
                        <textarea class="form-control" rows="5" id="description" name="description" placeholder="Description" required> </textarea>
                      </div>
                    </div>
                    <div class="form-group">
                        <input id="file-input" type="file" name="postImages[]" multiple accept="image/*">
                    </div>
                    <div id="preview" class="">

                    </div>

                    <div class="form-group">
                      <div class=" col-sm-7">
                        <input class="btn btn-default" type="submit" name="addPost" value="Post">
                        <input class="btn btn-default" type="reset" name="reset" value="Reset">
                      </div>
                    </div>
                </form>
              </div>

              <div id="friendsPost" class="tab-pane fade " >
                <div class="col-sm-12">
                  <div class="text-center">
                      <h4>Friends Posts</h4>
                  </div>
                  <?php foreach ($friends as $friend): ?>
                  <?php $posts=getFriendsPosts($friend->friend_MemberID); ?>
                  <?php $friendDetail=getMemberByMemberID($friend->friend_MemberID); ?>
                  <?php foreach ($posts as $post): ?>
                    <div class="panel panel-danger" >
                        <div class="panel-heading">
                          <a href="user.php?userID=<?= $friend->friend_MemberID?>"><strong><?= $friendDetail->firstname.' '.$friendDetail->surname ?></strong></a>
                           posted <strong class="title"><?=$post->title ?></strong>

                        </div>
                        <div class="panel-content">
                          <div class="">
                            <div class="text-center ">
                              <?= $post->description?>
                            </div>
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
                    <span class="datePosted col-sm-offset-4"><?=$post->date_Posted ?></span>

                  </div>
                        </div>


                        <div id="comment<?= $post->postID?>" class="collapse">
                          <div class="pre-scrollable" id="commentsBody<?= $post->postID?>">

                              <?php foreach (getCommentsByPostID($post->postID) as $userComment): ?>
                                <?php $commentBy=getMemberByMemberID($userComment->memberID); ?>
                                <div class="">
                                  <div class="col-sm-10 col-sm-offset-1">
                                    <a href="user.php?userID=<?= $commentBy->memberID?>"><?= $commentBy->firstname.' '.$commentBy->surname ?></a>
                                    Commented on:  <span class="datePosted text-right"><?=$userComment->date_Posted ?></span>
                                    <div class="well row-fluid ">
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
                            <div class="col-sm-offset-8 ">
                              <a class="btn btn-info comment-margin" href="" onclick="submitComment(this.id);return false;" id="<?= $post->postID?>">Comment</a>
                            </div>
                        </div>

                    </div>

                  <?php endforeach; ?>

                  <?php endforeach; ?>

                </div>
              </div>

              <div id="myPosts" class="tab-pane fade in active">
                <div class="col-sm-10">
                  <div class="text-center">
                      <h4>My Posts</h4>
                  </div>
                  <?php foreach ($memberPosts as $myPost): ?>
                    <div class=" panel panel-info">
                        <div class="panel-heading">
                          <strong ><?=$myPost->title ?></strong> posted on <span class="text-right posted-date"><?=$myPost->date_Posted ?> </span>
                        </div>
                        <div class="panel-content">
                <div class="text-center">
                  <div class="text-center">
                    <?=$myPost->description ?>
                  </div>
                </div>
                <div class="col-sm-offset-1">

                <?php $postAndImages=getMemberPostANDImageBYID($myPost->postID);?>
                    <?php  foreach ($postAndImages as $postAndImage):

                $image=getImageByID($postAndImage->imageID); ?>

                <a href="" data-toggle="modal" data-target="#myModal<?= $image->imageID ?>"><img src="<?= $image->folder_Name ?>/<?= $image->file_Name?>" class=" img-thumbnail"/></a>

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
                          <div class="col-sm-offset-4">
                            <a class="btn"  href="#">Like</a>
                            <a href="#comment<?= $myPost->postID?>" class="btn btn-info" data-toggle="collapse">Comment</a>
                            <a class="btn text-danger" rel="<?= $myPost->postID?>" href="" onclick="deletePost(rel);return false;">Delete Post</a>
                          </div>
                        </div>

                        <div id="comment<?= $myPost->postID?>" class="collapse">
                          <div class="pre-scrollable" id="commentsBody<?= $myPost->postID?>">

                              <?php foreach (getCommentsByPostID($myPost->postID) as $userComment): ?>
                                <?php $commentBy=getMemberByMemberID($userComment->memberID); ?>
                                <div class="">
                                  <div class="col-sm-10 col-sm-offset-1">
                                    <a href="user.php?userID=<?= $commentBy->memberID?>"><?= $commentBy->firstname.' '.$commentBy->surname ?></a>

                                    Commented on:  <span class="datePosted"><?=$userComment->date_Posted ?></span>
                                    <div class="well row-fluid">
                                      <?=$userComment->comment ?>
                                    </div>
                                  </div>

                                </div>
                              <?php endforeach; ?>
                          </div>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <textarea maxlength="200" class="form-control" rows="5" id="comment<?= $myPost->postID?>" name="comment<?= $myPost->postID?>"> </textarea>
                              </div>
                            </div>
                              <div class="col-sm-offset-8">
                              <a class="btn btn-info comment-margin" href="" onclick="submitComment(this.id);return false;" id="<?= $myPost->postID?>">Comment</a>
                              </div>

                        </div>
                    </div>
                  <?php endforeach; ?>

                  </div>
              </div>
            </div>
        </div>
    </body>

</html>
