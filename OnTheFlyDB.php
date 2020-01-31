<?php
$host = "localhost";
$dbname = "airplane";
$user = "root";
$password = "";
try{

    $con = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);

} catch(PDOException $ex){

    echo "Verbinding mislukt: $ex";
}
?>