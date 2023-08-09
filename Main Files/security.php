<?php
session_start();
include('config.php');

if($dbconfig){
    //echo "Database Connected";
}
else{
    header("Location: config.php");
}

if(!$_SESSION['user_session']){
    header("Location: login.php");
}
