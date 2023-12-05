<?php
   session_start();
   
   // Check if kode_order is different from the session's kode_order
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
    <title>PESAN</title>
    <link rel="stylesheet" href="gambar.css">
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <header>
        <h1><u><i>'HEVIAA' RESTO ORDER</i></u></h1>
    </header>

    <?php
        if (isset($_GET['kode_order'])){
            $kode_order = $_GET['kode_order'];
        }else{
            $kode_order = "";
            echo "<h1>Order Invalid</h1>";
        }
    ?>

    <div class="form">  
        <fieldset>
        <legend>TAMBAH PESANAN</legend>
        <h3>ID Order : <?php echo "$kode_order ";?></h3>
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
            echo "Pesanan ".$_SESSION['count']. " berhasil disimpan.";
        } else {
            echo "Gagal menyimpan pesanan: " . mysqli_error($koneksi);
        }
    } else {
        echo "Kode menu tidak ditemukan.";
    }
}
?>
    <br><br>
    <form action="" method="post">
        <button type="submit" class="button_selesai" name="selesai">Selesai</button>
    </form>
    <div class="gambar">
        <img src="ayam.jpg" alt="ayam bakar">
        <img src="ikan.jpg" alt="ikan bakar">
        <img src="sate.jpg" alt="sate ayam">
        <img src="sosis.jpg" alt="sosis bakar">
        <img src="soto.jpg" alt="soto ayam">
    </div>
</body>
</html>

<?php
if (isset($_POST['selesai'])){
    echo "<script>window.location.href='8_selesai.php?kode_order=" . $kode_order . "'</script>";
}
