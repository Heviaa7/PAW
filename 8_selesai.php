<?php
    if (isset($_GET['kode_order'])) {
        $kode_order = $_GET['kode_order'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>SELESAI</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-image: url(home.jpg);
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        main {
            text-align: center;
            margin: 50px;
        }

        h1, h2, h3{
            color: white;
        }

        button {
            background-color: burlywood;
            color: black;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }

        form {
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <main>    
        <h1><i>HEVIAA RESTO ORDER</i></h1>
        <h2>TERIMA KASIH ATAS ORDERAN ANDA</h2>
        <h3>:: SEMOGA HARI ANDA MENYENANGKAN ::</h3><br><br>
        <form action="" method="POST">
            <button name="detil">Lihat Detil Order</button>
        </form>
    </main>
</body>
</html>

<?php
if(isset($_POST['detil'])){
    echo "<script>window.location.href='7_orderDetil2.php?kode_order=" . $kode_order . "'</script>";
}
?>