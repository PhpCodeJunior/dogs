<?php
$server = "localhost";
$username = "root";
$password = "";
$db="allaboutdogs";
try {
    $conn = new PDO("mysql:host=$server;dbname=$db",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //echo "connected";
}catch(PDOException $e){
    echo "connection failed".$e->getMessage();
}
?>