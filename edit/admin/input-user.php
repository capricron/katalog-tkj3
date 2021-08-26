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
    $email = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['email'])));
    $level = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['level'])));
    $password = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['password'])));

    $cek_username = mysqli_query($konek, "SELECT * FROM user WHERE username = '$username'");
    $cek_email = mysqli_query($konek, "SELECT * FROM user WHERE email = '$email'");
    $cek_absen = mysqli_query($konek, "SELECT * FROM user WHERE absen = '$absen'");

    if (empty($absen) || empty($username) || empty($email) || empty($level) || empty($password)) {
        alert("gagal", "Masih ada data yang kosong", "admin/input-user");
    } else if (mysqli_num_rows($cek_absen) >= 1) {
        alert("gagal", "Absen telah digunakan.", "admin/input-user");
    } else if (mysqli_num_rows($cek_username) >= 1) {
        alert("gagal", "Username telah digunakan.", "admin/input-user");
    } else if (mysqli_num_rows($cek_email) >= 1) {
        alert("gagal", "Email telah digunakan.", "admin/input-user");
    } else {
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($konek, "INSERT INTO user VALUES ('$absen','$username','$hash_pass','$level','$email','')");
        alert("berhasil", "Data berhasil di input.", "admin/input-user");
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Input User</title>
    </head>
<body>
    <h3>Input User</h3>
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
            <label>Level : </label>
            <select name="level" class="form-control">
                <option value="0">Pilih salah satu</option>
                <option value="Member">Member</option>
                <option value="Admin">Admin</option>
            </select>
        </div>
        
        <div>
            <label>Email : </label>
            <input type="email" required="" name="email">
        </div>
        
        <div>
            <label>Username : </label>
            <input type="text" required="" name="username">
        </div>

        <div>
            <label>Password : </label>
            <input type="password" required="" name="password">
        </div>
        
        <div>
            <button type="submit" name="tombol"> Simpan</button>
        </div>
    </form>
    
</body>
</html>