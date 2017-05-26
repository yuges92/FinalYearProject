<?php require_once '../Controller/homepage.php'; ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <?php require_once 'header.php'; ?>
        <title>Udappu Community</title>
    </head>

    <body>
        <?php require_once('navigationBar.php'); ?>


        <div class="container well">
            <div class="text-center">
                <h2>Welcome to Udappu Community</h2>
            </div>
            <div class="">

                <div class="col-sm-8 well ">

                    <div class="text-center">
                        <h3>Latest Posts</h3>
                    </div>
                    <?php foreach ($posts as $post) {
    ?>
                    <div class="panel panel-default ">
                        <div class="panel-heading text-center post-colour-madalGrey">
                            <h4><?= $post->title?></h4>
                            <div class="text-right">
                                <span class="">Posted on: <?= $post->date_Posted?></span>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class=" text-center well">
                                <span><?= $post->description ?></span>
                            </div>
                            <?php $postAndImages=getPostANDImageBYID($post->postID); ?>
                            <div class="well">
                                <?php  foreach ($postAndImages as $postAndImage):
                                  $image=getImageByID($postAndImage->imageID); ?>

                                    <a  href="" data-toggle="modal" data-target="#myModal<?= $image->imageID ?>"><img src="<?= $image->folder_Name ?>/<?= $image->file_Name?>" class="img-thumbnail" /></a>

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
                    </div>
                    <?php

} ?>
                </div>
                <div class="col-sm-4">
                    <div class=" well">
                        <div class="text-center">
                            <h3>Upcoming events</h3>
                        </div>
                        <?php foreach ($events as $event) {
    ?>
    <div class="">

                        <div class="panel panel-warning ">
                            <div class="panel-heading well">
                                <h4 class="text-center"><?=$event->title?></h4>
                                <div class="text-right">
                                    <span><?=$event->date_Posted?></span>
                                </div>
                            </div>
                            <div class="panel-body well">
                                <div class="well">
                                    <span><?=$event->description?></span>
                                </div>
                                <div class="">
                                    <span><strong>From:</strong> <?=$event->start_Date?></span>
                                </div>
                                <div class="">
                                    <span><strong>To:</strong> <?=$event->end_Date?></span>

                                </div>
                            </div>
                        </div>
                      </div>

                        <?php

} ?>
                    </div>
                </div>
            </div>
        </div>

<?php require_once('footer.php'); ?>
    </body>

</html>
