<?php
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
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('home.jpg');
            background-size: cover;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        header {
            text-align: center;
            color: white;
        } 
        header h1 {
            font-size: 2em;
            margin: 0;
        }
        header h2 {
            font-size: 1.5em;
            margin-top: 10px;
        } 
        .navbar {
            background-color: black;
            overflow: hidden;
        } 
        .navbar a {
            float: left;
            font-size: 1.2em;
            color: white;
            text-align: center;
            text-decoration: none;
        }  
        .menu {
            float: left;
        } 
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        li {
            display: inline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
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
        button {
            background-color: #8B4513;
            color: white;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            box-shadow: 5px 5px 10px rgba(230, 221, 221, 0.5);
            cursor: pointer;
        }
        button:hover {
            background-color: #654321;
        } 
        .t_back a {
            color: white;
            text-decoration: none;
        }
        .t_back i {
            margin-right: 5px;
         }
        .t_back:hover {
            background-color: #333;
        }
        .t_back:hover a {
            color: #8B4513;
        }
        /* Responsive Design */
        @media (max-width: 768px) {
            table {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="menu">
            <ul>
                <li class="t_back"><a href="selesai.php?kode_order=<?php echo $kode_order ?>"><i data-feather="arrow-left"></i></a></li>
            </ul>
        </div>
    </div>
    <br>
    <header>
        <h1><i>ORDER DETIL</i></h1>
        <h2>Kode Order : <?php echo $kode_order ?></h2>
    </header><br><br>
    <table>
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
                        <td> Rp " . number_format($row['subtotal'], 2, ',', '.') . "</td>
                    </tr>";
                    

                $total_bayar += $row['subtotal'];
            }
            $total_bayar_formatted = "Rp " . number_format($total_bayar, 2, ',', '.');
        }
        ?>
        <tr>
            <td colspan="2"><b>Total Pembayaran : <b></td>
            <td><?php echo $total_bayar_formatted ?></td>
        </tr>
    </table>
    <br><br>
    <button onclick= "window.location.href = '4_pesanviaCode.php?kode_order=<?php echo $kode_order ?>'">Add</button>
    <script>
      feather.replace();
    </script>
</body>
</html>
