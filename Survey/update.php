<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Survey Restoran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>
<body>
    <div class="container">
        <?php
            // Include file koneksi, untuk koneksikan ke database
            include "koneksi.php";

            // Fungsi untuk mencegah inputan karakter yang tidak sesuai
            function input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            // Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_peserta
            if (isset($_GET['id_pelanggan'])) {
                $id_pelanggan = input($_GET["id_pelanggan"]);
                $sql = "select * from tb_survey where id_pelanggan=$id_pelanggan";
                $hasil = mysqli_query($kon, $sql);
                $data = mysqli_fetch_assoc($hasil);
            }

            // Cek apakah ada kiriman form dari method post
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id_pelanggan = htmlspecialchars($_POST["id_pelanggan"]);
                $nama = input($_POST["nama"]);
                $makanan_favorite = input($_POST["makanan_favorite"]);
                $minuman_favorite = input($_POST["minuman_favorite"]);
                $pesan_kesan = input($_POST["pesan_kesan"]);
                $notelp_pelanggan = input($_POST["notelp_pelanggan"]);

                // Query update data pada tabel anggota
                $sql = "update tb_survey set
                        nama='$nama',
                        makanan_favorite='$makanan_favorite',
                        minuman_favorite='$minuman_favorite',
                        pesan_kesan='$pesan_kesan',
                        notelp_pelanggan='$notelp_pelanggan'
                        where id_pelanggan=$id_pelanggan";

                // Mengeksekusi atau menjalankan query diatas
                $hasil = mysqli_query($kon, $sql);

                // Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
                if ($hasil) {
                    header("Location:index.php");
                } else {
                    echo "<div class='notification is-danger'> Data Gagal disimpan.</div>";
                }
            }
        ?>

        <h2 class="title">Update Data</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
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
                <label class="label">Minuman Favorite:</label>
                <div class="control">
                    <input type="text" name="minuman_favorite" class="input" placeholder="Masukan Minuman Favorite" required/>
                </div>
            </div>

            <div class="field">
                <label class="label">Pesan dan Kesan:</label>
                <div class="control">
                    <input type="text" name="pesan_kesan" class="input" placeholder="Kesan dan Pesan" required/>
                </div>
            </div>

            <div class="field">
                <label class="label">Nomor Telepon:</label>
                <div class="control">
                    <textarea name="notelp_pelanggan" class="textarea" placeholder="Masukan nomor telepon" required></textarea>
                </div>
            </div>

            <input type="hidden" name="id_pelanggan" value="<?php echo $data['id_pelanggan']; ?>" />

            <div class="control">
                <button type="submit" name="submit" class="button is-primary">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
