<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORDER</title>
    <link rel="stylesheet" href="gambar.css">  
    <link rel="stylesheet" href="form.css">  
</head>
<body>
    <header>
        <h1><u><i>'HEVIAA' RESTO ORDER</i></u></h1>
    </header>
    <div class="form">  
        <fieldset>
        <legend>DATA ORDER</legend>
        <h3>Nomor Meja : <?php echo $_GET['meja'] ?></h3>
        <form action="" method="post">
            <?php date_default_timezone_set("Asia/Jakarta") ?>
            <table>
                <tr>
                    <td><label for="tanggal"><b>Tanggal<b></label></td>
                    <td><input type="text" id="tanggal" name="tanggal" value="<?php echo date("Y:m:d", time())?>" required></td>
                </tr>

                <tr>
                    <td><label for="jam"><b>Jam<b></label></td>
                    <td><input type="text" id="jam" name="jam" value="<?php echo date("H:i:s", time())?>" required></td>
                </tr>

                <tr>
                    <td><label for="pelayan"><b>Pelayan<b></label></td>
                    <td>
                        <select name="pelayan" id="pelayan" required>
                        <option value=""disable selected> -- Pilih Pelayan --</option>
                            <option value="Miya">Miya</option>
                            <option value="Ara">Ara</option>
                            <option value="Ken">Ken</option>
                            <option value="Racel">Racel</option>
                            <option value="Mira">Mira</option>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td colspan="2"><input type="submit" value="Pesan" name="kirim"></td></td>
                </tr>
            </table>
        </form>
        </fieldset>
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

<?php
if (isset($_POST['kirim'])) {
    include 'koneksi.php';

    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $pelayan = $_POST['pelayan'];
    $meja = $_GET['meja'];

    // Validate if the table is available
    $query_info_meja = "SELECT * FROM `order` WHERE no_meja = '$meja' AND tanggal = '$tanggal' ORDER BY kode_order DESC LIMIT 1";
    $result_info_meja = mysqli_query($koneksi, $query_info_meja);

    if ($result_info_meja) {
        $info_meja = mysqli_fetch_assoc($result_info_meja);

        // Check if the table is already booked
        if (!empty($info_meja)) {
            $jam_pemesanan_sebelumnya = strtotime($info_meja["jam"]);
            $jam_sekarang = strtotime(date("H:i:s"));

            // Check if the table was booked less than 10 minutes ago
            if ($jam_sekarang - $jam_pemesanan_sebelumnya < 600) {
                $jam_tersedia = date("H:i:s", strtotime("+10 minutes", $jam_pemesanan_sebelumnya));
                echo "<script>alert('Mohon Maaf, no meja $meja masih digunakan, tunggu sampai $jam_tersedia')</script>";
                exit;
            }
        }
    }

    $query1 = "INSERT INTO `order` (tanggal, jam,  pelayan, no_meja, pembeli) VALUES ('$tanggal', '$jam', '$pelayan', '$meja', 'umum')";
    $hasil1 = mysqli_query($koneksi, $query1);
    $kode_order = mysqli_insert_id($koneksi);

    if($hasil1){
        echo "<script>window.location.href='4_pesanviaCode2.php?kode_order=" . $kode_order . "'</script>";
    }
}
?>