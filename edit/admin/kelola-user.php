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

if (isset($_GET['hapus'])) {
    $hapus = $_GET['hapus'];
    mysqli_query($konek, "DELETE FROM user WHERE absen = '$hapus'");
    alert('berhasil', 'Data berhasil di hapus.', 'admin/kelola-user');
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Kelola User</title>
    </head>
<body>
    <h3>Kelola User</h3>
    
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
        
            <table border="1">
                <thead style="background:grey;">
                    <tr>
                        <td>Absen</td>
                        <td>Nama</td>
                        <td>Username</td>
                        <td>Level</td>
                        <td>Email</td>
                        <td>Aksi</td>
                    </tr>
                </thead>

                <?php 
                $query_user = mysqli_query($konek, "SELECT * FROM user ORDER BY absen ASC");
                while($data_user = mysqli_fetch_assoc($query_user)) :
                $absensi = $data_user['absen'];
                $query_bio = mysqli_query($konek, "SELECT * FROM biodata WHERE absen = '$absensi'");
                $data_bio = mysqli_fetch_assoc($query_bio)
                
                ?>
                
                <tbody>
                    <tr>
                        <td><?= $data_user['absen']; ?></td>
                        <td><?= $data_bio['nama']; ?></td>
                        <td><?= $data_user['username']; ?></td>
                        <td><?= $data_user['level']; ?></td>
                        <td><?= $data_user['email']; ?></td>
                        <td align="center">
                            <a href="ajax/edit-user?absen=<?= $data_user['absen']; ?>" title="Edit">Edit</a> |||
                            <a href="?hapus=<?= $data_user['absen']; ?>" title="Hapus" cstyle="font-color:red;">Hapus</a>
                        </td>
                    </tr>
                </tbody>
                <?php endwhile; ?>
            </table>
    
</body>
</html>