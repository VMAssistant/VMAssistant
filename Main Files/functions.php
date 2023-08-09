<?php
include('security.php');
require_once 'key.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

        if(isset($_POST['userloginbtn'])){
            $login_email = $_POST['input_email'];
            $login_password = $_POST['input_password'];
                $query = "SELECT * FROM users WHERE email='$login_email' AND password='$login_password' AND usertype='User'";
                $query_run = mysqli_query($connection, $query);

                // Find ID
                $query_id = "SELECT user_id  FROM users WHERE email='$login_email' AND password='$login_password' AND usertype='User'";
                $query_id_run = mysqli_query($connection, $query_id);
                $user_id = mysqli_fetch_array($query_id_run);

                // Find the full name

                $query_name = "SELECT fullname  FROM users WHERE email='$login_email' AND password='$login_password' AND usertype='User'";
                $query_name_run = mysqli_query($connection, $query_name);
                $full_name = mysqli_fetch_array($query_name_run);


        
                if(mysqli_fetch_array($query_run)){
                    $_SESSION['user_fullname'] = $full_name[0];
                    $_SESSION['user_session'] = $login_email;
                                    // Find ID
                $query_id = "SELECT user_id FROM users WHERE email='$login_email' AND password='$login_password' AND usertype='User'";
                $query_id_run = mysqli_query($connection, $query_id);
                $user_id = mysqli_fetch_array($query_id_run);
                $_SESSION['user_id'] = $user_id[0];
                    header('Location: index.php');
                }
            else{
                $_SESSION['status'] = "Incorrect Login Details";
                $_SESSION['status_code'] = "error";
                header('Location: login.php');
            }
            
            }


            if(isset($_POST['registerbtn'])){
                $fullname = $_POST['register_fullname'];
                $email = $_POST['register_email'];
                $password = $_POST['register_password'];
                $confirmpassword = $_POST['register_confirmpassword'];
                $email_query = "SELECT * FROM users WHERE email='$email'";
                $email_query_run = mysqli_query($connection, $email_query);
                if(mysqli_num_rows($email_query_run) > 0){
                    $_SESSION['status'] = "Email exists already!";
                    $_SESSION['status_code'] = "error"; 
                    header('Location: register.php');
            }
            else{

            if($password===$confirmpassword){
                $query = "INSERT into users (fullname,email,password,usertype) VALUES ('$fullname', '$email', '$password', 'User')";
                $query_run = mysqli_query($connection, $query);
            
                if($query_run){
                $_SESSION['status'] = "Your account has been created. You can login now!";
                $_SESSION['status_code'] = "success";
                header('Location: login.php');
                }
                else{
                    $_SESSION['status'] = "Your account could not be created, please contact support.";
                    $_SESSION['status_code'] = "error";
                    header('Location: register.php');
                }
            }
            else{
                $_SESSION['status'] = "Your password did not match, please try again";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');
            }
            
            }
            }

            if(isset($_POST['update_btn'])){
                $id = $_POST['edit_id'];
                $fullname = $_POST['edit_fullname'];
                $email = $_POST['edit_useremail'];
            
                $email_query = "SELECT * FROM users WHERE email='$email'";
                $email_query_run = mysqli_query($connection, $email_query);
                if(mysqli_num_rows($email_query_run) > 0){
                    $_SESSION['status'] = "Email exists already!";
                    $_SESSION['status_code'] = "error"; 
                    header('Location: profile.php');
                }
                else{
            
                $query = "UPDATE users set fullname='$fullname' WHERE user_id='$id'";
                $query_run = mysqli_query($connection, $query);
            
                if($query_run){
                    $_SESSION['status'] = "User has been updated" ;
                    $_SESSION['status_code'] = "success"; 
                    header('Location: profile.php');
                }
            else{
                $_SESSION['status'] = "User could not be updated";
                $_SESSION['status_code'] = "error";
                header('Location: profile.php');
            }
                }
            
                }

                if(isset($_POST['update_passbtn'])){
                    $id = $_POST['edit_id'];
                    $pass = $_POST['update_userpass'];
                    $confirmpass = $_POST['confirm_userpass'];
                    if($pass===$confirmpass){
                        $query = "UPDATE users set password='$pass' WHERE user_id='$id'";
                        $query_run = mysqli_query($connection, $query);
                
                        if($query_run){
                            $_SESSION['status'] = "Password has been updated" ;
                            $_SESSION['status_code'] = "success"; 
                            header('Location: profile.php');
                        }
                    else{
                        $_SESSION['status'] = "Password could not be updated";
                        $_SESSION['status_code'] = "error";
                        header('Location: profile.php');
                    }
                    }
                    else{
                        $_SESSION['status'] = "Password does not match";
                        $_SESSION['status_code'] = "error";
                        header('Location: profile.php');
                    }
                    }

                    if(isset($_POST['addserverbtn'])){
                        $server_name = $_POST['server-name'];
                        $server_ip = $_POST['server-ip'];
                        $server_os = $_POST['server-os'];
                        $server_username = $_POST['server-username'];
                        $server_password = $_POST['server-password'];
                        $server_port = $_POST['server-port'];
                    
                        $email_query = "SELECT * FROM servers WHERE ip_address='$server_ip'";
                        $email_query_run = mysqli_query($connection, $email_query);
                        if(mysqli_num_rows($email_query_run) > 0){
                            $_SESSION['status'] = "Server exists already!";
                            $_SESSION['status_code'] = "error"; 
                            header('Location: servers.php');
                    }
                    else{
                        $serverconnection = ssh2_connect($server_ip, $server_port);
                        if(!$serverconnection){
                            $_SESSION['status'] = "No connection";
                            $_SESSION['status_code'] = "error"; 
                            header('Location: servers.php');
                        }
                        else{
                            if(!ssh2_auth_password($serverconnection, $server_username, $server_password)){   
                                $_SESSION['status'] = "Wrong Details";
                                $_SESSION['status_code'] = "error"; 
                                header('Location: servers.php');
                    }
                        else{
                            ssh2_auth_password($serverconnection, $server_username, $server_password);

                            $tries = 0;
                            $maxTries = 3;
                            while($tries < $maxTries) {
                                $stream1 = ssh2_exec($serverconnection, 'apt-get install -y wget || yum install -y wget || dnf install -y wget >> /root/vmassistant.log 2>&1');
                                if($stream1 === false) {
                                    $tries++;
                                    continue;
                                } else {
                                    stream_set_blocking($stream1, true);
                                    fread($stream1, 8192);
                                    fclose($stream1);
                                    break;
                                }
                            }
                            
                            if($tries == $maxTries) {
                                $_SESSION['status'] = "Could not download auto-deploy script";
                                $_SESSION['status_code'] = "error";
                                 header('Location: servers.php');
                                 exit;
                            }
                            $tries = 0;
                            while($tries < $maxTries) {
                                $stream2 = ssh2_exec($serverconnection, 'wget http://45.41.204.131/vmassistant.sh >> /root/vmassistant.log 2>&1');
                                if($stream2 === false) {
                                    $tries++;
                                    continue;
                                } else {
                                    stream_set_blocking($stream2, true);
                                    fread($stream2, 8192);
                                    fclose($stream2);
                                    break;
                                }
                            }
                            
                            if($tries == $maxTries) {
                                $_SESSION['status'] = "Could not download auto-deploy script";
                                $_SESSION['status_code'] = "error";
                                 header('Location: servers.php');
                                 exit;
                            }
                            
                            $tries = 0;
                            while($tries < $maxTries) {
                                $stream3 = ssh2_exec($serverconnection, 'chmod +x vmassistant.sh >> /root/vmassistant.log 2>&1');
                                if($stream3 === false) {
                                    $tries++;
                                    continue;
                                } else {
                                    stream_set_blocking($stream3, true);
                                    fread($stream3, 8192);
                                    fclose($stream3);
                                    break;
                                }
                            }
                            
                            if($tries == $maxTries) {
                                $_SESSION['status'] = "Could not provide permission to auto deploy script";
                                $_SESSION['status_code'] = "error";
                                 header('Location: servers.php');
                                 exit;
                            }
                            
                            $tries = 0;
                            while($tries < $maxTries) {
                                $stream4 = ssh2_exec($serverconnection, './vmassistant.sh >> /root/vmassistant.log 2>&1');
                                if($stream4 === false) {
                                    $tries++;
                                    continue;
                                } else {
                                    stream_set_blocking($stream4, true);
                                    fread($stream4, 8192);
                                    fclose($stream4);
                                    break;
                                }
                            }
                            
                            if($tries == $maxTries) {
                                $_SESSION['status'] = "Could not run auto-deploy script";
                                $_SESSION['status_code'] = "error";
                                 header('Location: servers.php');
                                 exit;
                            }


                            $cipher = "aes-256-cbc";
                            $options = 0;
                          //  $ivlen = openssl_cipher_iv_length($cipher);
                          // $iv = openssl_random_pseudo_bytes($ivlen);
                         // $ivlen = 16;
                          //$iv = random_bytes($ivlen);
                            $iv = "a&d!sDc5#sA1@#ak"; // static 16-byte IV
                            $ciphertext = openssl_encrypt($server_password, $cipher, $key, $options, $iv);
                            echo $ciphertext;
                            $server_password = $ciphertext;
                           $query = "INSERT into servers (server_name,ip_address,server_os,username,password,port,iv,user_id) VALUES ('$server_name', '$server_ip', '$server_os', '$server_username', '$server_password', '$server_port', '$iv', '".$_SESSION['user_id']."')";
                           $query_run = mysqli_query($connection, $query);
                            if($query_run){
                                $_SESSION['status'] = "Server has been added";
                                $_SESSION['status_code'] = "success";
                                 header('Location: servers.php');
                                    }
                                else{

                                    $_SESSION['status'] = "Servers could not be added";
                                    $_SESSION['status_code'] = "error";
                                    header('Location: servers.php');
                                }
                        }
                    }
                    
                }
        
            }


            if(isset($_POST['deleteserverbtn'])){
                $id = $_POST['delete_serverid'];

                $server_query = "SELECT * FROM servers WHERE server_id='$id'";
                $server_query_run = mysqli_query($connection, $server_query);
                $output = mysqli_fetch_array($server_query_run);

                if($server_query_run){
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
                }
                $serverconnection = ssh2_connect($server_ip, $server_port);
                if(!$serverconnection){
                    $_SESSION['status'] = "No connection";
                    $_SESSION['status_code'] = "error"; 
                   header('Location: servers.php');
                }
                else{
                    if(!ssh2_auth_password($serverconnection, $server_username, $server_password)){   
                        $_SESSION['status'] = "Wrong Details";
                        $_SESSION['status_code'] = "error"; 
                        header('Location: servers.php');
            }
                else{

// Connect to the remote machine using ssh2_connect
$serverconnection = ssh2_connect($server_ip, $server_port);
ssh2_auth_password($serverconnection, $server_username, $server_password);

// Execute the bash script
$stream = ssh2_exec($serverconnection, '/home/vmassistant/uninstall.sh');

// Capture the output of the script
stream_set_blocking($stream, true);
$output = stream_get_contents($stream);

// Close the stream
fclose($stream);

// Check the output of the script
if(strpos(trim($output),"Success") !== false ){
    $query = "DELETE FROM servers WHERE server_id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['status'] = "Server has been deleted" ;
        $_SESSION['status_code'] = "success"; 
        header('Location: servers.php');
    }
    else{
        $_SESSION['status'] = "Server could not be deleted";
        $_SESSION['status_code'] = "error";
        header('Location: servers.php');
    }
} else {
    
    $query = "DELETE FROM servers WHERE server_id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['status'] = "Server has been deleted but could not remove auto deploy scripts." ;
        $_SESSION['status_code'] = "success"; 
        header('Location: servers.php');
    }
else{
    $_SESSION['status'] = "Server could not be deleted";
    $_SESSION['status_code'] = "error";
    header('Location: servers.php');
}
}


                }
            }
                

        
        
                }

                // This is where all the automation for utilities are done
                if(isset($_POST['update-serverpackages'])){
                    $id = $_POST['utilityserver_id'];
                    $server_query = "SELECT * FROM servers WHERE server_id='$id'";
                    $server_query_run = mysqli_query($connection, $server_query);
                    $output = mysqli_fetch_array($server_query_run);
                    if($server_query_run){
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
                    }



                    $serverconnection = ssh2_connect($server_ip, $server_port);
                    if(!$serverconnection){
                        $_SESSION['status'] = "No connection";
                        $_SESSION['status_code'] = "error"; 
                       header('Location: utilities.php');
                    }
                    else{
                        if(!ssh2_auth_password($serverconnection, $server_username, $server_password)){   
                            $_SESSION['status'] = "Wrong Details";
                            $_SESSION['status_code'] = "error"; 
                            header('Location: utilities.php');
                }
                    else{

// Connect to the remote machine using ssh2_connect
$serverconnection = ssh2_connect($server_ip, $server_port);
ssh2_auth_password($serverconnection, $server_username, $server_password);

// Execute the bash script
$stream = ssh2_exec($serverconnection, '/home/vmassistant/serverupdate.sh');

// Capture the output of the script
stream_set_blocking($stream, true);
$output = stream_get_contents($stream);

// Close the stream
fclose($stream);

// Check the output of the script
if(strpos(trim($output),"Success") !== false ){
    $_SESSION['status'] = "Server updated successfully";
    $_SESSION['status_code'] = "success"; 
    header('Location: utilities.php');
} else {
    $_SESSION['status'] = "Server could not be updated";
    $_SESSION['status_code'] = "error"; 
    header('Location: utilities.php');
}


                    }
                }
                
            }


            if(isset($_POST['reboot-server'])){
                $id = $_POST['utilityserver_id'];
                $server_query = "SELECT * FROM servers WHERE server_id='$id'";
                $server_query_run = mysqli_query($connection, $server_query);
                $output = mysqli_fetch_array($server_query_run);
                if($server_query_run){
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
                }



                $serverconnection = ssh2_connect($server_ip, $server_port);
                if(!$serverconnection){
                    $_SESSION['status'] = "No connection";
                    $_SESSION['status_code'] = "error"; 
                   header('Location: utilities.php');
                }
                else{
                    if(!ssh2_auth_password($serverconnection, $server_username, $server_password)){   
                        $_SESSION['status'] = "Wrong Details";
                        $_SESSION['status_code'] = "error"; 
                        header('Location: utilities.php');
            }
                else{

// Connect to the remote machine using ssh2_connect
$serverconnection = ssh2_connect($server_ip, $server_port);
ssh2_auth_password($serverconnection, $server_username, $server_password);

// Execute the bash script
$stream = ssh2_exec($serverconnection, 'reboot');

// Capture the output of the script
stream_set_blocking($stream, true);
$output = stream_get_contents($stream);

// Close the stream
fclose($stream);
sleep(5);

$_SESSION['status'] = "Server rebooted successfully";
$_SESSION['status_code'] = "success"; 
header('Location: utilities.php');


                }
            }
            
        }


                        // Speed Test Utility
                        if(isset($_POST['server-speedtest'])){
                            $id = $_POST['utilityserver_id'];
                            $server_query = "SELECT * FROM servers WHERE server_id='$id'";
                            $server_query_run = mysqli_query($connection, $server_query);
                            $output = mysqli_fetch_array($server_query_run);
                            if($server_query_run){
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
                            }
        
        
        
                            $serverconnection = ssh2_connect($server_ip, $server_port);
                            if(!$serverconnection){
                                $_SESSION['status'] = "No connection";
                                $_SESSION['status_code'] = "error"; 
                               header('Location: utilities.php');
                            }
                            else{
                                if(!ssh2_auth_password($serverconnection, $server_username, $server_password)){   
                                    $_SESSION['status'] = "Wrong Details";
                                    $_SESSION['status_code'] = "error"; 
                                    header('Location: utilities.php');
                        }
                            else{
        
        // Connect to the remote machine using ssh2_connect
        $serverconnection = ssh2_connect($server_ip, $server_port);
        ssh2_auth_password($serverconnection, $server_username, $server_password);
        
        // Execute the bash script
        $stream = ssh2_exec($serverconnection, '/home/vmassistant/speedtest.sh');
        
        // Capture the output of the script
        stream_set_blocking($stream, true);
        $output = stream_get_contents($stream);
        
        // Close the stream
        fclose($stream);
        
// Check if the URL was generated
if (strpos($output, 'http://www.speedtest.net/result/') !== false) {
    $url = trim($output);
    header("Location: $url");
} else {
    $_SESSION['status'] = "Failed to generate speed test result URL";
    $_SESSION['status_code'] = "error"; 
    header('Location: utilities.php');
}


        
                            }
                        }
                        
                    }

            // VPN server installation

            if(isset($_POST['addvpnuserbtn'])){
                $server_id = $_POST['utility_serverid'];
                $vpn_username = $_POST['vpn-username'];
                $server_query = "SELECT * FROM servers WHERE server_id='$server_id'";
                $server_query_run = mysqli_query($connection, $server_query);
                $output = mysqli_fetch_array($server_query_run);
                if(empty($output)){
                    $_SESSION['status'] = "An unexpected error has occurred";
                    $_SESSION['status_code'] = "error"; 
                    header('Location: apps.php');
                }
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
                if(ssh2_auth_password($server_connection, $server_username, $server_password)){
                    $stream = ssh2_exec($server_connection, 'cd /home/vmassistant && ./installvpn.sh '.$vpn_username);
                    stream_set_blocking($stream, true);
                    $load = stream_get_contents($stream);
                    fclose($stream);
                    $url = preg_match("/http:\/\/.*\.ovpn/", $load, $matches);
                    if(count($matches)>0){
                        $url = $matches[0];
                        header("Location: $url");
                        exit();
                    }else{
                        $_SESSION['status'] = "An issue occurred in the installation process";
                        $_SESSION['status_code'] = "error"; 
                        header('Location: apps.php');
                    }
                }else{
                    $_SESSION['status'] = "Failed to authenticate to the server";
                    $_SESSION['status_code'] = "error"; 
                    header('Location: apps.php');
                }
            }

            // RDP Installation

            if(isset($_POST['installrdpbtn'])){
                $server_id = $_POST['rdp_serverid'];
                $server_query = "SELECT * FROM servers WHERE server_id='$server_id'";
                $server_query_run = mysqli_query($connection, $server_query);
                $output = mysqli_fetch_array($server_query_run);
                if(empty($output)){
                    $_SESSION['status'] = "An unexpected error has occurred!";
                    $_SESSION['status_code'] = "error"; 
                    header('Location: apps.php');
                }
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
                if(ssh2_auth_password($server_connection, $server_username, $server_password)){
                    $stream = ssh2_exec($server_connection, 'nohup /home/vmassistant/installrdpnew.sh >/dev/null 2>&1 &');
                    stream_set_blocking($stream, true);
                    $rdpload = stream_get_contents($stream);
                    fclose($stream);
                    //$newoutput = trim($rdpload);
                                            $_SESSION['status'] = "Please connect to RDP after 10 minutes";
                        $_SESSION['status_code'] = "success"; 
                        header('Location: apps.php');
                    // if(preg_match('/Success/', $newoutput)) {
                    //     $_SESSION['status'] = "RDP has been installed successfully! Use RDP and your server login details to connect.";
                    //     $_SESSION['status_code'] = "success"; 
                    //     header('Location: apps.php');
                    // } else if(preg_match('/Error|This script only runs on Ubuntu or Redhat based Linux distributions/', $newoutput)) {
                    //     $_SESSION['status'] = "An error has occurred";
                    //     $_SESSION['status_code'] = "error"; 
                    //     header('Location: apps.php');
                    // }
                }else{
                    echo "Error Occured: Could not authenticate";
                }
            }



                        // FTP server installation

                        if(isset($_POST['addftpuserbtn'])){
                            $server_id = $_POST['utility_serverid'];
                            $ftp_username = $_POST['ftp-username'];
                            $ftp_password = $_POST['ftp-password'];
                            $ftp_directory = $_POST['ftp-directory'];
                            $server_query = "SELECT * FROM servers WHERE server_id='$server_id'";
                            $server_query_run = mysqli_query($connection, $server_query);
                            $output = mysqli_fetch_array($server_query_run);
                            if(empty($output)){
                                $_SESSION['status'] = "An unexpected error has occurred";
                                $_SESSION['status_code'] = "error"; 
                                header('Location: apps.php');
                            }
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
                            if(ssh2_auth_password($server_connection, $server_username, $server_password)){
                                $stream = ssh2_exec($server_connection, 'cd /home/vmassistant && ./installftp.sh '.$ftp_username.' '.$ftp_password.' '.$ftp_directory);
                                stream_set_blocking($stream, true);
                                $ftpload = stream_get_contents($stream);
                                fclose($stream);
                                $ftpoutput = trim($ftpload);
                                if(preg_match('/Success/', $ftpoutput)) {
                                    $_SESSION['status'] = "FTP User has been added successfully! Use FTP Client to access using the details you have entered.";
                                    $_SESSION['status_code'] = "success"; 
                                    header('Location: apps.php');
                                } else if(preg_match('/Error/', $ftpoutput)) {
                                    $_SESSION['status'] = "An error has occurred";
                                    $_SESSION['status_code'] = "error"; 
                                    header('Location: apps.php');
                                }
                                else{
                                    $_SESSION['status'] = "An issue occurred in the installation process";
                                    $_SESSION['status_code'] = "error"; 
                                    header('Location: apps.php');
                                }
                            }
                            
                            else{
                                $_SESSION['status'] = "Failed to authenticate to the server";
                                $_SESSION['status_code'] = "error"; 
                                header('Location: apps.php');
                            }
                        }

?>
