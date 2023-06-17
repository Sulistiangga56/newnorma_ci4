<?php 
include 'header.php';
?>


<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Master Produk</b></h2>
    <?php if(session()->getFlashdata('success')): ?>
		<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
	<?php endif; ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">Kode Poroduk</th>
					<th scope="col">Nama Produk</th>
					<th scope="col">Image</th>
					<th scope="col">Harga</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				// $result = mysqli_query($conn, "SELECT * FROM produk");
				$no =1;
                foreach ($result as $row) {
				// while ($row = mysqli_fetch_assoc($result)) {
				?>
					<tr>
						<td ><?= $no; ?></td>
						<td><?= $row['kode_produk']; ?></td>
						<td><?= $row['nama_produk'];  ?></td>
						<td><img src="<?= base_url('/image/produk/'.$row['gambar_produk']) ?>" width="100"></td>
						<td>Rp.<?= number_format($row['harga_produk' ]);  ?></td>
						<td><a href="<?= base_url('/admin/produk/'. $row['kode_produk'].'/edit') ?>" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i> </a> 
                        <form action="<?= base_url('/admin/produk/'. $row['kode_produk']. '/delete') ?>" method="POST" style="display:inline-block">
                        	<input type="hidden" name="_method" value="DELETE">
                        	<button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i class="glyphicon glyphicon-trash"></i></button>
                        </form>
                        <!-- <a href="<= base_url('/admin/produk/'. $row['kode_produk']. '/delete') ?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i class="glyphicon glyphicon-trash"></i> </a> -->
                        <a href="<?= base_url('admin/kebutuhan/'.$row['kode_produk']) ?>"  class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i> Lihat BOM</button></td>
					</tr>
				<?php
					$no++; 
					}
				 ?>

				</tbody>
			</table>
		<a href="<?= base_url('admin/produk/tambah') ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Produk</a>
	</div>
	<!-- Button trigger modal -->

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