<?php
require_once('config.php');
$poll_id  = $_GET['id'];
$data = Poll::loadchart($poll_id);
 $pollOptions = Poll ::GetMyPollOptions($poll_id);
   $GetMyPoll    = Poll ::GetMyPoll($poll_id);
   foreach ($GetMyPoll as $poll_row)
    {
       $subject= $poll_row['subject'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Voting Application</title>
  <meta charset="utf-8">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" />
  <link rel="stylesheet" href="css/styles.css">
  <style>
.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 1s;
}

.tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}
</style>
</head>
<body>
<div class="container">
        <h1 class="heading">Welcome to Simple Voting!</h1>
<div class="content">

 <div id="votingApp" class="optionscontent">
  <form method="post" id="like_form">

      <div id="error_msg"></div>
      <div class="tooltip">Hover over me
      <span class="tooltiptext"></span>
      </div>
    <h3><?php   echo  $subject; ?> </h3>
    <?php foreach($pollOptions as $OptionsRow){
?>
      <div><input type="radio" id="optionName" name="optionName"  value="<?php echo $row['id']; ?>" onclick="myVote(<?php echo $OptionsRow['id']; ?>)">
              <?php echo $OptionsRow['options']; ?></div>
          <?php } ?>
       <input type="hidden" name="poll_id" value="<?php echo $poll_id ?>"><input type="hidden" name="myvote"  id="myvote">
        <input type="submit" name="vote" id="Submitvote" value="SubmitVote" />
        <div id="success_msg" class="success"><?php //echo $msg; ?></div>
        </form>
</div>
<div class="mychart">
   <div id="chart"></div>
</div>

</div>
</div>

</body>
</html>
<script>
$(document).ready(function(){

 var donut_chart = Morris.Donut({
     element: 'chart',
     data: <?php echo $data; ?>
    });
 $('#like_form').on('submit', function(event){
  event.preventDefault();

  var checked = $('input[name=optionName]:checked', '#like_form').val();
  if(checked == undefined)
  {
   alert("Please choose one  Option");
   return false;
  }
  else
  {
     //alert('selected')
   var form_data = $(this).serialize();
   $.ajax({
    url:"loadPoll.php",
    method:"POST",
    data:form_data,
    dataType:"json",
    success:function(data)
    {
     $('#like_form')[0].reset();
       donut_chart.setData(data);
var error_msg ='';
if(data[0].msg)
     error_msg =  "Vote submit successfully";
else
     error_msg =  "You already submit your vote";
$("#error_msg").fadeIn().html(error_msg);
setTimeout(function(){     $("#error_msg").fadeOut('slow') }, 2000);


    }
   });
  }
 });
});

function  myVote(entry){
document.getElementById("myvote").value= entry;
//alert(entry);
}
</script>
