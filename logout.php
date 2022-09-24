<?php 
session_start();
if($_SESSION['admin_user_name']){
    session_destroy();
    header("location: admin.php");
}else{
    session_destroy();
    header("location: login.php");
}


?>