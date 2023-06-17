<?php 
include 'header.php';
?>
<!-- IMAGE -->
<div class="container-fluid" style="margin: 0;padding: 0;">
	<div class="image" style="margin-top: -21px">
		<img src="image/home/home.jpg" style="width: 100%;  height: 650px;">
	</div>
</div>
<br>
<br>

<!-- PRODUK TERBARU -->
<div class="container">


		<h4 class="text-center" style="font-family: arial; padding-top: 10px; padding-bottom: 10px; font-style: italic; line-height: 29px; border-top: 2px solid #00008B; border-bottom: 2px solid #00008B;">New Normal Fashion adalah salah satu pelopor pertama dalam bisnis fashion modern pasca covid di Indonesia. Didirikan pada tahun 2022,  saat ini dikelola di bawah PT. Politeknik Negeri Jakarta. Produk kami sehat, kualitas sangat bagus, dan terjangkau oleh semua orang.</h4>


	<h2 style=" width: 100%; border-bottom: 4px solid #00008B; margin-top: 80px;"><b>Produk Kami</b></h2>

	<div class="row">
		<?php 
		
        foreach ($produk as $row) {
			?>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<img src="<?= base_url('/image/produk/'. $row['gambar_produk']) ?>" >
					<div class="caption">
						<h3><?= $row['nama_produk'];  ?></h3>
						<h4>Rp.<?= number_format($row['harga_produk']); ?></h4>
						<div class="row">
							<div class="col-md-6">
								<a href="<?= base_url('/detail/'). $row['kode_produk']; ?>" class="btn btn-warning btn-block">Detail</a> 
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
<br>
<br>
<br>
<br>
<?php 
include 'footer.php';
?>