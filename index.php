<?php
    session_start();
    include "koneksi.php";

    if (!isset($_SESSION['username'])) {
        echo "<script> window.location.href='login.php' </script>";
    }

    if ($_SESSION['level'] != 1){
        echo "<script> window.location.href='index_2.php' </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gambar.css">
    <title>HOME</title>
    <style>
        body {
            background-image: url(home.jpg);
            background-size: cover;
            font-family: Arial, sans-serif;
            color: white;
        }
        header h1 {
            padding-top: 10%;
            text-align: center;
            color: white;
            font-size: 50px;
        }
        header h1 span{color: burlywood;}
    </style>
</head>
<body>
    <?php include "navbar.php" ?>
    <header>
        <h1>WELCOME '<span><?= $row_nama['nama'] ?></span>' TO  <br> : HEVIAA RESTO : </h1>
    </header>

    <div class="gambar">
        <img src="ayam.jpg" alt="ayam bakar">
        <img src="ikan.jpg" alt="ikan bakar">
        <img src="sate.jpg" alt="sate ayam">
        <img src="sosis.jpg" alt="sosis bakar">
        <img src="soto.jpg" alt="soto ayam">
    </div>
</body>
</html>