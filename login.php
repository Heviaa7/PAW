<?php
session_start();
include "koneksi.php";

if(isset($_SESSION['username'])) {
    return header('location:index.php');
}

if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['pswd'];

    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $hasil = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_array($hasil);
    
    if ($row !== null AND $row['username'] == $username AND $row['password'] == $password){
        $_SESSION['level'] = $row['level'];
        $_SESSION['username'] = $username;
        echo "<script> alert('Login Berhasil') </script>";
        echo "<script> window.location.href='index.php' </script>";
    } else {
        $error = true;
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
            padding-top: 9%;
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
            <?php if(isset($error)) {?>
                <div class="alert alert-danger" role="alert">
                    Username or password is incorrect
                </div>
            <?php }?>
            <h2>Login</h2>
            <form method="post">
                <div class="mb-3 mt-3">
                    <input type="username" class="form-control" id="username" placeholder="Username" name="username">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="pwd" placeholder="Password" name="pswd">
                </div>

                <div class="mb-3 mt-3 text-center">
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </div>
            </form><br>
            Belum punya akun? <a href="register.php">Register</a> Now
        </div>
    </div>
</body>
</html>

