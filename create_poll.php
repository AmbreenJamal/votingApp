<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" />
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/ajax.js"></script>
</head>
<body>
<div class="container">
        <h1 class="heading">Welcome to Simple Voting!</h1>
<div class="content">
 <div id="votingApp">
       <h2>Create New Poll</h2>
        <form method="post"  action="savePoll.php">
    <div class="form-group">
      <label for="poll">Name Your Poll</label>
      <input type="text" class="form-control" name="pollName" placeholder="What is your favourite brand?" />
    </div>
    <div class="form-group">
      <label for="options">Options</label>
     <div  id="more_options">
      <input type="text" class="form-control"  placeholder="Coke" name="options[]" />
      <input type="text" class="form-control"  placeholder="Pepsi" name="options[]" />
  </div>
    </div>
    <div class="form-group">
    <button type="button" class="More_Options" onclick ="add_fields()">More Options</button>
    <input type="submit"  value="Submit" name="Submit"/>
    </div>
</form>
</div>
<div id="error_msg"></div>
</div>
</div>

</body>
</html>
