<?php
include('security.php');
require_once 'key.php';

if(isset($_POST['check-submitbtn'])){
    $email = $_POST['email_id'];
        $email_query = "SELECT * FROM users WHERE email='$email'";
        $email_query_run = mysqli_query($connection, $email_query);

     if(mysqli_num_rows($email_query_run) > 0){
        echo "Email Exists Already";
     }
    else{
        echo "Email is available";
    }


    }


if(isset($_POST['adduserbtn'])){
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email_query = "SELECT * FROM users WHERE email='$email'";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0){
        $_SESSION['status'] = "Email exists already!";
        $_SESSION['status_code'] = "error"; 
        header('Location: users.php');
}
else{
    $query = "INSERT into users (fullname,email,password,usertype) VALUES ('$fullname', '$email', '$password', 'User')";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['status'] = "User has been added";
        $_SESSION['status_code'] = "success";
        header('Location: users.php');
        }
        else{
            $_SESSION['status'] = "User could not be added";
            $_SESSION['status_code'] = "error";
            header('Location: users.php');
        }
}

}

if(isset($_POST['addadminbtn'])){
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $email_query = "SELECT * FROM users WHERE email='$email'";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0){
        $_SESSION['status'] = "Email exists already!";
        $_SESSION['status_code'] = "error"; 
        header('Location: admins.php');
    }
    else{
    $query = "INSERT into users (fullname,email,password,usertype) VALUES ('$fullname', '$email', '$password', 'Admin')";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
    $_SESSION['status'] = "User has been added";
    $_SESSION['status_code'] = "success";
    header('Location: admins.php');
    }
    else{
        $_SESSION['status'] = "User could not be added";
        $_SESSION['status_code'] = "error";
        header('Location: admins.php');
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
        header('Location: users.php');
    }
    else{

    $query = "UPDATE users set fullname='$fullname', email='$email' WHERE user_id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['status'] = "User has been updated" ;
        $_SESSION['status_code'] = "success"; 
        header('Location: users.php');
    }
else{
    $_SESSION['status'] = "User could not be updated";
    $_SESSION['status_code'] = "error";
    header('Location: users.php');
}
    }

    }

    if(isset($_POST['update_adminbtn'])){
        $id = $_POST['edit_id'];
        $fullname = $_POST['edit_fullname'];
        $email = $_POST['edit_useremail'];

        $email_query = "SELECT * FROM users WHERE email='$email'";
        $email_query_run = mysqli_query($connection, $email_query);
        if(mysqli_num_rows($email_query_run) > 0){
            $_SESSION['status'] = "Email exists already!";
            $_SESSION['status_code'] = "error"; 
            header('Location: admins.php');
        }
        else{

        $query = "UPDATE users set fullname='$fullname', email='$email' WHERE user_id='$id'";
        $query_run = mysqli_query($connection, $query);
    
        if($query_run){
            $_SESSION['status'] = "User has been updated" ;
            $_SESSION['status_code'] = "success"; 
            header('Location: admins.php');
        }
    else{
        $_SESSION['status'] = "User could not be updated";
        $_SESSION['status_code'] = "error";
        header('Location: admins.php');
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
            header('Location: users.php');
        }
    else{
        $_SESSION['status'] = "Password could not be updated";
        $_SESSION['status_code'] = "error";
        header('Location: users.php');
    }
    }
    else{
        $_SESSION['status'] = "Password does not match";
        $_SESSION['status_code'] = "error";
        header('Location: users.php');
    }
    }

    
if(isset($_POST['update_adminpassbtn'])){
    $id = $_POST['edit_id'];
    $pass = $_POST['update_userpass'];
    $confirmpass = $_POST['confirm_userpass'];
    if($pass===$confirmpass){
        $query = "UPDATE users set password='$pass' WHERE user_id='$id'";
        $query_run = mysqli_query($connection, $query);

        if($query_run){
            $_SESSION['status'] = "Password has been updated" ;
            $_SESSION['status_code'] = "success"; 
            header('Location: admins.php');
        }
    else{
        $_SESSION['status'] = "Password could not be updated";
        $_SESSION['status_code'] = "error";
        header('Location: admins.php');
    }
    }
    else{
        $_SESSION['status'] = "Password does not match";
        $_SESSION['status_code'] = "error";
        header('Location: admins.php');
    }
    }

    if(isset($_POST['deletebtn'])){
        $id = $_POST['delete_id'];
            $query = "DELETE FROM users WHERE user_id='$id'";
            $query_run = mysqli_query($connection, $query);
    
            if($query_run){
                $_SESSION['status'] = "User has been deleted" ;
                $_SESSION['status_code'] = "success"; 
                header('Location: users.php');
            }
        else{
            $_SESSION['status'] = "User could not be deleted";
            $_SESSION['status_code'] = "error";
            header('Location: users.php');
        }


        }

        if(isset($_POST['deleteadminbtn'])){
            $id = $_POST['delete_id'];
                $query = "DELETE FROM users WHERE user_id='$id'";
                $query_run = mysqli_query($connection, $query);
        
                if($query_run){
                    $_SESSION['status'] = "User has been deleted" ;
                    $_SESSION['status_code'] = "success"; 
                    header('Location: admins.php');
                }
            else{
                $_SESSION['status'] = "User could not be deleted";
                $_SESSION['status_code'] = "error";
                header('Location: admins.php');
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
$serverconnection = ssh2_connect($server_ip, $server_port);
ssh2_auth_password($serverconnection, $server_username, $server_password);
$stream = ssh2_exec($serverconnection, '/home/vmassistant/uninstall.sh');
stream_set_blocking($stream, true);
$output = stream_get_contents($stream);
fclose($stream);
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

        if(isset($_POST['loginbtn'])){
            $login_email = $_POST['input_email'];
            $login_password = $_POST['input_password'];
                $query = "SELECT * FROM users WHERE email='$login_email' AND password='$login_password' AND usertype='Admin'";
                $query_run = mysqli_query($connection, $query);
        
                if(mysqli_fetch_array($query_run)){
                    $query_id = "SELECT user_id FROM users WHERE email='$login_email' AND password='$login_password' AND usertype='Admin'";
                    $query_id_run = mysqli_query($connection, $query_id);
                    $user_id = mysqli_fetch_array($query_id_run);
                    $_SESSION['admin_id'] = $user_id[0];
                    $_SESSION['admin_session'] = $login_email;
                    header('Location: index.php');
                }
            else{
                $_SESSION['status'] = "Incorrect Login Details";
                $_SESSION['status_code'] = "error";
                header('Location: login.php');
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
                    $ivlen = openssl_cipher_iv_length($cipher);
                    $iv = openssl_random_pseudo_bytes($ivlen);
                    $ciphertext = openssl_encrypt($server_password, $cipher, $key, $options, $iv);
                    $server_password = $ciphertext;
                   $query = "INSERT into servers (server_name,ip_address,server_os,username,password,port,iv,user_id) VALUES ('$server_name', '$server_ip', '$server_os', '$server_username', '$server_password', '$server_port', '$iv', '".$_SESSION['admin_id']."')";
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

?>
