<?php
require_once('config.php');
if (isset($_POST['action'])) {
   switch ($_POST['action']) {
        case 'submit':
        $Option = $_POST['options'];
        $pollname = $_POST['pollname'];
       Poll::insert($Option,$pollname);
           break;
    /*case 'SubmitVote':
        if(isset($_POST['poll_option_id']))
        {
        //echo "<span>You have selected :<b> ".$_POST['pollValue']."</b></span>";
          $poll_option_id = $_POST['poll_option_id'];
          $poll_id = $_POST['poll_id'];
           Poll::saveVote($poll_option_id, $poll_id);
        exit;
        }
        else{
             echo "<span>Please choose any radio button.</span>";
        exit;
    }
    break*/
    }
};

if (isset($_POST['optionName']))
{
    $poll_id = $_POST['poll_id'];
    $poll_option_id = $_POST['myvote'];
     Poll::saveVote($poll_option_id, $poll_id);
    // Poll::insert($Option,$pollname);

}

?>
