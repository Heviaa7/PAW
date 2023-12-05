<?php
session_start();
include "koneksi.php";

// pengecekan apakah sudah login atau belum
if (!isset($_SESSION['username'])) {
    echo "<script> window.location.href='login.php' </script>";
}

if ($_SESSION['level'] != 1){
    echo "<script> alert('Anda Tidak Dapat Mengakses Halaman Ini, Karena Anda Bukan Kasir') </script>";
    echo "<script> window.location.href='index_2.php' </script>";
}

// SORTING
// SORTING
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'kode_menu_asc';
$orderBy = '';

if ($sort == 'kode_menu_asc') {
    $orderBy = 'kode_menu ASC';
} elseif ($sort == 'kode_menu_desc') {
    $orderBy = 'kode_menu DESC';
} elseif ($sort == 'nama_menu_asc') {
    $orderBy = 'nama_menu ASC';
} elseif ($sort == 'nama_menu_desc') {
    $orderBy = 'nama_menu DESC';
} elseif ($sort == 'harga_menu_asc') {
    $orderBy = 'harga_menu ASC';
} elseif ($sort == 'harga_menu_desc') {
    $orderBy = 'harga_menu DESC';
}else {
    $orderBy = 'kode_menu ASC';
}

$sql_data = "SELECT * FROM menu ORDER BY $orderBy";
$data = mysqli_query($koneksi, $sql_data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TABEL MENU</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(home.jpg);
            background-size: cover;
            text-align: center;
            padding-bottom: 20px;
        }
        header h1 {
            text-align: center;
            color: white;
            font-size: 50px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        tr:nth-child(even) {background-color: #f2f2f2;}
        tr:nth-child(odd) {background-color: rgb(240, 219, 193);}
        th {
            background-color: #8B4513;
            color: white;
        }
        table, th, td {border: 1px solid #ccc;}
        th, td {padding: 10px;}
        button {
            background-color: #8B4513;
            color: white;
            padding: 10px 20px;
            font-size: 20px;
            border-radius: 10px;
            box-shadow: 5px 5px 10px rgba(230, 221, 221, 0.5);
        }

        .fa-sort-up,
        .fa-sort-down {
            color: black;
        }
    </style>
    <!-- Link icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <br>
    <header>
        <h1>Data Menu</h1>
    </header>
    <div class="container mt-3">
        <div class="col-10 mx-auto">
            <button onclick="window.location.href = '10_tambahMenu.php'">Tambah Menu</button>
            <br><br>
            <table class="text-center">
                <tr>
                    <th class="no">No</th>
                    <th>Kode Menu
                        <?php if(!isset($_GET['sort']) || $_GET['sort'] == "kode_menu_asc") { ?>
                            <a href="?sort=kode_menu_desc"><i class="fas fa-sort-up"></i></a>
                        <?php } else { ?>
                            <a href="?sort=kode_menu_asc"><i class="fas fa-sort-down"></i></a>
                        <?php } ?>
                    </th>
                    <th>Nama Menu 
                        <?php if(!isset($_GET['sort']) || $_GET['sort'] == "nama_menu_asc") { ?>
                            <a href="?sort=nama_menu_desc"><i class="fas fa-sort-up"></i></a>
                        <?php } else { ?>
                            <a href="?sort=nama_menu_asc"><i class="fas fa-sort-down"></i></a>
                        <?php } ?>
                    </th>
                    <th>Harga 
                        <?php if(!isset($_GET['sort']) || $_GET['sort'] == "harga_menu_asc") { ?>
                            <a href="?sort=harga_menu_desc"><i class="fas fa-sort-up"></i></a>
                        <?php } else { ?>
                            <a href="?sort=harga_menu_asc"><i class="fas fa-sort-down"></i></a>
                        <?php } ?>
                    </th>
                    <th>Aksi</th>
                </tr>

                <?php
                include "koneksi.php";
                $no = 1;

                while ($tampil = mysqli_fetch_array($data)) {
                    echo "
                    <tr>
                        <td>$no</td>
                        <td>$tampil[kode_menu]</td>
                        <td>$tampil[nama_menu]</td>
                        <td>Rp " . number_format($tampil['harga_menu'], 0, ',', '.') . "</td>
                        <td><a href='?kode=" . $tampil['kode_menu'] . "' onclick='return confirm(\"Anda yakin akan menghapus Data Menu ini?\")'><button type='button' class='btn btn-danger'>Hapus</button></a>
                        <a href='11_updateMenu.php?kode=" . $tampil['kode_menu'] . "'><button type='button' class='btn btn-success'>Ubah</button></a></td>
                    </tr>";
                    $no++;
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>


<!-- DELETE -->
<?php
include 'koneksi.php';
if (isset($_GET['kode'])){
    $kode = $_GET['kode'];
   
    $sql_cek_pesanan = "SELECT COUNT(*) as jumlah_pesanan FROM order_detil WHERE kode_menu = '$kode'";
    $hasil_cek_pesanan = mysqli_query($koneksi, $sql_cek_pesanan);
    $row_cek_pesanan = mysqli_fetch_assoc($hasil_cek_pesanan);
    $jumlah_pesanan = $row_cek_pesanan['jumlah_pesanan'];

    if ($jumlah_pesanan > 0) {
        echo "<script> alert('Menu ini ada dalam pesanan. Menu Tidak dapat dihapus.')</script>";
        echo "<script> window.location.href='9_menu.php' </script>";
    } else {
        $sql1 = "DELETE FROM menu WHERE kode_menu = '$kode'";
        $hasil1 = mysqli_query($koneksi, $sql1);
        if ($hasil1){
            echo "<script> alert('Data menu berhasil dihapus')</script>";
            echo "<script> window.location.href='9_menu.php' </script>";
        }
    }
}
?>