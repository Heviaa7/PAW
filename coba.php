<?php
                include "koneksi_p09.php";

                if(isset($_POST['simpan'])){
                    $tanggal_order = $_POST['tanggal_order'];
                    $jam_order = $_POST['jam_order'];
                    $pelayan = $_POST['pelayan'];
                    $no_meja = $_GET['no_meja'];

                    $query_info_meja = "SELECT * FROM `order` WHERE no_meja = '$no_meja' ORDER BY id DESC LIMIT 1";
                    $result_info_meja = mysqli_query($koneksi, $query_info_meja);

                    if ($result_info_meja) {
                        $info_meja = mysqli_fetch_assoc($result_info_meja);

                        // Cek jika meja sudah digunakan
                        if (!empty($info_meja)) {
                            $meja = $info_meja["no_meja"];
                            $jam = $info_meja["jam_order"];
                            $jam_tersedia = date("H:i:s", strtotime("+2 minutes", strtotime($jam)));

                            if ($jam_order < $jam_tersedia) {
                                echo "<script>alert('Sorry banget nih, no meja $no_meja masih digunakan, tunggu sampai $jam_tersedia')</script>";
                                exit;
                            }
                        }
                    }

                    // Simpan data ke tabel order
                    $data_query_order = "INSERT INTO `order` (tanggal_order, jam_order, pelayan, no_meja) VALUES ('$tanggal_order', '$jam_order', '$pelayan', '$no_meja')";
                    $data_order = mysqli_query($koneksi, $data_query_order);
                    $data_id = mysqli_insert_id($koneksi);
                    

                    if ($data_order) {
                        echo "<meta http-equiv=refresh content='6;URL=P09_FormOrderDetil.php?id=$data_id'>";
                    } else {
                        echo "Error inserting data: " . mysqli_error($koneksi);
                    }
                }
            ?>