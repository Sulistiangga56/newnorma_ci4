<?php 
	include 'header.php';
 ?>

<!-- PRODUK TERBARU -->
<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid #00008B"><b>Produk Kami</b></h2>

	<div class="row">
		<?php 
		foreach ($produk as $row ) {
			?>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<img src="<?=base_url('image/produk/') .$row['gambar_produk']; ?>" >
					<div class="caption">
						<h3><?= $row['nama_produk'];  ?></h3>
						<h4>Rp.<?= number_format($row['harga_produk']); ?></h4>
						<div class="row">
							<div class="col-md-6">
								<a href="<?=base_url('detail/'). $row['kode_produk']; ?>" class="btn btn-warning btn-block">Detail</a> 
							</div>
							
								<div class="col-md-6">
									<a href="<?= base_url('keranjang/'.$row['kode_produk']) ?>" class="btn btn-success btn-block" role="button"><i class="glyphicon glyphicon-shopping-cart"></i> Tambah</a>
								</div>


						</div>

					</div>
				</div>
			</div>
			<?php 
		}
		?>
	</div>

</div>

 <?php 
	include 'footer.php';
 ?>