<?php
include "koneksi.php";

$username = $_SESSION['username'];
$sql_nama = "SELECT nama FROM user WHERE username = '$username'";
$query_nama = mysqli_query($koneksi, $sql_nama);
$row_nama = mysqli_fetch_array($query_nama);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i data-feather="copy"></i>  Heviaa Resto Order</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="9_menu.php">Menu</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Pesan</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="1_pesan.php">Pesan Biasa</a></li>
                        <li><a class="dropdown-item" href="0_viewQr.php">Pesan Via Code</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Order Detil</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="5_dataOrder.php">Order Aktive</a></li>
                        <li><a class="dropdown-item" href="12_Sselesai.php">Order Selesai</a></li>
                        <li><a class="dropdown-item" href="1_pesan.php">Tambah Order</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="container-fluid d-flex justify-content-between">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"> <?= $row_nama['nama'] ?>/Kasir</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
            <a href="info_user.php" class="navbar-brand">
                <img src="avatar1.png" alt="Logo" style="width:40px;" class="rounded-pill">
            </a>
        </ul>
    </div>
    </nav>
    <script>
        feather.replace();
    </script>
</body>
</html>