<?php
session_start();
include "koneksi.php";

if ($_SESSION['level'] == 1){
    // MEMBUAT PAGINATION
    $batas = 5;
    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
    $previous = $halaman - 1;
    $next = $halaman + 1;
    $data = mysqli_query($koneksi, "SELECT * FROM `order` WHERE status = 'proses' ");
    $jumlah_data = mysqli_num_rows($data);
    $total_halaman = ceil($jumlah_data / $batas);
    $hasil = mysqli_query($koneksi,  "SELECT * FROM `order` WHERE status = 'proses'  limit $halaman_awal, $batas");
    $no = $halaman_awal+1;
    
    // SORTING
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'kode_order_asc';
    $orderBy = '';
    
    if ($sort == 'kode_order_asc') {
        $orderBy = 'kode_order ASC';
    } elseif ($sort == 'kode_order_desc') {
        $orderBy = 'kode_order DESC';
    } elseif ($sort == 'tanggal_asc') {
        $orderBy = 'tanggal ASC';
    } elseif ($sort == 'tanggal_desc') {
        $orderBy = 'tanggal DESC';
    } elseif ($sort == 'jam_asc') {
        $orderBy = 'jam ASC';
    } elseif ($sort == 'jam_desc') {
        $orderBy = 'jam DESC';
    }elseif ($sort == 'pelayan_asc') {
        $orderBy = 'pelayan ASC';
    } elseif ($sort == 'pelayan_desc') {
        $orderBy = 'pelayan DESC';
    } elseif ($sort == 'no_meja_asc') {
        $orderBy = 'no_meja ASC';
    } elseif ($sort == 'no_meja_desc') {
        $orderBy = 'no_meja DESC';
    } else {
        $orderBy = 'order.kode_order ASC';
    }
    
    $data = mysqli_query($koneksi, "SELECT * FROM `order` WHERE status = 'proses' ");
    $jumlah_data = mysqli_num_rows($data);
    $total_halaman = ceil($jumlah_data / $batas);
    $hasil = mysqli_query($koneksi,  "SELECT * FROM `order` WHERE status = 'proses'  ORDER BY $orderBy LIMIT $halaman_awal, $batas");
    $no = $halaman_awal + 1;
    
    // SEARCH
    if (isset($_GET['cari'])){
        $cari  = $_GET['cari'];
        $sql_cari  = "SELECT * FROM `order` WHERE status = 'proses' AND 
                (kode_order LIKE '%$cari%' OR tanggal LIKE '%$cari%' OR 
                jam LIKE '%$cari%' OR pelayan LIKE '%".$cari."%' OR no_meja LIKE '%$cari%')";
        $hasil = mysqli_query($koneksi, $sql_cari);
    
        if (mysqli_num_rows($hasil) > 0){
            $jumlah_data = mysqli_num_rows($hasil);
            $total_halaman = ceil($jumlah_data/$batas);
            $sql_cari = $sql_cari . "LIMIT $halaman_awal, $batas";
            $hasil = mysqli_query($koneksi, $sql_cari);
        }
        else{
            echo "<script> alert('Data Order Tidak Ditemukan') </script>";
            echo "<script> window.location.href='5_dataOrder.php' </script>";
        }
    }
}else{
    $username = $_SESSION['username'];
    // MEMBUAT PAGINATION
    $batas = 5;
    $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
    $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
    $previous = $halaman - 1;
    $next = $halaman + 1;
    $data = mysqli_query($koneksi, "SELECT * FROM `order` WHERE status = 'proses' AND pembeli = '$username'");
    $jumlah_data = mysqli_num_rows($data);
    $total_halaman = ceil($jumlah_data / $batas);
    $hasil = mysqli_query($koneksi,  "SELECT * FROM `order` WHERE status = 'proses' AND pembeli = '$username' limit $halaman_awal, $batas");
    $no = $halaman_awal+1;
    
    // SORTING
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'kode_order_asc';
    $orderBy = '';
    
    if ($sort == 'kode_order_asc') {
        $orderBy = 'kode_order ASC';
    } elseif ($sort == 'kode_order_desc') {
        $orderBy = 'kode_order DESC';
    } elseif ($sort == 'tanggal_asc') {
        $orderBy = 'tanggal ASC';
    } elseif ($sort == 'tanggal_desc') {
        $orderBy = 'tanggal DESC';
    } elseif ($sort == 'jam_asc') {
        $orderBy = 'jam ASC';
    } elseif ($sort == 'jam_desc') {
        $orderBy = 'jam DESC';
    }elseif ($sort == 'pelayan_asc') {
        $orderBy = 'pelayan ASC';
    } elseif ($sort == 'pelayan_desc') {
        $orderBy = 'pelayan DESC';
    } elseif ($sort == 'no_meja_asc') {
        $orderBy = 'no_meja ASC';
    } elseif ($sort == 'no_meja_desc') {
        $orderBy = 'no_meja DESC';
    } else {
        $orderBy = 'order.kode_order ASC';
    }
    
    $data = mysqli_query($koneksi, "SELECT * FROM `order` WHERE status = 'proses' AND pembeli = '$username'");
    $jumlah_data = mysqli_num_rows($data);
    $total_halaman = ceil($jumlah_data / $batas);
    $hasil = mysqli_query($koneksi,  "SELECT * FROM `order` WHERE status = 'proses' AND pembeli = '$username' ORDER BY $orderBy LIMIT $halaman_awal, $batas");
    $no = $halaman_awal + 1;
    
    // SEARCH
    if (isset($_GET['cari'])){
        $cari  = $_GET['cari'];
        $sql_cari  = "SELECT * FROM `order` WHERE status = 'proses' AND pembeli = '$username' AND
                (kode_order LIKE '%$cari%' OR tanggal LIKE '%$cari%' OR 
                jam LIKE '%$cari%' OR pelayan LIKE '%".$cari."%' OR no_meja LIKE '%$cari%')";
        $hasil = mysqli_query($koneksi, $sql_cari);
    
        if (mysqli_num_rows($hasil) > 0){
            $jumlah_data = mysqli_num_rows($hasil);
            $total_halaman = ceil($jumlah_data/$batas);
            $sql_cari = $sql_cari . "LIMIT $halaman_awal, $batas";
            $hasil = mysqli_query($koneksi, $sql_cari);
        }
        else{
            echo "<script> alert('Data Order Tidak Ditemukan') </script>";
            echo "<script> window.location.href='5_dataOrder.php' </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA ORDER</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('home.jpg');
            background-size: cover;
        }
        header h1 {
            text-align: center;
            color: white;
            font-size: 50px;
        }
        table{margin: 0 auto;}
        th, td {
            border: 1px solid #ccc;
            padding: 15px;
        }      
        th {
            background-color: #8B4513;
            color: white;
        } 
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:nth-child(odd) {
            background-color: #F0DBC1;
        }
        .fa-sort-up,
        .fa-sort-down {
            color: black; /* Set the color to black */
        }
    </style>
</head>
<body>
    <?php 

    if ($_SESSION['level'] == 1){
        include "navbar_dataOrder.php";
    }else{
        include "navbar_dataOrder2.php";
    }
    ?>
    <br>
    <header>
        <?php
        if ($_SESSION['level'] == 1){?>
            <h1>Data Order Active</h1>
        <?php
        }else{?>
            <h1>Your Order Active</h1>
        <?php 
        }
        ?>
    </header><br>
    <div class="container mt-3">
        <table class="text-center">
        <div class="container mt-3">
        <table class="text-center">
            <tr>
                <th>No</th>
                <th>Kode Order
                    <?php if(!isset($_GET['sort']) || $_GET['sort'] == "kode_order_asc") { ?>
                        <a href="?<?= $batas ?>&sort=kode_order_desc"><i class="fas fa-sort-up"></i></a>
                    <?php } else { ?>
                        <a href="?<?= $batas ?>&sort=kode_order_asc"><i class="fas fa-sort-down"></i></a>
                    <?php } ?>
                </th>
                <th>Tanggal
                    <?php if(!isset($_GET['sort']) || $_GET['sort'] == "tanggal_asc") { ?>
                        <a href="?<?= $batas ?>&sort=tanggal_desc"><i class="fas fa-sort-up"></i></a>
                    <?php } else { ?>
                        <a href="?<?= $batas ?>&sort=tanggal_asc"><i class="fas fa-sort-down"></i></a>
                    <?php } ?>
                </th>
                <th>Jam
                    <?php if(!isset($_GET['sort']) || $_GET['sort'] == "jam_asc") { ?>
                        <a href="?<?= $batas ?>&sort=jam_desc"><i class="fas fa-sort-up"></i></a>
                    <?php } else { ?>
                        <a href="?<?= $batas ?>&sort=jam_asc"><i class="fas fa-sort-down"></i></a>
                    <?php } ?>
                </th>
                <th>Pelayan
                    <?php if(!isset($_GET['sort']) || $_GET['sort'] == "pelayan_asc") { ?>
                        <a href="?<?= $batas ?>&sort=pelayan_desc"><i class="fas fa-sort-up"></i></a>
                    <?php } else { ?>
                        <a href="?<?= $batas ?>&sort=pelayan_asc"><i class="fas fa-sort-down"></i></a>
                    <?php } ?>
                </th>
                <th>No Meja
                    <?php if(!isset($_GET['sort']) || $_GET['sort'] == "no_meja_asc") { ?>
                        <a href="?<?= $batas ?>&sort=no_meja_desc"><i class="fas fa-sort-up"></i></a>
                    <?php } else { ?>
                        <a href="?<?= $batas ?>&sort=no_meja_asc"><i class="fas fa-sort-down"></i></a>
                    <?php } ?>
                </th>
                <th>Pembeli</th>
                <th>Total Bayar</th>
                <th>Aksi</th>
            </tr>
            <?php
            include "koneksi.php";

            while ($row = mysqli_fetch_assoc($hasil)) {
                echo "<tr>
                        <td> $no </td>
                        <td>" . $row['kode_order'] . "</td>
                        <td>" . $row['tanggal'] . "</td>
                        <td>" . $row['jam'] . "</td>
                        <td>" . $row['pelayan'] . "</td>
                        <td>" . $row['no_meja'] . "</td>
                        <td>" . $row['pembeli'] . "</td>
                        ";

                        // Query untuk menghitung total bayar berdasarkan kode_order
                        $query_total_bayar = "SELECT SUM(harga_menu * jumlah) AS total_bayar FROM order_detil WHERE kode_order = '" . $row['kode_order'] . "'";
                        $hasil_total_bayar = mysqli_query($koneksi, $query_total_bayar);
                        $total_bayar_row = mysqli_fetch_assoc($hasil_total_bayar);
                        $total_bayar = $total_bayar_row['total_bayar'];
                        $total_bayar_formatted = "Rp " . number_format($total_bayar, 2, ',', '.');

                        echo "<td>" . $total_bayar_formatted . "</td>
                        
                        <td>
                            <a href='5_dataOrder.php?kode_order=" . $row['kode_order'] . "' onclick='return confirm(\"Anda yakin akan menghapus Data Order ini?\")'><button type='button' class='btn btn-danger'>Hapus</button></a>
                            <a href='6_orderDetil.php?kode_order=" . $row['kode_order'] . "'><button type='button' class='btn btn-info'>Detil </button></a>
                            <a href='12_Sselesai.php?kode_order=" . $row['kode_order'] . "'><button type='button' class='btn btn-success'>Selesai? </button></a>
                        </td>
                    </tr>";
                    $no++;
            }
            ?>
        </table><br>

            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous&$batas&sort=$sort" . (isset($cari)? "&cari=$cari" : "") . "'"; } ?>><<</a>
                    </li>
                    <?php 
                    for($x=1;$x<=$total_halaman;$x++){
                        if ($x == $halaman)
                        {
                            ?> 
                            <li class="page-item active"><a class="page-link" href="?halaman=<?php echo "$x&$batas&sort=$sort ". (isset($cari) ? "&cari=$cari" : ""); ?>"><?php echo $x; ?></a></li> 
                            <?php
                        } else {
                            ?> 
                            <li class="page-item"><a class="page-link" href="?halaman=<?php echo "$x&$batas&sort=$sort ". (isset($cari) ? "&cari=$cari" : ""); ?>"><?php echo $x; ?></a></li>
                            <?php
                        }
                    }
                    ?>				
                    <li class="page-item">
                        <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next&$batas&sort=$sort" . (isset($cari)? "&cari=$cari" : "") . "'"; } ?>>>></a>
                    </li>
                </ul>
		    </nav>
        </div>
    </div>
</body>
</html>

<?php
  include "koneksi.php";
 
  if(isset($_GET['kode_order'])){
    $kode_order = $_GET['kode_order'];

    // Ambil total bayar dari tabel order_detil berdasarkan kode_order
    $query_total = "SELECT SUM(harga_menu * jumlah) AS total_bayar FROM order_detil WHERE kode_order = $kode_order";
    $result_total = mysqli_query($koneksi, $query_total);
    $row_total = mysqli_fetch_assoc($result_total);
    $total_bayar = $row_total['total_bayar'];

    if ($total_bayar > 0 ){
        echo '<script> alert("Data Order Tidak Dapat Dihapus, karena ada catatan detil order") </script>';
        echo '<script>window.location.href = "5_dataOrder.php"; </script>';
    } else {
        $query = "DELETE FROM `order` WHERE kode_order = $kode_order";
        if (mysqli_query($koneksi, $query)) {
        echo '<script> alert("Data Order Berhasil Dihapus") </script>';
        echo '<script>window.location.href = "5_dataOrder.php"; </script>';
        }

    }
  }   
?>