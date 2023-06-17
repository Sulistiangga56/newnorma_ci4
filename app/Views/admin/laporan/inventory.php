<?php 
echo $this->include('admin/header');
$date = date('yy-m-d');

if(isset($_POST['submit'])){
	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];
}
?>
<style type="text/css">
	@media print{
		.print{
			display: none;
		}
	}
</style>
<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray; padding-bottom: 5px;"><b>Laporan Inventory</b></h2>
	<div class="row print">
		<div class="col-md-9">
			<form action="<?= base_url('admin/laporan/inventory') ?>" method="POST">
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
			<form action="<?= base_url('admin/laporan/inventory/export') ?>" method="POST">
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
			<th>Nama Bahan Baku</th>
			<th>qty</th>
			<th>Satuan</th>
			<th>tanggal</th>
		</tr>
		<?php 
		
		$no=1;
		$total = 0;
        // dd($result);
		foreach ($result as $row) {
			?>
			<tr>
				<td><?= $no; ?></td>
				<td><?= $row['nama']; ?></td>
				<td><?= $row['qty']; ?></td>
				<td><?= $row['satuan']; ?></td>
				<td><?= $row['tanggal']; ?></td>
			</tr>
			<?php 
			$total += $row['qty'];
			$no++;
		

            } 
		?>
		<tr>
			<td colspan="5" class="text-right"><b>Jumlah semua bahan baku = <?= $total; ?></b></td>
		</tr>
	</table>
</div>

<br>
<br>
<br>
<br>
<br>


<?php 
echo $this->include('admin/footer');
?>