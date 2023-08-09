<?php
session_start();
if(isset($_POST['logoutbtn'])){
                        session_destroy();
                        unset($_SESSION['user_session']);
                        unset($_SESSION['user_id']);
                        unset($_SESSION['user_fullname']);
                        header('Location: login.php');
                    }
                    
?>