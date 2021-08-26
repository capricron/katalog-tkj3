<?php

session_start();
require 'include/function.php';

if (isset($_SESSION['username'])) {
    header('location:../');
    exit();
}

if (isset($_POST['verifikasi'])) {
    $email = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['email'])));
    $kode = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['kode'])));
    $password = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['password'])));
    $kpassword = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['kpassword'])));
    
    $query_user = mysqli_query($konek, "SELECT * FROM user WHERE email = '$email'");
    $data_user = mysqli_fetch_assoc($query_user);

    if (empty($kode) || empty($email) || empty($password) || empty($kpassword)) {
        alert("gagal", "Masih ada data yang kosong", "edit/reset-password.php");
    } else if (mysqli_num_rows($query_user) !== 1) {
        alert("gagal", "Username atau Email tidak ditemukan.", "edit/reset-password.php");
    } else if ($data_user['random_kode'] != $kode) {
        alert("gagal", "Kode verifikasi tidak sesuai", "edit/reset-password.php");
    } else if ($password != $kpassword) {
        alert("gagal", "Konfirmasi password tidak sama.", "edit/reset-password.php");
    } else {
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);
        if (mysqli_query($konek, "UPDATE user SET password = '$hash_pass', random_kode = '' WHERE email = '$email' AND random_kode = '$kode'") == true) {
            alert("berhasil", "Password telah diubah. Silahkan login menggunakan password baru Anda.", "../edit");
        } else {
            alert("gagal", "Gagal input ke database.", "reset-password.php");
        }   
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Reset Password</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <style>
            td{
                color:white !important;
            }
            label{
                margin-right:10px;
            }
            button{
                margin-top:10px;
            }
            label{
                font-size:20px;
            }
            button{
                font-size:20px
            }
        </style>
    </head>
<body>
    <div class="card-footer text-muted">
        <p class="wm">Desainer : <a href="../menu/biodata/?absen=16">Gilang</a></p>
        <p class="wm">Programer : <a href="../menu/biodata/?absen=30">Andra</a> , <a href="../menu/biodata/?absen=36">Eris</a></p>
        <p class="wm">Jika tidak ada kode yang masuk segera hubungi Andra</p>
    </div>
    <form action="" method="POST">
        <h3>Reset Password</h3>
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

        <div class="container">
  
            <div class="row justify-content-md-center">
                <div class="col graduation">
                    <img src="img/graduation.png" alt="">
            </div>

            <div class="col login">
                <table>
                    <tr>
                        <td><label>Email  </label></td>
                        <td><input type="email" name="email" placeholder="Masukan Email"></td>
                    </tr>
                    <tr>
                        <td><label>Kode Verifikasi </label></td>
                        <td><input type="number" name="kode" placeholder="Masukan Kode"></td>
                    </tr>
                    <tr>
                        <td><label>Password Baru </label></td>
                        <td><input type="password" name="password" placeholder="Masukan Password"></td>
                    </tr>
                    <tr>
                        <td><label>Konfirmasi Password </label></td>
                        <td><input type="password" name="kpassword" placeholder="Masukan Password"></td>
                    </tr>
                </table>
                <button type="submit" name="verifikasi"> Verifikasi</button></td>
            </div>
        </div>
    </form>

    
</body>
</html>