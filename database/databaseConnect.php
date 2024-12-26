<?php 
$server = "localhost";
$username = "root";
$password = "";
$dbName = "banck";
try{
$conn = new PDO("mysql:host=$server;dbname=$dbName", $username, $password);
}catch(PDOException){
    echo "Connection failed"; 
    
}

?> 