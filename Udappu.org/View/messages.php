<?php require_once '../Controller/messageController.php'; ?>
<!DOCTYPE html>
<html>
  <head>
<?php require_once 'header.php'; ?>
    <title>Messages</title>
  </head>
  <body>
      <?php require_once('navigationBar.php'); ?>
    <div class="container well">
      <div class="text-center">
        <h3>My Messages</h3>
      </div>
      <div class="">
        <ul class="nav nav-pills nav-stacked col-sm-4 well">
          <?php foreach ($allMessagers as $senderID): ?>
            <?php $senderDetail=getMemberByMemberID($senderID['from_MemberID']) ?>
            <?php $notifiMess=getAllMessageByMemberIDs($senderDetail->memberID, $member->memberID); ?>
            <li><a id="Noti<?=$senderID['from_MemberID']?>" onclick="updateMessageNotification(id);" data-toggle="tab" href="#message<?=$senderID['from_MemberID']?>">
              <?=$senderDetail->firstname.' '.$senderDetail->surname?>
              <span name="messageBadgeNoti<?=$senderID['from_MemberID']?>" class="badge danger"><?= ($notifiMess[0]->seen=='no') ? 'New':''  ?></span></a></li>

          <?php endforeach; ?>
        </ul>
      </div>

      <div class="tab-content col-sm-8" >
        <?php foreach ($allMessagers as $senderID): ?>
          <?php $senderDetail=getMemberByMemberID($senderID['from_MemberID']) ?>
          <div id="message<?=$senderID['from_MemberID']?>" class="tab-pane fade">
            <div class="panel panel-info">
              <div class="panel-header text-center">
                <h4 class=""><?=$senderDetail->firstname.' '.$senderDetail->surname?></h4>
              </div>
              <div class="panel-body" >
                <div class="well col-sm-12 pre-scrollable" name="messageContainer<?=$senderDetail->memberID?>">
                  <div class="text-center" >
                    <a href="#" onclick="scrollToLastLine(<?=$senderDetail->memberID?>);"><span class="glyphicon glyphicon-arrow-down btn-lg "></span></a>
                  </div>
                  <?php $allMessages=getAllMessagesByfromMemberIDANDToMemberID($member->memberID, $senderDetail->memberID); ?>

                      <?php foreach ($allMessages as $myMessage):
                        if ($myMessage->from_MemberID==$senderDetail->memberID) {
                            ?>
                            <div class="">
                              <div class="well col-sm-7">
                                <strong><a href="user.php?userID=<?= $senderDetail->memberID?>"><?= $senderDetail->firstname.' '.$senderDetail->surname?></a>:</strong>
                                  <span><?= $myMessage->message ?></span>
                              </div>
                            </div>

                      <?php $messageID=$myMessage->messageID;
                        } else {
                            ?>
                        <div class=" text-right">
                          <div name='hello' class="well col-sm-7 col-sm-offset-5" id="myMessage<?= $myMessage->messageID?>">
                            <strong class="">You:</strong> <span><?= $myMessage->message ?></span>
                          </div>
                        </div>

                      <?php

                        }

                      endforeach; ?>
                      <input type="text" name="messageNoti<?= $senderDetail->memberID?>" value="<?= $messageID?>" hidden>
<div class="col-sm-12" name="lastLine<?=$senderDetail->memberID?>">
  <input type="text" name="lastMessageID" value="<?=($myMessage->messageID); ?>" hidden>
</div>
                </div>
                <div class="">
                  <textarea class="form-control" rows="5" id="message<?= $senderDetail->memberID?>" name="message" required> </textarea>
                </div>
              </div>
              <div class="panel-footer">
                <a href="" id="<?= $senderDetail->memberID?>" class="btn btn-success" onclick="sendMessage(this.id);return false;" >Send</a>

              </div>
            </div>
          </div>
        <?php endforeach; ?>

  </div>
</div>

</div>

  </body>
</html>
