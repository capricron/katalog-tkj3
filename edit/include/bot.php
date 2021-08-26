<?php

$url = "https://mysossmed.web.id/api/bot.php";
// $pesan = "*[ VERIFIKASI ]*\nHalo ".$username."! Anda telah melakukan reset password. Berikut kami berikan kode verifikasi Anda.\n\n*Kode Verifikasi : ".$kode_verifikasi."*\n\nJangan berikan kode ini kepada siapapun. Hubungi Tim Pengembang Website jika memerlukan bantuan.";

$curlHandle = curl_init();
curl_setopt($curlHandle, CURLOPT_URL, $url);
curl_setopt($curlHandle, CURLOPT_POSTFIELDS, "api_key=2021-0606-1204-2003&action=bot-tkj3&whatsapp=$wa&pesan=$pesan");
curl_setopt($curlHandle, CURLOPT_HEADER, 0);
curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
curl_setopt($curlHandle, CURLOPT_POST, 1);
$result = curl_exec($curlHandle);

$bot = json_decode($result, true);

?>