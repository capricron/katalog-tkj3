<?php
session_start();
require '../../include/function.php';

if (!isset($_SESSION['username'])) {
    header('location:../../auth/login');
    exit();
}

$sess_username = $_SESSION['username'];
$queryUser = mysqli_query($konek, "SELECT * FROM user WHERE username = '$sess_username'");
$dataUser = mysqli_fetch_assoc($queryUser);

if ($dataUser['level'] !== "Admin") {
    require '../../404.shtml';
    die();
} 

if (isset($_POST['tombol'])) {
    $foto_bio = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['foto_bio'])));
    $foto_menu = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['foto_menu'])));
    $absen = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['absen'])));
    $nama = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['nama'])));
    $ttl = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['ttl'])));
    $deskripsi = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['deskripsi'])));
    $quotes = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['quotes'])));
    $alamat = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['alamat'])));
    $ig = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['ig'])));
    $url = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['url'])));
    $wa = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['wa'])));
    $tag = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['tag'])));

    if (empty($nama) || empty($foto_bio) || empty($foto_menu) || empty($absen) || empty($ttl) || empty($deskripsi) || empty($quotes) || empty($alamat) || empty($ig) || empty($url) || empty($wa) || empty($tag)) {
        alert("gagal", "Masih ada data yang kosong", "ajax/edit-user");
    } else {
        mysqli_query($konek, "UPDATE user SET username = '$username', level = '$level', email = '$email' WHERE absen = '$absen'");
        alert("berhasil", "Data berhasil di ubah.", "ajax/edit-user");
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Biodata</title>
    </head>
<body>
    <h3>Edit Biodata</h3>
    <form action="" method="POST">
        <?php if (isset($_COOKIE['gagal'])): ?>
        <div style="color:red;">
            <strong><?= $_COOKIE['gagal']; ?></strong>
        </div>
        <?php endif ?>
        
        <?php if (isset($_COOKIE['berhasil'])): ?>
        <div style="color:green;">
            <strong><?= $_COOKIE['berhasil']; ?></strong>
        </div>
        <?php endif ?>
        
        <?php
            if (isset($_GET['absen'])) {
                $absen = $_GET['absen'];
                $query_bio = mysqli_query($konek, "SELECT * FROM biodata WHERE absen = '$absen'");
                $data_bio = mysqli_fetch_assoc($query_bio);
            }
        ?>
        
        <div>
            <label>Absen : </label>
            <input type="number" required="" name="absen" readonly value="<?= $data_bio['absen']; ?>">
        </div>
        
        <div>
            <label>Foto Biodata : </label>
            <input type="text" required="" name="foto_bio" value="<?= $data_bio['foto biodata']; ?>">
        </div>
        
        <div>
            <label>Foto Menu : </label>
            <input type="text" required="" name="foto_menu" value="<?= $data_bio['foto menu']; ?>">
        </div>
        
        <div>
            <label>Nama : </label>
            <input type="text" required="" name="nama" value="<?= $data_bio['nama']; ?>">
        </div>
        
        <div>
            <label>Tempat, Tanggal Lahir : </label>
            <input type="text" required="" name="ttl" value="<?= $data_bio['ttl']; ?>">
        </div>
        
        <div>
            <label>Deskripsi : </label>
            <textarea name="deskripsi" rows="4" cols="100" required=""><?= $data_bio['deskripsi']; ?></textarea>
        </div>

        <div>
            <label>Quotes : </label>
            <textarea name="quotes" rows="4" cols="50" required=""><?= $data_bio['quotes']; ?></textarea>
        </div>
        
        <div>
            <label>Alamat : </label>
            <input type="text" required="" name="alamat" value="<?= $data_bio['alamat']; ?>">
        </div>
        
        <div>
            <label>Instagram : </label>
            <input type="text" required="" name="ig" value="<?= $data_bio['ig']; ?>">
        </div>
        
        <div>
            <label>URL : </label>
            <input type="text" required="" name="url" value="<?= $data_bio['url']; ?>">
        </div>
        
        <div>
            <label>Nomor WhatsApp : </label>
            <input type="number" required="" name="wa" value="<?= $data_bio['wa']; ?>">
        </div>
        
        <div>
            <label>Tag : </label>
            <input type="text" required="" name="tag" value="<?= $data_bio['tag']; ?>">
        </div>
        
        <div>
            <button type="submit" name="tombol"> Simpan</button>
        </div>
    </form>
    
</body>
</html>