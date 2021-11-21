<?php
//function connect(){
    $dsn = "localhost";
    $user = "nikita";
    $pass = "4iHnwZ37qu9Ix7<b";

    try {
        $connection = new PDO("mysql:host=$dsn;dbname=id17984224_bank_of_nagpur", $user, $pass);
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    //return $connection;
//}

?>