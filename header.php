<?php
session_start();
require_once('functions.php');



?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container pb-5 " > 
    <nav class="navbar navbar-expand-md float-end">
        <ul class="nav justify-content-end">
            
                <?php 
                if(!empty($_SESSION['admin_user_name'])){
                    echo '<li class="nav-item"><a class="nav-link" href="admin.php">Admin Home</a></li>';
                }else{
                    echo '<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                          <li class="nav-item"> notifications  </li>';
                }

            if (!empty($_SESSION['user_id'])) {
                
                echo '<li class="nav-item" >
                    <a  class="nav-link" href="logout.php">Logout</a></li>';
            }
            ?>
        </ul>
    </nav>
    </div>
    <hr>