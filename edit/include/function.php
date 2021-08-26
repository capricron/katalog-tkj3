<?php 

// $konek =  mysqli_connect("sql210.epizy.com","epiz_28842786","l8MlUmqbdHJj","epiz_28842786_katalog");
$konek = mysqli_connect('Localhost','root','','wikwik');
$judul = "Katalog TKJ 3 - SMKN 8";
$link = "https://tkj3.rizkyandra.site";

date_default_timezone_set('Asia/Jakarta');
$tanggal = date('d M Y');
$waktu = date('G:i:s');

function alert($tipe, $isi, $lokasi) {
    setcookie($tipe, $isi, time()+2, '/');
    header("location:../" . $lokasi);
    exit();
}
	
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'IP tidak dikenali';
    return $ipaddress;
}

?>