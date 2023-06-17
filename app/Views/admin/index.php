<?php

include 'header.php';
// pesanan baru 
// $result1 = mysqli_query($conn, "SELECT distinct invoice FROM produksi WHERE terima = 0 and tolak = 0");
$jml1 = 0;

// pesanan dibatalkan/ditolak
// $result2 = mysqli_query($conn, "SELECT distinct invoice FROM produksi WHERE  tolak = 1");
$jml2 = 0;

// pesanan diterima
// $result3 = mysqli_query($conn, "SELECT distinct invoice FROM produksi WHERE  terima = 1");
$jml3 = 0;

?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div style="background-color: #dfdfdf; padding-bottom: 60px; padding-left: 20px;padding-right: 20px; padding-top: 10px;">
                <h4>PESANAN BARU</h4>
                <h4 style="font-size: 56pt;"><b><?= $pesanan_baru; ?></b></h4>
            </div>
        </div>

        <div class="col-md-4">
            <div style="background-color: #dfdfdf; padding-bottom: 60px; padding-left: 20px;padding-right: 20px; padding-top: 10px;">
                <h4>PESANAN DIBATALKAN</h4>
                <h4 style="font-size: 56pt;"><b><?= $pesanan_ditolak; ?></b></h4>
            </div>
        </div>

        <div class="col-md-4">
            <div style="background-color: #dfdfdf; padding-bottom: 60px; padding-left: 20px;padding-right: 20px; padding-top: 10px;">
                <h4>PESANAN DITERIMA</h4>
                <h4 style="font-size: 56pt;"><b><?= $pesanan_diterima; ?></b></h4>
            </div>
        </div>

    </div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<br>
<?php
include 'footer.php';
?>