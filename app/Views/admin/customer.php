<?php 
include 'header.php';
?>

<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Data Customer</b></h2>
    <?php if(session()->getFlashdata('success')): ?>
		<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
	<?php endif; ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">Kode Customer</th>
				<th scope="col">Nama</th>
				<th scope="col">Email</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			
			$no =1;
			foreach ($result as $row) {
				?>
				<tr>

					<th scope="row"><?php echo $no; ?></th>
					<td><?= $row['kode_customer'];  ?></td>
					<td><?= $row['nama'];  ?></td>
					<td><?= $row['email'];  ?></td>
					<td>
                        <!-- <a href="m_customer.php?kode=<php echo $row['kode_customer'];?>&page=del" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i class="glyphicon glyphicon-trash"></i> </a> -->
                        <form action="<?= base_url('/admin/customer/'. $row['kode_customer']. '/delete') ?>" method="POST" style="display:inline-block">
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
