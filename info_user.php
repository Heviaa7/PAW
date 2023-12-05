<?php

include "koneksi.php";
session_start();

$username = $_SESSION['username'];

$sql = "SELECT * FROM user WHERE username = '$username'";
$hasil = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_array($hasil);
?>

<!DOCTYPE html>
<html>
<head>
    <title>INFO USER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style> 
        body{
            background-image: url(login.jpg);
            background-size: cover;
        }
        .container1{
            align-content: center;
            margin: 0 auto;
            padding-left: 38%;
            text-align: center;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
        .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: 40%;
        align-items: center;
        }

        header h2{
            text-align:center; 
            color: white;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
        .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        .container {
        padding: 2px 16px;
        }
    </style>
</head>
<body>
    <?php 
        if ($row['level'] == 1){
            include "navbar.php";
        } elseif ($row['level'] == 2){
            include "navbar_2.php";
        }
    ?>
    <br>
    <header>
        <h2>Profil Anda</h2>
    </header><br>
    <div class="container1">
        <div class="card">
            <img src="avatar2.png" alt="Avatar" style="width:70%">
            <div class="container"><br>
                <h4><b><?= $row['nama'] ?></b></h4> 
                <p><?php
                    if ($row['level'] == 1){
                        echo "Kasir";
                    } elseif ($row['level'] == 2){
                        echo "Guest";
                    } ?></p> 
                <p><?= $row['alamat'] ?></p> 
                <p><?= $row['hp'] ?></p> 
                <p>Your Password : <?= $row['password'] ?></p>
            </div>
        </div>
    </div>
</body>
</html> 
