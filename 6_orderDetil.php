<?php
session_start();
if (isset($_GET['kode_order'])){
    $kode_order = $_GET['kode_order'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DETIL ORDER</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(home.jpg);
            background-size: cover;
        }
        header h1 {
            text-align: center;
            color: white;
            font-size: 50px;
        }
        header h2{
            color: white;
            text-align: center;
        }
        table {
            width: 70%;
            border-collapse: collapse;
            margin: 0 auto;
        }
        tr:nth-child(even) {background-color: #f2f2f2;}
        tr:nth-child(odd) {background-color: rgb(240, 219, 193);}
        th {
            background-color: #8B4513;
            color: white;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
        }
        button {
            background-color: #8B4513;
            padding: 10px 20px;
            font-size: 20px;
            border-radius: 5px;
            box-shadow: 5px 5px 10px rgba(230, 221, 221, 0.5);
            color:white;
        }
        .tambah{text-align: center;}
    </style>
</head>
<body>
    <?php
    if ($_SESSION['level'] == 1){
        include "navbar.php";
    }else{
        include "navbar_2.php";
    }
    ?>
    <br>
    <header>
        <h1>ORDER DETIL</h1>
        <h2>Kode Order : <?php echo $kode_order ?></h2>
    </header><br><br>
    <div class="container mt-3">
        <div class="col-10 mx-auto">
            <table class="text-center">
                <tr>
                    <th>Item</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
                <?php
                include 'koneksi.php';
                
                if (isset($kode_order)) {
                    $query = "SELECT * FROM order_detil 
                            INNER JOIN menu ON order_detil.kode_menu = menu.kode_menu
                            WHERE order_detil.kode_order = '$kode_order'";
                    $hasil = mysqli_query($koneksi, $query);

                    $total_bayar = 0;
                    while ($row = mysqli_fetch_assoc($hasil)) {
                        echo "<tr>
                                <td>" . $row['nama_menu'] . "</td>
                                <td>" . $row['jumlah'] . "</td>
                                <td> Rp " . $row['subtotal'] . "</td>
                            </tr>";
                        $total_bayar += $row['subtotal'];
                    }
                }
                ?>
                <tr>
                    <td colspan="2"><b>Total Pembayaran : <b></td>
                    <td colspan="2">Rp <?php echo $total_bayar?>.00</td>
                </tr>
            </table>
        </div>
    </div>
    <br><br>
    <div class="tambah">
        <?php 
        $sql = "SELECT status FROM `order` WHERE kode_order = '$kode_order'";
        $hasil2 = mysqli_query($koneksi, $sql);
        $row2 = mysqli_fetch_array($hasil2);
        ?>
    <button <?php echo ($row2['status'] == 'selesai') ? 'disabled' : ''; ?> onclick="window.location.href = '2_pesan2.php?kode_order=<?php echo $kode_order ?>'">Add</button>
    </div>
</body>
</html>

