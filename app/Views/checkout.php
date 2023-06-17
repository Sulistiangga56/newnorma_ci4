<?php 
include 'header.php';
// $kd = mysqli_real_escape_string($conn,$_GET['kode_cs']);
// $cs = mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk = '$kd'");
// $rows = mysqli_fetch_assoc($cs);
?>

<div class="container" style="padding-bottom: 200px">
	<h2 style=" width: 100%; border-bottom: 4px solid #00008B"><b>Checkout</b></h2>
	<div class="row">
		<div class="col-md-6">
			<h4>Daftar Pesanan</h4>
			<table class="table table-stripped">
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Harga</th>
					<th>Qty</th>
					<th>Sub Total</th>
				</tr>
				<?php 
				$no = 1;
				$hasil = 0;
                foreach ($keranjang as  $row):
                    // $no = $key + 1;
                    // $hasil = $row['total_harga']
					?>
					<tr>
						<td><?= $no; ?></td>
						<td><?= $row['nama_produk']; ?></td>
						<td>Rp.<?= number_format($row['harga_produk']); ?></td>
						<td><?= $row['qty']; ?></td>
						<td>Rp.<?= number_format($row['harga_produk'] * $row['qty']);  ?></td>
					</tr>
					<?php 
					$total = $row['harga_produk'] * $row['qty'];
					$hasil += $total;
					$no++;
				endforeach;
				?>
				<tr>
					<td colspan="5" style="text-align: right; font-weight: bold;">Grand Total = <?= number_format($hasil); ?></td>
				</tr>
			</table>
		</div>

	</div>
	<div class="row">
	<div class="col-md-6 bg-success">
		<h5>Pastikan Pesanan Anda Sudah Benar</h5>
	</div>
	</div>
	<br>
	<div class="row">
	<div class="col-md-6 bg-warning">
		<h5>isi Form dibawah ini </h5>
	</div>
	</div>
	<br>
	<form action="<?= base_url('checkout') ?>" method="POST">
		<input type="hidden" name="kode_cs" value="<?= session()->get('kode_produk'); ?>">
		<div class="form-group">
			<label for="exampleInputEmail1">Nama</label>
			<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama" name="nama" style="width: 557px;" value="<?= session()->get('nama') ?>" readonly>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputPassword1">Provinsi</label>
					<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Provinsi" name="prov">
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputPassword1">Kota</label>
					<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Kota" name="kota">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputPassword1">Alamat</label>
					<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Alamat" name="alamat">
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputPassword1">Kode Pos</label>
					<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Kode Pos" name="kode_pos">
				</div>
			</div>
		</div>

		<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Order Sekarang</button>
		<a href="<?= base_url('keranjang') ?>" class="btn btn-danger">Cancel</a>
	</form>
</div>


<?php 
include 'footer.php';
?>