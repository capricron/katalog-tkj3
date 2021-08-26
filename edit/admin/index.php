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

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard Admin</title>
    </head>
<body>
    <h3>Dashboard Admin</h3><br><br>
    
    <h3>Menu Member</h3>
    <a href="../profile">Profile User</a><br><br>
    
    <h3>Menu Admin</h3>
    <a href="kelola-user">Kelola User</a><br><br>
    
    <a href="kelola-biodata">Kelola Biodata</a><br><br>
    
    <a href="input-user">Input User</a><br><br>
    
    <a href="input-biodata">Input Biodata</a><br><br>
    
    <a href="reset-password">Reset Password</a><br><br>
    
</body>
</html>