 <?php
 "<form action='' method='post'>
  <h3>".$pollname."</h3>";
  foreach($sqr as $row){
      foreach($row as $key => $val){
        "<div><input name='optionName' type='radio' value=". $val.optionID.">".$val.optionName."</div>";
    }
  }
  "<input type='submit' name='submit'  value='Submit Vote' />
  <input type='hidden' name='pollD' vale=".$pollid."> </form>"
?>
