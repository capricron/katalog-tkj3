<?php
    require '../../edit/include/function.php';
    $absen = $_GET["absen"];
    $query = mysqli_query($konek,"SELECT * FROM biodata WHERE absen = $absen");
    $data = mysqli_fetch_assoc($query)  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Biodata</title>
    <!-- css bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- css dewe -->
    <link rel="stylesheet" href="stylesheet.css">

    <script src="jquery-3.6.0.js"></script>
    <!-- anggota -->
    <link rel="stylesheet" href="anggota.css">

</head>
<body class="b<?=$data["absen"]?>">
    <!-- utama -->
    <div class="" id="">
        <div class="row" id="atas">          
            <div class="q col-md-4 col-sm-12">
                <div class="identitas">
                    <div class="nama">
                        <p class="tag"><?=$data["tag"]?></p>
                        <h1 class="name" style="margin-top: -20px;"><?=$data["nama"]?></h1>
                        <p class="birthday"><?= $data["ttl"]?></p>
                    </div>
                    <div class="icon">
                            <a id="i1" class="wa" href="https://api.whatsapp.com/send?phone=+62<?=$data["url"]?>" target="_blank">
                                <img class="ikon1" src="img/icon/wa.png">
                                <p class="p1" style="display:inline-block; opacity: 0;"><?=$data["wa"]?></p>
                            </a>
                            <a id="i2" href="https://www.instagram.com/<?=$data["ig"]?>" class="ig" target="_blank">
                                <img class="ikon2" src="img/icon/ig.png" alt="" srcset="">
                                <p class="p2" style="display:inline-block; opacity: 0;">@<?=$data["ig"]?></p>
                            </a>
                            <a id="i3" href="<?=$data["alamat"]?>" class="maps" target="_blank">
                            <img src="img/icon/maps.png" alt="" srcset="">
                                <p class="p2" style="display:inline-block; opacity: 0;">p</p>
                            </a>
                            <a id="i4" href="../../edit" class="change">
                                <img src="img/icon/change.png" alt="">
                            </a>
                    </div>
                </div>
            </div>

            <div class=" w col-md-4 col-sm-12 " >
              <div class="gambar">
                <img class="orang g<?=$data["absen"]?>" id="man" src="img/bio/<?=$data["foto biodata"]?>">
              </div>
            </div>
            
            <div class=" e col-md-4 col-sm-12 text-left">
                <div class="biodata">
                    <section class="quotes">
                        <h3><b><i><?=$data["quotes"]?></i></b></h3>
                    </section>
                        <br>
                    <section class="deskripsi">
                        <h1><?=$data["deskripsi"]?></h1>
                    </section>
                </div>
            </div>
        </div>
    </div>    
    <!-- js bootstrap -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <!-- jquery -->

    <!-- script ku dewe -->
    <!-- <script src="script.js"></script> -->
</body>
</html>