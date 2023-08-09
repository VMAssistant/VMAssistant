<?php
session_start();
if(isset($_POST['logoutbtn'])){
                        session_destroy();
                        unset($_SESSION['admin_session']);
                        header('Location: login.php');
                    }
                    
?>