<?php
include 'header.php';
// generate kode material
$db = \Config\Database::connect();
$kode = $db->table('produk')
    ->select('kode_produk')
    ->orderBy('kode_produk', 'DESC')
    ->get()
    ->getRowArray();

if (isset($kode['kode_produk'])) {
    $num = substr($kode['kode_produk'], 1); // Mengambil angka dari kode produk
    $add = (int) $num + 1;
    $format = sprintf("P%03d", $add); // Format kode produk dengan leading zero
} else {
    $format = "P001"; // atau tentukan nilai default lainnya jika tidak ada kode produk sebelumnya
}
?>

<div class="container">
    <h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Tambah Produk</b></h2>
    <!-- add validation error view -->
    <?= validation_list_errors() ?>

    <form action="<?= base_url('admin/produk/tambah') ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputFile">Pilih Gambar</label>
            <input type="file" id="exampleInputFile" name="gambar_produk">
            <p class="help-block">Pilih Gambar untuk Produk</p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Kode Produk</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk" disabled value="<?= $format; ?>">
                    <input type="hidden" name="kode_produk" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk" value="<?= $format; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Produk</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk" name="nama_produk" value="<?= old('nama_produk') ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Harga</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Contoh : 12000" name="harga_produk" value="<?= old('harga_produk') ?>">
                    <p class="help-block">Isi Harga tanpa menggunakan Titik(.) atau Koma (,)</p>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Deskripsi</label>
            <textarea name="deskripsi_produk" class="form-control"><?= old('deskripsi_produk') ?></textarea>
        </div>

        <div class="form-group row" id="select-material">
            <div class="col-md-6">
                <label for="select-material">Pilih material yang dibutuhkan untuk produk</label>
                <?php
                $result3 = $db->table('inventory')->select('*')->get()->getResultArray();
                ?>
                <?php foreach ($result3 as $index => $item) : ?>
                    <div class="row material-row">
                        <div class="col-md-6">
                            <select class="form-select" name="material[]" aria-label="pilih material" id="select-material<?= $index ?>">
                                <option value="<?= $item['kode_bk'] ?>"><?= $item['nama'] ?></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" id="kebutuhan<?= $index ?>" placeholder="Contoh : 4" name="kebutuhan-material[]" value="<?= old('kebutuhan') ?>">
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <div class="row py-4" style="margin-bottom: 4px">
            <div class="col-md-6">
                <button class="btn btn-success" id="tambah-material">Tambah Material</button>
            </div>
        </div>

        <div class="row py-4">
            <div class="col-md-6">
                <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Tambah</button>
                <a href="<?= base_url('admin/produk') ?>" class="btn btn-danger">Cancel</a>
            </div>
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

<script>
    $(document).ready(function() {
        $('#tambah-material').click(function(e) {
            e.preventDefault();
            var newIndex = $('.material-row').length;
            var newRow = `
                <div class="row material-row">
                    <div class="col-md-6">
                        <select class="form-select" name="material[]" aria-label="pilih material" id="select-material${newIndex}">
                            <?php foreach ($result3 as $item) : ?>
                                <option value="<?= $item['kode_bk'] ?>"><?= $item['nama'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input type="number" class="form-control" id="kebutuhan${newIndex}" placeholder="Contoh : 4" name="kebutuhan-material[]" value="<?= old('kebutuhan') ?>">
                    </div>
                </div>
            `;
            $('#select-material').append(newRow);
        });
    });
</script>

<?php
include 'footer.php';
?>
