<?php 
echo $this->include('admin/header');

?>
<style type="text/css">
	@media print{
		.print{
			display: none;
		}
	}
</style>
<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray; padding-bottom: 5px;"><b>Laporan profit</b></h2>
	<div class="row print">
		<div class="col-md-9">
			<form action="<?= base_url('admin/laporan/profit') ?>" method="POST">
				<table>
					<tr>
						<td><input type="date" name="date1" class="form-control" value="<?= $date1; ?>"></td>
						<td>&nbsp; - &nbsp;</td>
						<td><input type="date" name="date2" class="form-control" value="<?= $date2; ?>"></td>
						<td> &nbsp;</td>
						<td><input type="submit" name="submit" class="btn btn-primary" value="Tampilkan"></td>
					</tr>
				</table>
			</form>
			
		</div>
		<div class="col-md-3">
			<form action="<?= base_url('admin/laporan/profit/export') ?>" method="POST">
				<table>
					<tr>
						<td><input type="hidden" name="date1" class="form-control" value="<?= $date1; ?>"></td>
						<td><input type="hidden" name="date2" class="form-control" value="<?= $date2; ?>"></td>
						<td><button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save-file"></i> Export to Excel</button></td>
						<td> &nbsp;</td>
						<td><a href="" onclick="window.print()" class="btn btn-default"><i class="glyphicon glyphicon-print"></i> Cetak</a></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<br>
	<br>

	<table class="table table-striped">
		<tr>
			<th>No</th>
			<th>Invoice</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>qty</th>
			<th>Subtotal</th>
			<th>tanggal</th>
		</tr>
		<?php 
		
			// $result = mysqli_query($conn, "SELECT * FROM produksi WHERE terima = 1 and tanggal between '$date1' and '$date2'");
			$no=1;
			$total = 0;
			foreach ($result as $row) :
				?>
				<tr>
					<td><?= $no; ?></td>
					<td><?= $row['invoice']; ?></td>
					<td><?= $row['nama_produk']; ?></td>
					<td><?=  number_format($row['harga']); ?></td>
					<td><?= $row['qty']; ?></td>
					<td><?= number_format($row['harga']*$row['qty']); ?></td>
					<td><?= $row['tanggal']; ?></td>
				</tr>
				<?php 
				$total += $row['harga']*$row['qty'];
				$no++;
			
endforeach;
			?>
			<tr>
				<td colspan="7" class="text-right"><b>Total Pendapatan Kotor = <?= number_format($total); ?></b></td>
			</tr>
       
		</table>
		<hr>
		<!-- <h4><b>Pemotongan dengan Biaya Bahan Baku</b></h4> -->
		
</div>

<br>
<br>
<br>
<br>
<br>


<?php 
echo $this->include('admin/footer');
?>