<?php 
include 'header.php';

// generate kode material
$db = \Config\Database::connect();
$kode = $db->query("SELECT kode_bk FROM inventory ORDER BY kode_bk DESC LIMIT 1");
$data = $kode->getRowArray();

if ($data) {
    $num = (int) substr($data['kode_bk'], 1, 3);
    $add = $num + 1;
    $format = "M" . str_pad($add, 3, '0', STR_PAD_LEFT);
} else {
    $format = "M001";
}
?>




<div class="container">
    <h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Tambah Material</b></h2>

    <form action="<?= base_url('admin/inventory/tambah') ?>" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Kode Material</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" disabled value="<?php echo $format; ?>">

                    <input type="hidden" class="form-control" id="exampleInputEmail1"  name="kode_bk" value="<?php echo $format; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Material</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Material" name="nama">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Stok</label>
                    <input type="number" class="form-control" id="exampleInputEmail1"  name="qty" placeholder="contoh 2 atau 0.4" min="1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Satuan</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Contoh : Kg atau gram" name="satuan">
                    <p class="help-block">Hanya Masukkan Satuan saja : Kg atau gram</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Harga</label>
                    <input type="number" class="form-control" id="exampleInputEmail1"  name="harga" placeholder="Contoh : 1000" min="1">
                    <p class="help-block">Harga termasuk harga per kg atau per gram</p>
                </div>
            </div>
        </div>
        <button type="submit"  class="btn btn-success" ><i class="glyphicon glyphicon-plus-sign"></i> Tambah</button>
        <a href="inventory.php" class="btn btn-danger">Cancel</a>
    </form>
</div>

<br>

</div>
</form>

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

<?php 
include 'footer.php';
?> 
