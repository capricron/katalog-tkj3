<?php
session_start();
require '../include/function.php';

if (!isset($_SESSION['username'])) {
    header('location:../auth/login');
    exit();
}

$sess_username = $_SESSION['username'];
$queryUser = mysqli_query($konek, "SELECT * FROM user WHERE username = '$sess_username'");
$dataUser = mysqli_fetch_assoc($queryUser);

if ($dataUser['level'] !== "Admin") {
    require '../404.shtml';
    die();
}

if (isset($_POST['tombol'])) {
    $absen = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['absen'])));
    $username = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['username'])));
    $password = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['password'])));

    $query_user = mysqli_query($konek, "SELECT * FROM user WHERE absen = '$absen' AND username = '$username'");
    $data_user = mysqli_fetch_assoc($query_user);

    if (empty($absen) || empty($username) || empty($password)) {
        alert("gagal", "Masih ada data yang kosong", "admin/reset-password");
    } else if (mysqli_num_rows($query_user) == 0) {
        alert("gagal", "Username atau Absen salah. Tidak ditemukan.", "admin/reset-password");
    } else {
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($konek, "UPDATE user password = '$hash_pass' WHERE absen = '$absen' AND username = '$username'");
        
        $queryBio = mysqli_query($konek, "SELECT * FROM biodata WHERE absen = '$absen'");
        $dataBio = mysqli_fetch_assoc($queryBio);
        
        $wa = $dataBio['wa'];
        $pesan = "*[ KATALOG TKJ 3 ]* Halo ".$username.", Password akun Anda di Website Katalog telah di reset oleh ".$sess_username;
        require '../include/bot.php';
        
        if ($bot['status'] === true) {
            alert("berhasil", "Password berhasil di reset.", "admin/reset-password");
        } else {
            alert("gagal", $order['data']['msg'], "admin/reset-password");
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reset Password</title>
    </head>
<body>
    <h3>Reset Password</h3>
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
        
        <div>
            <label>Absen : </label>
            <input type="number" required="" name="absen">
        </div>
        
        <div>
            <label>Username : </label>
            <input type="text" required="" name="username">
        </div>

        <div>
            <label>Password Baru : </label>
            <input type="password" required="" name="password">
        </div>
        
        <div>
            <button type="submit" name="tombol"> Simpan</button>
        </div>
    </form>
    
</body>
</html>