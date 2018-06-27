<?php
require_once('config.php');
//echo "i am in here "; exit;

    if (isset($_POST['Submit'])){
        $Option = $_POST['options'];
    print_r( $Option);
    echo    $pollname = $_POST['pollName'];
    exit;
    //    echo $poll_id    =    Poll::insert($Option,$pollname); exit;
         header("Location: votePoll.php?id=$poll_id");
}
    else{
         echo "i am out";
         $Option = $_POST['options'];
             print_r($Option);
             echo $pollname = $_POST['pollName'];
     }
?>
