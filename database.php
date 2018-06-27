<?php
class Database {

    public static $host = "localhost";
    public static $dbname= "mydb";
    public static $username = "root";
    public static $password = "";

    public static function connect(){
        $pdo  =  new  PDO("mysql:host=".self::$host.";dbname=".self::$dbname.";charset=utf8", self::$username, self::$password );
        $pdo->setAttribute(PDO::ATTR_ERRMODE,  PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function query($query, $params = array()){
        $statement  = self::connect()->prepare($query);
        $statement->execute($params);
        if(explode('  ',  $query[0] == 'SELECT')){
            $data  =  $statement->fetchAll();
            return $data;
        }
    }
    public static function query1($query, $params = array()){
        $statement  = self::connect()->prepare($query);
        //$statement->execute($params);
           if(explode('  ',  $query[0] == 'INSERT')){
                // start transaction
                self::connect()->beginTransaction();
                foreach($params as &$row) {
              $statement->execute($row);
           }
            // end transaction
            // self::connect()->commit();
        }
        return "Data insert successfully <br/>";
    }
         public static function query2($query){
         $statement  = self::connect();
         $statement->exec($query);
           $last_id = $statement->lastInsertId();
           return $last_id;
    }
     public static function query3($query){
        $statement  = self::connect()->prepare($query);
        // $statement->bindParam(':name', $pollid);
        //$statement  = self::connect();
        //$statement->exec($query);
        // $statement->exec();
         //$result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //$res = $dbo->prepare($sql);
        $statement->execute();
    return    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
}
public static function updateVote($query){
   $statement  = self::connect()->prepare($query);
   $statement->execute();
   //$last_id = $statement->LAST_INSERT_ID();
   //return $last_id;
   return  "count updated by 1";
}

}

?>
