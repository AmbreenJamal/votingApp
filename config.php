<?php
require_once('database.php');
class   Poll  extends Database {

public static function loadAllpolls() {

$result =$sqr = SELF::query3("SELECT * FROM polls");
return $result;

}

public static function loadchart($poll_id, $status=NULL) {

                 $result = SELF::query3("
                    SELECT a.options,
                    count(b.poll_option_id)+b.vote_count as no_of_votes
                     FROM
                 	   poll_options a
                 	       left outer join poll_votes b
                 		        on a.id=b.poll_option_id
                      WHERE     b.poll_id=$poll_id
                       GROUP BY
                          a.options");
    $data = array();
    foreach ($result as $row) {
        $data[] = array(
         'label'  => $row["options"],
         'value'  => $row["no_of_votes"],
          'msg'  => $status
        );
    }
//    echo count($data);
    //var_dump($data); exit;
     return  $data = json_encode($data);

}

public static function insert($Option, $subject) {

$polls = array();
$polls = array('subject' => $subject);

$pollid = SELF::query2("INSERT INTO polls  (subject)  VALUES ('$subject')");

    $my_data = array();
    $i=0;
    foreach ($Option as $value) {
    $my_data[$i] = array('options' => $value, 'poll_id' => $pollid);
    $i++;
    }
    //echo var_dump($my_data);
     $sqr1 = SELF::query1("INSERT INTO poll_options  (options, poll_id)  VALUES (:options, :poll_id)",$my_data);
    return $pollid;
    //echo  $pollid;
//    exit;
/*
    $sqr = SELF::query3("SELECT * FROM poll_options WHERE poll_id=$pollid");
    //  return $sqr;
echo "<h3>". $subject. "</h3>";
     foreach($sqr as $row){

          echo  "<div><input type='radio'  id='optionName' name='optionName' onclick='myVote(".$row['id'].")'  value=". $row['id']." >".$row['options']."</div>";
     }
      echo "<button type='button'  id='Submitvote' value='SubmitVote' onclick='myFunction()'>Submit Vote</button>
        <input type='hidden' name='poll_id' value=".$pollid."><input type='hidden' name='myvote'  id='myvote' value=''>
        <div></div><div id='success_msg'></div>";*/
//exit;
}
public static function saveVote($poll_option_id, $poll_id) {

//echo $poll_option_id; exit;
  $ipaddress = $_SERVER["REMOTE_ADDR"];
 $pollsIPcheck     = SELF::query3("SELECT user_ip ,vote_date,  poll_id, poll_option_id FROM poll_votes WHERE user_ip='$ipaddress'");
 $user_ip='';
 $pre_voteDate='';
 $new_voteDate = date("Y-m-d");
 foreach ($pollsIPcheck as $IP)
{
 $user_ip = $IP['user_ip'];
  $pre_voteDate = $IP['vote_date'];
  $pre_poll_id = $IP['poll_id'];
  $option_id = $IP['poll_option_id'];
}
 if($user_ip){
//echo  $pre_voteDate .$pre_voteDate."  ".$option_id;exit;
                if($new_voteDate===$pre_voteDate && $pre_poll_id === $poll_id)
                  {
                                            echo  SELF:: loadchart($poll_id, 0);//,"Error: You can only vote once a day");
                         }
                else if($new_voteDate!==$pre_voteDate)
                 {
                                    if($poll_option_id===$option_id){
                                          $sqr = SELF::updateVote("UPDATE poll_votes SET vote_count = vote_count+1,
                                    vote_date ='$new_voteDate' WHERE user_ip='$user_ip' AND poll_option_id = '$poll_option_id'");
                             //$vote_id = SELF::query2("INSERT INTO poll_votes  (poll_option_id,poll_id,user_ip,vote_date)  VALUES ('$poll_option_id','$poll_id','$ipaddress','$new_voteDate')");
                                    //SELF::displayfunc($poll_id, "Success: Your vote submit");
                                                        echo    SELF:: loadchart($poll_id, 1);
                                             }
                                     else {
                                      $vote_id = SELF::query2("INSERT INTO poll_votes  (poll_option_id,poll_id,user_ip,vote_date)  VALUES ('$poll_option_id','$poll_id','$ipaddress','$new_voteDate')");
                                  //call function
                                     //SELF::displayfunc($poll_id, "Success: Your vote submit");
                                      echo SELF:: loadchart($poll_id,1);

                                 }
                }
                else {
                    $vote_id = SELF::query2("INSERT INTO poll_votes  (poll_option_id,poll_id,user_ip,vote_date)  VALUES ('$poll_option_id','$poll_id','$ipaddress','$new_voteDate')");
                //call function
                   //SELF::displayfunc($poll_id, "Success: Your vote submit new poll");
                    echo SELF:: loadchart($poll_id, 1);
                }
            }
 else  {
     $vote_id = SELF::query2("INSERT INTO poll_votes  (poll_option_id,poll_id,user_ip,vote_date)  VALUES ('$poll_option_id','$poll_id','$ipaddress','$new_voteDate')");
        //SELF::displayfunc($poll_id, "Success: Your vote submit");
         echo SELF:: loadchart($poll_id,1);

 }
}
public static function displayfunc($poll_id, $msg = NULL)
{
   $options_row   = SELF::query3("SELECT * FROM poll_options WHERE poll_id=$poll_id");
   $poll_row    = SELF::query3("SELECT * FROM polls WHERE id=$poll_id");
foreach ($poll_row as $pollsubject)
 {
    echo  "<h3>". $pollsubject['subject'];"</h3>";
 }
foreach($options_row as $row){
 echo  "<div><input type='radio'  id='optionName' name='optionName'  value=". $row['id']." onclick='myVote(".$row['id'].")'>".$row['options']."</div>";
 }
 echo "<button type='button'  id='Submitvote'  value='SubmitVote' onclick='myFunction()'>Submit Vote</button>
<input type='hidden' name='poll_id' value=".$poll_id."><input type='hidden' name='myvote' id='myvote' value=''>
<div></div><div id='success_msg' class='success'>".$msg."</div><div id='chart'></div>";
exit;
}
public static function GetMyPoll($poll_id)
{
 return  $poll_row    = SELF::query3("SELECT * FROM polls WHERE id=$poll_id");
}
public static function GetMyPollOptions($poll_id)
{
 return $options_row   = SELF::query3("SELECT * FROM poll_options WHERE poll_id=$poll_id");
}
}
?>
