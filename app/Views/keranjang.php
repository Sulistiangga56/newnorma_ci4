<?php 
include 'header.php';

?>


<div class="container" style="padding-bottom: 300px;">
	<h2 style=" width: 100%; border-bottom: 4px solid #00008B"><b>Keranjang</b></h2>
		<table class="table table-striped">
			<?php 
				// $kode_cs = $_SESSION['kd_cs'];
			// CEK JUMLAH KERANJANG
				// $cek = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_customer = '$kode_cs'");
				$jml = count($keranjang);
				if($jml > 0){
					?>	
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Image</th>
							<th scope="col">Nama</th>
							<th scope="col">Harga</th>
							<th scope="col">Qty</th>
							<th scope="col">SubTotal</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
                        <?php 
                            foreach($keranjang as $key => $row):
                                $no = $key + 1;
                                $hasil = $row['total_harga']
                        ?>
					<form action="<?= base_url('keranjang/'. $row['id_keranjang'] .'/edit') ?>" method="POST">
						<input type="hidden" name="id" value="<?php echo $row['id_keranjang']; ?>">
						<tr>
							<th scope="row"><?= $no;  ?></th>
							<td><img src="image/produk/<?= $row['gambar_produk']; ?>" width="100"></td>
							<td><?= $row['nama_produk']; ?></td>
							<td>Rp.<?= number_format($row['harga_produk']);  ?></td>
							<td><input type="number" name="qty" class="form-control" style="text-align: center;" value="<?= $row['qty']; ?>"></td>
							<td>Rp.<?= number_format($row['total_harga']);  ?></td>
							<td>
                                <button type="submit" name="submit1" class="btn btn-warning">Update</button> 
                    </form>
                            <form action="<?= base_url('keranjang/delete/' . $row['id_keranjang']) ?>" method="post"><input type="hidden" name="_method" value="DELETE"><button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin dihapus ?')">Delete</button></form>
                            </td>
						</tr>
					<?php 
                    endforeach;
                    ?>
					 
						<tr>
							<td colspan="7" style="text-align: right; font-weight: bold;">Grand Total = Rp.<?= number_format($hasil); ?></td>
						</tr>
						<tr>
							<td colspan="7" style="text-align: right; font-weight: bold;">
                                <a href="<?= base_url() ?>" class="btn btn-success">Lanjutkan Belanja</a> 
                                <a href="<?= base_url('checkout') ?>" class="btn btn-primary">Checkout</a>
                            </td>
						</tr>
						<?php 
					}else{
						echo "
						<tr>
						<th scope='col'>No</th>
						<th scope='col'>Image</th>
						<th scope='col'>Nama</th>
						<th scope='col'>Harga</th>
						<th scope='col'>Qty</th>
						<th scope='col'>SubTotal</th>
						<th scope='col'>Action</th>
						</tr>
						<tr>
						<td colspan='7' class='text-center bg-warning'><h5><b>KERANJANG BELANJA ANDA KOSONG </b></h5></td>
						</tr>

						";
					}

				
				?>


			</tbody>
		</table>
	
</div>




<?php 
include 'footer.php';
?>