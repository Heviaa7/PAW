<?php
session_start();
include "koneksi.php";
// Pastikan $_POST['kode_order'] sudah didefinisikan atau ada sebelum mengaksesnya
if (isset($_GET['kode_order']) && $_GET['kode_order'] !== $_SESSION['kode_order']) {
    $_SESSION['count'] = 0;
    $_SESSION['kode_order'] = $_GET['kode_order'];
} else if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 0;
}

if (isset($_GET['kode_order'])) {
    $kode_order = $_GET['kode_order'];
} else {
    $kode_order = "";
    echo "<h1>Order Invalid</h1>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORDER</title>
    <link rel="stylesheet" href="gambar.css">
    <style>
        * {font-family: Arial, sans-serif;}
        body{
            background-image: url(home.jpg);
            background-size: cover;
            color: white;
            padding:  0 0 20px 0;
            text-align: center;
        }
        header h1 {
            text-align: center;
            color: white;
            font-size: 50px;
        }
        header h5{text-align: center; padding-bottom: 10px; color: white;}
        .form{
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        fieldset{
            width: 400px;
            color: azure;
        }
        legend {font-size: 25px; padding-bottom: 20px; text-align: center;}  
        form input, form select{
            width: 120%;
            padding: 5px;
            border: 1px solid #000; /* Tambahkan border */
            margin-bottom: 7px; /* Tambahkan jarak antara elemen input */
        }
        form input[type="submit"]{
            background-color: burlywood;
            border-radius: 10px;
            box-shadow: 5px 5px 10px rgba(230, 221, 221, 0.5);
            margin-top: 10px;
        }
        table{
            margin:0 20% 0 15%;
            width : 60%;
            margin-top: 10px;
        }
        button{
            background-color: rgb(240, 219, 193);
            background-color: burlywood;
            padding: 10px 20px;
            font-size: 20px;
            border-radius: 10px;
            box-shadow: 5px 5px 10px rgba(230, 221, 221, 0.5);
        }
        .button-selesai{text-align: center; padding-top: 0px;}
        .notif{color: white; text-align: center;}
    </style>
</head>
<body>
    <?php 
    include "koneksi.php";
    
    if ($_SESSION['level'] == 1){
        include "navbar.php";
    }elseif($_SESSION['level'] == 2){
        include "navbar_2.php";
    }
    ?><br>
    <header>
        <h1>Tambah Pesanan</h1>
        <h5>ID Order : <?php echo "$kode_order ";?></h5>
    </header><br>

    <div class="form">  
        <fieldset class="border p-2">
        <form action="" method="post">
            <table>
                <tr>
                    <td><input type="hidden" id="kode_order" name = "kode_order" value="<?php echo $kode_order ?>"></td>
                </tr>

                <tr>
                    <td><label for="menu"><b>Menu<b></label></td>
                    <td><select name="kode_menu" id="menu" required>
                    <option value=""disable selected> -- Pilih Menu --</option>
                        <?php
                            include "koneksi.php";
                            $sql = "SELECT kode_menu, CONCAT(nama_menu, ' / ', harga_menu) AS ket FROM menu ORDER BY nama_menu";
                            $result = mysqli_query($koneksi, $sql);
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value = "'. $row['kode_menu'].'">'.$row['ket'].'</option>';
                                }
                            }
                            ?>
                    </select></td>
                </tr>

                <tr>
                    <td><label for="jumlah"><b>Jumlah<b></label></td>
                    <td><input type="number" id="jumlah" placeholder="jumlah" name="jumlah" required></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td colspan="2"><input type="submit" value="Simpan Pesanan" name="kirim"></td>
                </tr>
            </table>
        </form>
        </fieldset>   
    </div>
<?php
include "koneksi.php";

if (isset($_POST['kirim'])) {
    $_SESSION['count']++;
    $kode_order = $_POST['kode_order'];
    $kode_menu = $_POST['kode_menu'];
    $jumlah = $_POST['jumlah'];

    // Dapatkan harga_menu dari database berdasarkan kode_menu
    $query_harga = "SELECT harga_menu FROM menu WHERE kode_menu = '$kode_menu'";
    $result_harga = mysqli_query($koneksi, $query_harga);

    if ($result_harga && mysqli_num_rows($result_harga) > 0) {
        $row_harga = mysqli_fetch_assoc($result_harga);
        $harga_menu = $row_harga['harga_menu'];

        // Hitung subtotal
        $subtotal = $harga_menu * $jumlah;

        // Masukkan data ke dalam tabel
        $query_insert = "INSERT INTO order_detil (kode_order, kode_menu, harga_menu, jumlah, subtotal) 
                        VALUES ('$kode_order', '$kode_menu', '$harga_menu', '$jumlah', '$subtotal')";

        $hasil_insert = mysqli_query($koneksi, $query_insert);

        if ($hasil_insert) {
            echo "<div class='notif'>";
                echo "Pesanan ".$_SESSION['count']. " berhasil disimpan.";
            echo "</div>";
        } else {
            echo "Gagal menyimpan pesanan: " . mysqli_error($koneksi);
        }
    } else {
        echo "Kode menu tidak ditemukan.";
    }
}
?>
    <br><br>
    <div class="button-selesai">
        <button type="button" onclick="window.location.href = '5_dataOrder.php'">Selesai</button>
    </div>
    <div class="gambar">
        <img src="ayam.jpg" alt="ayam bakar">
        <img src="ikan.jpg" alt="ikan bakar">
        <img src="sate.jpg" alt="sate ayam">
        <img src="sosis.jpg" alt="sosis bakar">
        <img src="soto.jpg" alt="soto ayam">
    </div>
</body>
</html>