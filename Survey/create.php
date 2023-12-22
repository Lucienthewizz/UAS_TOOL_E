<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Peserta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nama=input($_POST["nama"]);
        $makanan_favorite=input($_POST["makanan_favorite"]);
        $minuman_favorite=input($_POST["minuman_favorite"]);
        $pesan_kesan=input($_POST["pesan_kesan"]);
        $notelp_pelanggan=input($_POST["notelp_pelanggan"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into tb_survey (nama,makanan_favorite,minuman_favorite,pesan_kesan,notelp_pelanggan) values
		('$nama','$makanan_favorite','$minuman_favorite','$pesan_kesan','$notelp_pelanggan')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
<section class="section">
        <div class="container">
            <h2 class="title">Input Data</h2>
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                <div class="field">
                    <label class="label">Nama:</label>
                    <div class="control">
                        <input type="text" name="nama" class="input" placeholder="Masukan Nama" required />
                    </div>
                </div>
                <div class="field">
                    <label class="label">Makanan Favorite:</label>
                    <div class="control">
                        <input type="text" name="makanan_favorite" class="input" placeholder="Masukan Makanan Favorite" required/>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Minuman Favorite :</label>
                    <div class="control">
                        <input type="text" name="minuman_favorite" class="input" placeholder="Masukan Minuman Favorite" required/>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Kesan dan Pesan:</label>
                    <div class="control">
                        <input type="text" name="pesan_kesan" class="input" placeholder="Kesan dan Pesan" required/>
                    </div>
                </div>
                <div class="field">
                    <label class="label">No telepon:</label>
                    <div class="control">
                        <textarea name="notelp_pelanggan" class="textarea" placeholder="Masukan nomor telepon" required></textarea>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <button type="submit" name="submit" class="button is-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
</body>
</html>