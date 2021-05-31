<?php
session_start();
require_once 'api/models.php';
$planObj = new Plan();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Imagery CSS -->
    <link href="assets/css/main.css" rel="stylesheet">
    
    <!--JQuery javascript-->
    <script src="assets/js/jquery.min.js"></script>
    <!--Slick javascript-->
    <script src="assets/slick/slick.min.js"></script>

    <title>Zed Designs</title>
  </head>
  <body>
    <nav class="navbar">
        <ul class="nav">
            <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="plans.php" class="nav-link">Plans</a></li>
        </ul>
    </nav>
