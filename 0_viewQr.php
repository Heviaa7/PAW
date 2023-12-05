<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
    <style>
        body{background-image: url(home.jpg); background-size: cover;}
        .container_code {
            padding: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .item {
            text-align: center;
            width: calc(33.33% - 10px); /* Adjusted width for three items in a row with some gap */
            margin-bottom: 20px;
        }
        img {
            width: 70%;
            display: block;
            margin: 0 auto; /* Center the image horizontally */
        }
        h4{color: white;}
    </style>
</head>
<body>
    <?php 
    include "koneksi.php";

    if ($_SESSION['level'] == 1){
        include "navbar.php";
    }elseif($_SESSION['level'] == 2){
        include "navbar_2.php";
    }
    ?>
    <div class="container_code">
        <div class="item">
            <img src="meja1.png" alt="Meja 1">
            <h4 class="text-white">Meja 1</h4>
        </div>
        
        <div class="item">
            <img src="meja_2.png" alt="Meja 2">
            <h4 class="text-white">Meja 2</h4>
        </div>
        
        <div class="item">
            <img src="meja_3.png" alt="Meja 3">
            <h4 class="text-white">Meja 3</h4>
        </div>
        
        <div class="item">
            <img src="meja4.png" alt="Meja 4">
            <h4 class="text-white">Meja 4</h4>
        </div>
        
        <div class="item">
            <img src="meja5.png" alt="Meja 5">
            <h4 class="text-white">Meja 5</h4>
        </div>
    </div>
</body>
</html>
