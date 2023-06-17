<?php 
include 'header.php';
// dd($result)
?>

<div class="container">
	<div class="" >
		<div class="">
			<div class="">
				<div class="">
					<h4 class="modal-title" id="myModalLabel">#<?= $result[0]['invoice']; ?></h4>
				</div>
				<div class="modal-body">
					<table class="table table-striped">
						<tr>
							<td>Invoice</td>
							<td><?= $result[0]['invoice']; ?></td>
						</tr>
						<tr>
							<td>Kode Customer</td>
							<td><?= $result[0]['kode_customer']; ?></td>
						</tr>
						<tr>
							<td>Nama</td>
							<td><?= $result[0]['nama'] ?></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td><?php echo  $result[0]['alamat'].",".$result[0]['kota']." ".$result[0]['provinsi'].",".$result[0]['kode_pos']; ?></td>
						</tr>
						<tr>
							<td>No Telp</td>
							<td><?= $result[0]['telp'] ?></td>
						</tr>
					</table>

					<hr>
					<h4>List Order</h4>
					<table class="table table-striped">
						<tr>
							<th>No</th>
							<th>Kode Produk</th>
							<th>Nama Produk</th>
							<th>Harga</th>
							<th>qty</th>
							<th>Subtotal</th>
						</tr>
					<?php 
						// $order = mysqli_query($conn, "SELECT * FROM produksi WHERE invoice = '$invoices'");
						$no = 1;
						$grand = 0;
                        foreach ($result as $list) {
					 ?>
						<tr>
							<td><?= $no;  ?></td>
							<td><?= $list['kode_produk']; ?></td>
							<td><?= $list['nama_produk']; ?></td>
							<td><?= number_format($list['harga'], 0, ".", ".");  ?></td>
							<td><?= $list['qty'];  ?></td>
							<td><?= number_format($list['harga']*$list['qty'], 0, ".", ".");  ?></td>
						</tr>
					<?php 
						$sub = $list['harga'] * $list['qty'];
						$grand += $sub;
						$no++;
						}
					 ?>
						<tr>
							<td colspan="6" class="text-right"><b>Grand Total = <?= number_format($grand, 0, ".", ".");  ?></b></td>
						</tr>
					</table>
                    <a href="<?= base_url('admin/produksi') ?>" class="btn btn-info">Kembali</a>
				</div>
				
			</div>
		</div>
	</div>

		<?php 
if(0 > 0){
 ?>
	<br>
	<br>
	<div class="row">
		<div class="col-md-4 bg-danger" style="padding:10px;">
			<h4>Kekurangan Material </h4>
			<h5 style="color: red;font-weight: bold;">Silahkan Tambah Stok Material dibawah ini : </h5>
			<table class="table table-striped">
				<tr>
					<th>No</th>
					<th>Material</th>
				</tr>
	<?php 
	$arr = array_values(array_unique($nama_material));
	for ($i=0; $i < count($arr); $i++) { 

	 ?>
				<tr>
					<td><?= $i+1 ?></td>
					<td><?= $arr[$i]; ?></td>
				</tr>
	<?php } ?>
			</table>
		</div>
	</div>
<?php 
}
 ?>
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
<script type="text/javascript">
	$( document ).ready(function() {
		$( "#btn" ).click();
	});
</script>

	<?php 
	include 'footer.php';
	?>