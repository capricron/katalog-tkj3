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
    mysqli_query($konek, "DELETE FROM biodata WHERE absen = '$hapus'");
    alert('berhasil', 'Data berhasil di hapus.', 'admin/kelola-biodata');
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Kelola Biodata</title>
    </head>
<body>
    <h3>Kelola Biodata</h3>
    
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
                        <td>Foto Biodata</td>
                        <td>Foto Menu</td>
                        <td>Tempat, Tanggal Lahir</td>
                        <td>Deskripsi</td>
                        <td>Quotes</td>
                        <td>Alamat</td>
                        <td>Instagram</td>
                        <td>URL</td>
                        <td>WhatsApp</td>
                        <td>Tag</td>
                        <td>Aksi</td>
                    </tr>
                </thead>

                <?php 
                $query_bio = mysqli_query($konek, "SELECT * FROM biodata ORDER BY absen ASC");
                while($data_bio = mysqli_fetch_assoc($query_bio)) :
                ?>
                
                <tbody>
                    <tr>
                        <td><?= $data_bio['absen']; ?></td>
                        <td><?= $data_bio['nama']; ?></td>
                        <td><?= $data_bio['foto biodata']; ?></td>
                        <td><?= $data_bio['foto menu']; ?></td>
                        <td><?= $data_bio['ttl']; ?></td>
                        <td><?= $data_bio['deskripsi']; ?></td>
                        <td><?= $data_bio['quotes']; ?></td>
                        <td><?= $data_bio['alamat']; ?></td>
                        <td><?= $data_bio['ig']; ?></td>
                        <td><?= $data_bio['url']; ?></td>
                        <td><?= $data_bio['wa']; ?></td>
                        <td><?= $data_bio['tag']; ?></td>
                        <td align="center">
                            <a href="ajax/edit-bio?absen=<?= $data_bio['absen']; ?>" title="Edit">Edit</a> |||
                            <a href="?hapus=<?= $data_bio['absen']; ?>" title="Hapus" cstyle="font-color:red;">Hapus</a>
                        </td>
                    </tr>
                </tbody>
                <?php endwhile; ?>
            </table>
    
</body>
</html>