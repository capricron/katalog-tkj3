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
    $absen = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['absen'])));
    $username = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['username'])));
    $email = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['email'])));
    $level = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['level'])));

    $cek_username = mysqli_query($konek, "SELECT * FROM user WHERE username = '$username'");
    $cek_email = mysqli_query($konek, "SELECT * FROM user WHERE email = '$email'");

    if (empty($absen) || empty($username) || empty($email) || empty($level)) {
        alert("gagal", "Masih ada data yang kosong", "ajax/edit-user");
    } else if (mysqli_num_rows($cek_username) >= 1) {
        alert("gagal", "Username telah digunakan.", "ajax/edit-user");
    } else if (mysqli_num_rows($cek_email) >= 1) {
        alert("gagal", "Email telah digunakan.", "ajax/edit-user");
    } else {
        mysqli_query($konek, "UPDATE user SET username = '$username', level = '$level', email = '$email' WHERE absen = '$absen'");
        alert("berhasil", "Data berhasil di ubah.", "ajax/edit-user");
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit User</title>
    </head>
<body>
    <h3>Edit User</h3>
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
                $query_user = mysqli_query($konek, "SELECT * FROM user WHERE absen = '$absen'");
                $data_user = mysqli_fetch_assoc($query_user);
            }
        ?>
        
        <div>
            <label>Absen : </label>
            <input type="number" required="" name="absen" readonly value="<?= $data_user['absen']; ?>">
        </div>
        
        <div>
            <label>Level : </label>
            <select name="level" class="form-control">
                <option value="<?= $data_user['level']; ?>"><?= $data_user['level']; ?> (Dipilih)</option>
                <option value="Member">Member</option>
                <option value="Admin">Admin</option>
            </select>
        </div>
        
        <div>
            <label>Email : </label>
            <input type="email" required="" name="email" value="<?= $data_user['email']; ?>">
        </div>
        
        <div>
            <label>Username : </label>
            <input type="text" required="" name="username" value="<?= $data_user['username']; ?>">
        </div>
        
        <div>
            <button type="submit" name="tombol"> Simpan</button>
        </div>
    </form>
    
</body>
</html>