<?php

session_start();
require 'include/function.php';

if (isset($_SESSION['username'])) {
    header('location:../');
    exit();
}

if (isset($_POST['kirim_kode'])) {
    $username = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['username'])));
    $email = htmlspecialchars(trim(mysqli_real_escape_string($konek, $_POST['email'])));

    $query_user = mysqli_query($konek, "SELECT * FROM user WHERE username = '$username' AND email = '$email'");
    $data_user = mysqli_fetch_assoc($query_user);
    $absen = $data_user['absen'];

    if (empty($username) || empty($email)) {
        alert("gagal", "Masih ada data yang kosong", "edit/kirim-kode.php");
    } else if (mysqli_num_rows($query_user) !== 1) {
        alert("gagal", "Username atau Email tidak ditemukan.", "edit/kirim-kode.php");
    } else {
        $kode_verifikasi = mt_rand(100000, 999999);
        mysqli_query($konek, "UPDATE user SET random_kode = '$kode_verifikasi' WHERE username = '$username' AND email = '$email'");
        
        // $tujuan = $email;
        // $pesannya = "
        // <p> Halo, ".$username."!</p>
        
        // <p> Anda telah melakukan Reset Password di Katalog TKJ 3. Berikut kami berikan kode verifikasi Anda. Jangan berikan kode ini kepada siapapun. Butuh Bantuan? Hubungi Developer.</p>
        // <hr>
        // <p><center><b> Kode Verifikasi : ".$kode_verifikasi."</b></center></p>
        // <hr>
        // <p>
        // <b> Time :</b> ".$tanggal." ".$waktu."<br/>
        // <b> IP address :</b> ".get_client_ip()."<br/>
        // <b> Browser :</b> ".$_SERVER['HTTP_USER_AGENT']."<br/>
        // </p>
        // <hr>
        // <p><center><b> - TKJ 3 DEV TEAM - </center></p>

        
        // ";                 
        
        // $subjek = "[TKJ 3] - Reset Password 🔐";
        // $header = "From: support@mysossmed.web.id \r\n";
        // $header .= "Cc: support@mysossmed.web.id \r\n";
        // $header .= "MIME-Version: 1.0\r\n";
        // $header .= "Content-type: text/html\r\n";
        // $send = mail ($tujuan, $subjek, $pesannya, $header);
        
        $queryBio = mysqli_query($konek, "SELECT * FROM biodata WHERE absen = '$absen'");
        $dataBio = mysqli_fetch_assoc($queryBio);
        
        $wa = "62".$dataBio['url'];
        // $pesan = "*[ KATALOG TKJ 3 ]*\nHalo ".$username.", Ada perangkat lain yang mencoba untuk melakukan reset password akun kamu di Web Katalog TKJ 3. Hubungi Tim Pengembang Website jika memerlukan bantuan.";
        $pesan = "*[ KATALOG TKJ 3 ]*\nHalo ".$username.", Ini adalah kode rahasia untuk mengubah password anda jangan bagikan ke siapapun. Kode rahasia : $kode_verifikasi";
        require 'include/bot.php';
        
        if ($bot['status'] === true) {
            alert("berhasil", "Kode verifikasi telah dikirim ke Nomor Anda.", "edit/reset-password.php");
        } else {
            alert("gagal", $order['data']['msg'], "auth/kirim-kode");
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Kirim Kode</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="style.css">
        <style>
            @media (max-width:1000px){
                button{
                    width: 200px;
                }
            }
        </style>
    </head>
<body>
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


        <div class="container">
  
            <div class="row justify-content-md-center">
                <div class="col graduation">
                        <img src="img/graduation.png" alt="">
                </div>
                <div class="col login">
                    <div class="username">
                        <table>
                        <tr>                  
                            <td  class="label"><label>Username</label></td>
                            <td><input type="text" name="username" placeholder="Masukan Username"></td>
                        </tr>
                        </table>
                    </div>

                    <div class="password">
                        <table>
                            <tr>
                                <td class="label"><label>Email </label></td>
                                <td><input type="email" name="email" placeholder="Masukan Email"></td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <button type="submit" name="kirim_kode"> Kirim Kode</button>
                </div>
            </div>
        </div>
    </form>
    
</body>
</html>