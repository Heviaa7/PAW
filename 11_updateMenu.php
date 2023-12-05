<?php
    session_start();
    include "koneksi.php";
    $sql = mysqli_query($koneksi, "select * from menu where kode_menu = '$_GET[kode]'");
    $data = mysqli_fetch_array($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE MENU</title>
    <style>
        * {font-family: Arial, sans-serif;}
        body{
            background-image: url(home.jpg);
            color: white;
            padding:  0 0 20px 0;
            background-size: cover;
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
    <?php include "navbar.php"; ?><br><br>
    <header>
        <h1>Update Menu</h1>
    </header>
    <div class="form">
        <fieldset class="border p-2">
        <form action="" method="post">
            <table>
                <tr>
                    <td>Menu</td>
                    <td><input type="text" name="nama_menu" value = "<?php echo $data['nama_menu']; ?>"></td>
                </tr>

                <tr>
                    <td>Harga</td>
                    <td><input type="text" name="harga_menu" value = "<?php echo $data['harga_menu']; ?>"></td>
                </tr>
            </table>
            <div class="text-center">
                <button type="submit" class="btn btn-success" name="proses">Update</button>
                <button type="button" class="btn btn-danger" onclick="window.location.href = '9_menu.php'">Batal</button> 
            </div><br>
        </form> 
        </fieldset>
    </div>
</body>
</html>

<div class="sukses">
    <?php
    include "koneksi.php";

    if(isset($_POST['proses'])){
        mysqli_query($koneksi, "update menu set
        nama_menu = '$_POST[nama_menu]',
        harga_menu = '$_POST[harga_menu]'
        where kode_menu = '$_GET[kode]'");

        echo "<script> alert ('Data Menu Berhasil Diupdate') </script>";
        echo "<script> window.location.href = '9_menu.php' </script>";
    }
    ?>
</div>