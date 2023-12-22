<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>
<title>UAS TOOL KELAS E</title>
<body>
    <nav class="navbar is-dark" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <span class="navbar-item">SURVEY RESTORAN</span>
        </div>
    </nav>
    <div class="container mt-4">
        <h4 class="has-text-centered is-size-4 has-text-weight-bold">SURVEY MAKANAN DAN MINUMAN</h4>
        <?php
            include "koneksi.php";

            // Cek apakah ada kiriman form dari method post
            if (isset($_GET['id_pelanggan'])) {
                $id_pelanggan = htmlspecialchars($_GET["id_pelanggan"]);
                $sql = "delete from tb_survey where id_pelanggan='$id_pelanggan' ";
                $hasil = mysqli_query($kon, $sql);

                // Kondisi apakah berhasil atau tidak
                if ($hasil) {
                    header("Location:index.php");
                } else {
                    echo "<div class='notification is-danger'> Data Gagal dihapus.</div>";
                }
            }
        ?>

        <table class="table is-bordered is-fullwidth">
            <thead>
                <tr class="has-background-primary has-text-white">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Makanan Favorite</th>
                    <th>Minuman Favorite</th>
                    <th>Pesan & Kesan</th>
                    <th>No Hp</th>
                    <th colspan='2'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include "koneksi.php";
                    $sql = "select * from tb_survey order by id_pelanggan desc";
                    $hasil = mysqli_query($kon, $sql);
                    $no = 0;
                    while ($data = mysqli_fetch_array($hasil)) {
                        $no++;
                ?>
                <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $data["nama"]; ?></td>
                    <td><?php echo $data["makanan_favorite"]; ?></td>
                    <td><?php echo $data["minuman_favorite"]; ?></td>
                    <td><?php echo $data["pesan_kesan"]; ?></td>
                    <td><?php echo $data["notelp_pelanggan"]; ?></td>
                    <td>
                        <a href="update.php?id_pelanggan=<?php echo htmlspecialchars($data['id_pelanggan']); ?>" class="button is-warning">Update</a>
                        <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_pelanggan=<?php echo $data['id_pelanggan']; ?>" class="button is-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="create.php" class="button is-primary mt-4">Tambah Data</a>
    </div>
</body>
</html>
