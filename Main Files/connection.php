<?php
include('security.php');
require_once 'key.php';


$server_query = "SELECT * FROM servers WHERE server_id='$server_id'";
$server_query_run = mysqli_query($connection, $server_query);
$output = mysqli_fetch_array($server_query_run);

$server_ip = $output[2];
$server_username = $output[4];
$server_password = $output[5];
                   // Perform decryption of password here
                   $cipher = "aes-256-cbc";
                   $options = 0;
                   $iv = $output[7];
                   $decrypted = openssl_decrypt($server_password, $cipher, $key, $options, $iv);
                   $server_password = $decrypted;
                   //End decryption here
$server_port = $output[6];

$server_connection = ssh2_connect($server_ip, $server_port);
ssh2_auth_password($server_connection, $server_username, $server_password);
?>