<?php
require_once('config.php');
 $result = Poll::loadAllpolls();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Voting Application</title>
  <meta charset="utf-8">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/ajax.js"></script>
</head>
<body>

<div class="container">
            <h1 class="heading">Welcome to Simple Voting!</h1>
 <ul class="topnav">
  <li><a class="active" href="index.php">Home</a></li>
  <li><a href="my_polls.php">My Polls</a></li>
  <li><a href="create_poll.php">New Poll</a></li>
  <li style="float:right"><a href="#about">Ambreen</a></li>
</ul>
<div id="votingApp">
 <div class="heading2">
    Select a poll to see the results and vote
</div>
<?php foreach($result as $row){
 ?>
   <div class="myApp">
   <a href="votePoll.php?id=<?php echo $row['id'];  ?>" class="links" id="mypoll"><?php echo $row['subject']; ?></a>
   </div>
<?php }?>
</div>
</div>
</body>
</html>
