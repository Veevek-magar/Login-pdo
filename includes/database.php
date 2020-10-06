<?php
    $server='localhost';
    $dbUser='root';
    $dbPass='';
    $db='mydbpdo';
    
    try{
        $conn=new PDO("mysql:host=$server;dbname=$db",$dbUser,$dbPass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
    }catch(PDOException $e){
        echo "Error: ". $e->getMessage();
    }

?>