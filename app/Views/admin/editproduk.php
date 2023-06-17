<?php 
include 'header.php';
// generate kode material


?>


<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Edit Produk</b></h2>
    <?= 
        validation_list_errors()
    ?>

	<form action="<?= base_url('admin/produk/'. $data['kode_produk'] .'/edit') ?>" method="POST" enctype="multipart/form-data">

		<div class="form-group">
			<label for="exampleInputFile"><img src="<?= base_url('/image/produk/'.$data['gambar_produk']) ?>" width="100"></label>
			<input type="file" id="exampleInputFile" name="gambar_produk">
			<p class="help-block">Pilih Gambar untuk Produk</p>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1">Kode Produk</label>
					<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk" disabled value="<?= $data['kode_produk']; ?>">
					<input type="hidden" name="kode_produk" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk"  value="<?= $data['kode_produk']; ?>">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Produk</label>
					<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk" name="nama_produk" value="<?= $data['nama_produk']; ?>">
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1">Harga</label>
					<input type="number" class="form-control" id="exampleInputEmail1" placeholder="masukkan Harga" name="harga_produk" value="<?= $data['harga_produk']; ?>">
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="exampleInputPassword1">Deskripsi</label>
			<textarea name="deskripsi_produk" class="form-control"><?= $data['deskripsi_produk']; ?></textarea>
		</div>
		<hr>
		<h3 style=" width: 100%; border-bottom: 4px solid gray">BOM Produk</h3>

		
		<div class="row">
			
			<div class="col-md-6">
				<button type="submit"  class="btn btn-warning btn-block" ><i class="glyphicon glyphicon-edit"></i> Edit</button>
			</div>	
			<div class="col-md-6">
				<a href="<?php echo base_url('admin/produk'); ?>" class="btn btn-danger btn-block">Cancel</a>
			</div>
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