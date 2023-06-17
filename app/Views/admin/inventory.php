<?php 
include 'header.php';


?>


<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Inventory Material</b></h2>
    <?php if(session()->getFlashdata('success')): ?>
		<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
	<?php endif; ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">Kode Matrial</th>
				<th scope="col">Nama</th>
				<th scope="col">Stok</th>
				<th scope="col">Satuan</th>
				<th scope="col">Harga</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			// $result = mysqli_query($conn, "SELECT * FROM inventory order by kode_bk asc");
			$no =1;
			foreach ($result as $row) {
				?>
				<tr>

					<th scope="row"><?php echo $no; ?></th>
					<td><?= $row['kode_bk'];  ?></td>
					<td><?= $row['nama'];  ?></td>
					<td><?= $row['qty'];  ?></td>
					<td><?= $row['satuan'];  ?></td>
					<td><?php  echo "".number_format($row['harga'])."/".$row['satuan'];  ?></td>
					<td>
                        <a href="<?= base_url('/admin/inventory/'. $row['kode_bk']. '/edit') ?>" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i> </a> 
                        <!-- <a href="inventory.php?kode=<php echo $row['kode_bk'];?>&page=del" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i class="glyphicon glyphicon-trash"></i> </a> -->
                        <form action="<?= base_url('/admin/inventory/'. $row['kode_bk']. '/delete') ?>" method="POST" style="display:inline-block">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i class="glyphicon glyphicon-trash"></i></button>
                        </form>
                    </td>

				</tr>
				<?php 
				$no++;
			}
			?>
		</tbody>
	</table>
	<a href="<?= base_url('admin/inventory/tambah') ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Material</a>
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