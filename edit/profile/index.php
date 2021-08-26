<?php

session_start();
require '../include/function.php';

if (!isset($_SESSION['username'])) {
    header('location:../edit');
    exit();
}

$sess_username = $_SESSION['username'];
$queryUser = mysqli_query($konek, "SELECT * FROM user WHERE username = '$sess_username'");
$dataUser = mysqli_fetch_assoc($queryUser);
$absen = $dataUser['absen'];
$pw_login = $dataUser['password'];

if (isset($_POST['tombol'])) {
    
    $nama = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['nama'])));
    $alamat = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['alamat'])));
    $ig = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['ig'])));
    $nomer_wa = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['wa'])));
    $password = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['password'])));
    
    $queryBio = mysqli_query($konek, "SELECT * FROM biodata WHERE absen = '$absen'");
    $dataBio = mysqli_fetch_assoc($queryBio);
    $wa = $dataBio['wa'];
    
    if ( empty($alamat)  || empty($ig)  || empty($nomer_wa)) {
        alert("gagal", "Masih ada data yang kosong", "profile");
    } else if (password_verify($password, $pw_login) !== true) {
        alert("gagal", "Password tidak sesuai", "profile");
    } else {
        mysqli_query($konek, "UPDATE biodata SET alamat = '$alamat', ig = '$ig', url = '$url', wa = '$nomer_wa' WHERE absen = '$absen'");
        
        $pesan = "*[ KATALOG TKJ 3 ]* Halo ".$sess_username.", Anda telah mengubah Data Profile Akun di Website Katalog. Jika bukan anda segera lakukan ganti password atau hubungi developer.";
        
        require '../include/bot.php';
        if ($bot['status'] === true) {
            alert("berhasil", "Data berhasil di ubah.", "profile");
        } else {
            alert("gagal", $order['data']['msg'], "profile");
        }
    }

}

?>

<!DOCTYPE html>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <title>Edit Biodata</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
<body>
    <a class="easter right-text" href="../../game">
        <img src="ando.png" width='50' alt="" srcset="">
    </a>
    <div class="card-footer text-muted">
            <p class="wm">Desainer : <a href="../menu/biodata/?absen=16">Gilang</a></p>
            <p class="wm">Programer : <a href="../menu/biodata/?absen=30">Andra</a> , <a href="../menu/biodata/?absen=36">Eris</a></p>
    </div>
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
            $query_bio = mysqli_query($konek, "SELECT * FROM biodata WHERE absen = '$absen'");
            $data_bio = mysqli_fetch_assoc($query_bio);
            $nama = $data_bio['nama'];
            $alamat = $data_bio['alamat'];
            $ig = $data_bio['ig'];
            $wa = $data_bio['wa'];
            $foto = $data_bio['absen']

        ?>

    
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col fotos">
                    <table >
                        <tr class="foto">
                            <td class="gambar"><img src="../../menu/img/<?= $foto; ?>.png" alt="" srcset=""></td>
                        </tr>
                        <tr class="foto">
                            <td class="text-center"><?= $nama; ?></td>
                        </tr>
                    </table>
                </div>
            
                <div class="col form">
                    <table>
                        <tr>
                            <td><label>WhatsApp </label></td>
                            <td><input type="number" required="" name="wa" value="<?= $wa; ?>"></td>
                        </tr>
                        <tr>
                            <td><label>Instagram </label></td>
                            <td><input type="text" required="" name="ig" value="<?= $ig; ?>"></td>
                        </tr>
                        <tr>
                            <td><label>Alamat  </label></td>
                            <td><input type="text" required="" name="alamat" value="<?= $alamat; ?>"></td>
                        </tr>
                        <tr>
                            <td><label>Password </label></td>
                            <td><input type="password" required="" name="password" placeholder="Masukan password untuk verifikasi"></td>
                        </tr>
                    </table>
                    <br>
                    <button type="submit" name="tombol"> Simpan</button>                   
                    <p>Jangan lupa keluar agar bisa login kembali</p>
                    <a class="keluar" href="../logout.php">keluar</a>
                </div>
            </div>
        </div>
    </form>


</body>
</html>