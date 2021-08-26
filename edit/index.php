<?php

session_start();
require 'include/function.php';

if (isset($_SESSION['username'])) {
    header('location:../');
    exit();
}

if (isset($_POST['tombol'])) {
    if (isset($_POST['username']) AND isset($_POST['password'])) {

        $username = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['username'])));
        $password = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['password'])));

        $q = mysqli_query($konek, "SELECT * FROM user WHERE username = '$username'");
        $queryLogin = mysqli_fetch_assoc($q);

        if (empty($username) || empty($password)) {
            alert("gagal", "Masih ada data yang kosong", "edit");
        } else if ($username !== $queryLogin['username']) {
            alert("gagal", "Username atau Password salah", "edit");
        } else if (mysqli_num_rows($q) !== 1) {
            alert("gagal", "Username atau Password salah", "edit");
        } else if (password_verify($password, $queryLogin['password'])) {
            $_SESSION['username'] = $queryLogin['username'];
            $sess_username = $_SESSION['username'];
            $queryUser = mysqli_query($konek, "SELECT * FROM user WHERE username = '$sess_username'");
            $dataUser = mysqli_fetch_assoc($queryUser);
            $absen = $dataUser['absen'];
            
            $queryBio = mysqli_query($konek, "SELECT * FROM biodata WHERE absen = '$absen'");
            $dataBio = mysqli_fetch_assoc($queryBio);
            
            $wa = "62".$dataBio['url'];
            $pesan = "*[ KATALOG TKJ 3 ]* Halo ".$sess_username.", Akun anda telah Login di Website Katalog dengan IP ".get_client_ip()." Jika bukan anda segera lakukan ganti password.";
            require 'include/bot.php';
            
            if ($bot['status'] === true) {
                // if ($dataUser['level'] == "Admin") {
                //     header("location: admin");
                //     exit();
                // } else {
                    header("location: profile/index.php");
                    exit();
                // }
            } else {
                alert("gagal", $order['data']['msg'], "edit");
            }
            
        } else {
            alert("gagal", "Username atau password salah", "edit");
        }
    } else {
        alert("gagal", "Username atau password salah", "edit");
    }

}

?>

<!DOCTYPE html>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <title>Login</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    </head>
<body>
    <a href="../"> <i class="material-icons home">home</i></a>
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
        

        <div class="container">
  
            <div class="row justify-content-md-center">
                <div class="col graduation">
                        <img src="img/graduation.png" alt="">
                </div>
                <div class="col login">
                    <div class="username">
                        <table>
                        <tr>
                            <td class='logo'><img src="img/user.png" alt="" srcset=""></td>
                            <td  class="label"><label>Username</label></td>
                            <td><input class="input sama" type="text" required="" placeholder="Masukkan Username" name="username"></td>
                        </tr>
                        </table>
                    </div>

                    <div class="password">
                       <table>
                            <tr>
                                <td class='logo'><img src="img/pw.png" alt="" srcset=""></td>
                                <td class="label"><label>Password </label></td>
                                <td><input class="input sama" type="password" required="" placeholder="Masukkan Password" name="password"></td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="submit">
                        <table>
                            <td class="logo"><img src="img/verify.png" alt=""></td>
                            <td class="label"><button style="margin-left:15px" type="submit" name="tombol"> Login</button></td>
                            <td><a class="reset sama"  href="kirim-kode.php">Reset Password?</a></td>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="card-footer text-muted">
        <p class="wm">Desainer : <a href="../menu/biodata/?absen=16">Gilang</a></p>
        <p class="wm">Programer : <a href="../menu/biodata/?absen=30">Andra</a> , <a href="../menu/biodata/?absen=36">Eris</a></p>
    </div>
    
</body>
</html>