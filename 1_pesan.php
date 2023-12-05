<?php
session_start();
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
        }
        header h1 {
            text-align: center;
            color: white;
            font-size: 50px;
        }
        .form{
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        fieldset{
            width: 400px;
            color: azure;
        }
        form input, form select{
            width: 120%;
            padding: 5px;
            border: 1px solid #000; /* Tambahkan border */
            margin-bottom: 5px; /* Tambahkan jarak antara elemen input */
        }
        form input[type="submit"]{
            background-color: burlywood;
            border-radius: 10px;
            box-shadow: 5px 5px 10px rgba(230, 221, 221, 0.5);
        }
        table{
            margin:0 20% 0 15%;
            width : 60%;
            margin-top: 10px;
        }
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
        <h1>Order</h1>
    </header><br>
    <div class="form">  
        <fieldset class="border p-2">
        <form action="" method="post">
            <table>
                <tr>
                    <?php date_default_timezone_set("Asia/Jakarta") ?>
                    <td><label for="tanggal"><b>Tanggal<b></label></td>
                    <td><input type="text" id="tanggal" name="tanggal" value="<?= date('Y:m:d') ?>" required></td>
                </tr>

                <tr>
                    <?php date_default_timezone_set("Asia/Jakarta") ?>
                    <td><label for="jam"><b>Jam<b></label></td>
                    <td><input type="text" id="jam" name="jam" value="<?= date('H:i:s') ?>" required></td>
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
                    <td><label for="meja"><b>No_Meja</b></label></td>
                    <td><input type="number" id="meja" name="meja" required></td>
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
    $jam_order = $_POST['jam'];
    $pelayan = $_POST['pelayan'];
    $meja = $_POST['meja'];

    if($_SESSION['level'] == 1){
        $pembeli = 'umum';
    }else{
        $username = $_SESSION['username'];
        $pembeli = $username;
    }

    // Validate if the table is available
    $query_info_meja = "SELECT * FROM `order` WHERE no_meja = '$meja' AND tanggal = '$tanggal' ORDER BY kode_order DESC LIMIT 1";
    $result_info_meja = mysqli_query($koneksi, $query_info_meja);

    if ($result_info_meja) {
        $info_meja = mysqli_fetch_assoc($result_info_meja);

        // Check if the table is already booked
        if (!empty($info_meja)) {
            $no_meja = $info_meja['no_meja'];
            $jam = $info_meja['jam'];
            $jam_tersedia = date("H:i:s", strtotime("+2 minutes", strtotime($jam)));

            if ($jam_order < $jam_tersedia) {
                echo "<script>alert('Mohon Maaf, no meja $meja masih digunakan, tunggu sampai $jam_tersedia')</script>";
                exit;
            }
        }
    }

    $query1 = "INSERT INTO `order` (tanggal, jam,  pelayan, no_meja, pembeli) VALUES ('$tanggal', '$jam_order', '$pelayan', '$meja', '$pembeli')";
    $hasil1 = mysqli_query($koneksi, $query1);
    $kode_order = mysqli_insert_id($koneksi);

    if($hasil1){
        echo "<script>window.location.href='2_pesan2.php?kode_order=" . $kode_order . "'</script>";
    }
}
?>