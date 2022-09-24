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
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <nav class="navbar">
        <ul>
        <li class="nav-item" ><a href="index.php">Home</a></li>
            <?php
            if (!empty($_SESSION['user_id'])) {
                echo '<li class="nav-item" ><a href="index.php?action=logout">Logout</a></li>';
            }
            ?>
        </ul>
    </nav>