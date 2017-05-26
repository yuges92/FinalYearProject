<?php require_once '../Controller/search.php'; ?>
<!DOCTYPE html>
<html>

    <head>
<?php require_once 'header.php'; ?>
        <title>Search Result</title>
    </head>

    <body>
      <?php require_once('navigationBar.php'); ?>
        <div class="container">
            <div class="text-center">
                <h3>Search Results</h3>
            </div>
            <div class="well col-md-8 col-md-offset-2">
              <?php foreach ($searchResult as $member): ?>
                <div class="well">
                    <a href="user.php?userID=<?= $member->memberID?>"><?= $member->firstname.' '.$member->surname  ?></a>
                </div>
              <?php endforeach; ?>
            </div>
        </div>
    </body>

</html>
