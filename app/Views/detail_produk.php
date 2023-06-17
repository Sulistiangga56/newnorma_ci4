<?php 
include 'header.php';

?>
<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid #00008B"><b>Detail produk</b></h2>

	<div class="row">
		<div class="col-md-4">
			<div class="thumbnail">
				<img src="<?= base_url('image/produk/'). $produk['gambar_produk']; ?>" width="400">
			</div>
		</div>

		<div class="col-md-8">
			<form action="<?= base_url('keranjang') ?>" method="POST">
				 <input type="hidden" name="kode_customer" value="<?= session()->get('kode_customer') ?>">
			
				<input type="hidden" name="kode_produk" value="<?= $produk['kode_produk'];  ?>"> 
				<!-- <input type="hidden" name="hal"  value="2"> -->
				<table class="table table-striped">
					<tbody>
						<tr>
							<td><b>Nama</b></td>
							<td><?= $produk['nama_produk']; ?></td>
						</tr>
						<tr>
							<td><b>Harga</b></td>
							<td>Rp.<?= number_format($produk['harga_produk']); ?></td>
						</tr>
						<tr>
							<td><b>Deskripsi</b></td>
							<td><?= $produk['deskripsi_produk'];  ?></td>
						</tr>
						<tr>
							<td><b>Jumlah</b></td>
							<td><input class="form-control" type="number" min="1" name="jml" value="1" style="width: 155px;"></td>
						</tr>
					</tbody>
				</table>
				<?php 
				if(session()->get('kode_customer') != null){
					?>
					<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Tambahkan ke Keranjang</button>
					<?php 
				}else{

					?>
					<a href="<?= base_url('/keranjang') ?>" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Tambahkan ke Keranjang</a>
					<?php 
				}
				?>
				<a href="<?= base_url('') ?>" class="btn btn-warning"> Kembali Belanja</a>
			</div>
		</form>
	</div>


</div>	
<br>
<br>

<?php 
include 'footer.php';
?>