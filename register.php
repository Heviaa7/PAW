<?php
include "koneksi.php";

if(isset($_POST['register'])){
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];
    $password = $_POST['pswd'];
    $confirm = $_POST['confirm_pswd'];

    if($password == $confirm){
        $sql1 = "SELECT username FROM user WHERE username = '$username'";
        $query1 = mysqli_query($koneksi, $sql1);
        $hasil = mysqli_fetch_array($query1);
        if($hasil != 0){
            echo "<script> alert('Register Gagal! Username Sudah Dipakai Pihak Lain! Silahkan Register Ulang!') </script>";
            echo "<script> window.location.href='register.php' </script>";
        }else{
            $sql2 = "INSERT INTO user VALUES (NULL, '$username', '$nama', '$password', '$hp', '$alamat', 2)";
            $query2 = mysqli_query($koneksi, $sql2);
            if($query2){
                echo "<script> alert('Register Berhasil, Silahkan Login Untuk Menuju Halaman Resto') </script>";
                echo "<script> window.location.href='login.php' </script>";
            }
        }
    }else{
        echo "<script> alert('Register Gagal! Konfirmasi Password Anda Tidak Cocok! Silahkan Register Ulang!') </script>";
        echo "<script> window.location.href='register.php' </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>LOGIN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-image: url('login.jpg');
            background-size: cover;
            display: flex;
            justify-content: flex-start;
        }
        .container {
            padding-top: 5%;
            padding-bottom: 5%;
        }
        .col-4 {
            background-color: rgba(255, 255, 255, 0.3);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            text-align: center;
            margin-bottom: 30px;
            color: black;
            font-weight: bold;
        }
        .form-control {
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container mt-3">
        <div class="col-4"> 
            <h2>Register</h2>
            <form action="" method="post">
                <div class="mb-3 mt-3">
                    <input type="nama" class="form-control" id="nama" placeholder="Nama Lengkap" name="nama">
                </div>
                <div class="mb-3 mt-3">
                    <input type="username" class="form-control" id="username" placeholder="Username" name="username">
                </div>
                <div class="mb-3 mt-3">
                    <input type="number" class="form-control" id="hp" placeholder="Nomor HP" name="hp">
                </div>
                <div class="mb-3 mt-3">
                    <input type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="pwd" placeholder="Password" name="pswd">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="pwd" placeholder="Konfirmasi Password" name="confirm_pswd">
                </div>

                <div class="mb-3 mt-3 text-center">
                    <button type="submit" class="btn btn-primary" name="register">Register</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

