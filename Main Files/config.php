<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "k!23D!#!23asdasd!23!Ds";
$dbName = "vmassistant";
$connection = mysqli_connect($servername, $dbusername, $dbpassword, $dbName) or trigger_error("Unable to connect to the database");

$dbconfig = mysqli_select_db($connection, $dbName);

if($dbconfig){
    // echo "Database Connected";
}
else{
    echo "Database Connection Failed";
}

?>