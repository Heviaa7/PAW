<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMBAH MENU</title>
    <style>
        * {font-family: Arial, sans-serif;}
        body{
            background-image: url(home.jpg);
            background-size: cover;
            color: white;
            padding:  0 0 20px 0;
        }
        header h1 {
            text-align: center;
            color: white;
            font-size: 50px;
        }
        .form{
            margin-top: 5%;
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        fieldset{
            width: 500px;
            color: azure;
        }
        legend {font-size: 25px; padding-bottom: 20px; text-align: center;}
        form input{
            width: 120%;
            padding: 5px;
            border: 1px solid #000; /* Tambahkan border */
            margin-bottom: 5px; /* Tambahkan jarak antara elemen input */
        }
        table{
            margin:10% 20% 5% 15%;
            width : 60%;
        }
    </style>
</head>
<body>
    <?php 
    include "navbar.php"; 
    ?><br><br>
    <header>
        <h1>Tambah Menu</h1>
    </header>
    <div class="form">
        <fieldset class="border p-2">
            <form action="" method="post">
            <table>
                <tr>
                    <td>Menu </td>
                    <td><input type="text" name="nama_menu" required></td>
                </tr>

                <tr>
                    <td>Harga</td>
                    <td><input type="number" name="harga_menu" required></td>
                </tr>   
            </table>
            <div class="text-center">
                <button type="submit" class="btn btn-success" name="proses">Simpan</button>
                <button type="button" class="btn btn-danger" onclick="window.location.href = '9_menu.php'">Batal</button>    
            </div><br>
        </form> 
        </fieldset>
    </div>
</body>
</html>

<div class="tambah">
    <?php
    include "koneksi.php";
   
    if(isset($_POST['proses'])){
        $query = "INSERT INTO menu (nama_menu, harga_menu) VALUES ('$_POST[nama_menu]', '$_POST[harga_menu]')";
        if (mysqli_query($koneksi, $query)){
            echo "<script> alert ('Data Menu Baru Berhasil Ditambahkan') </script>";
            echo "<script> window.location.href = '9_menu.php' </script>";
        }
    }
    ?>
</div>
