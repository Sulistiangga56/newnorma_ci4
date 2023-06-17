<?php
include 'header.php';
?>

<div class="container" style="padding-bottom: 250px;">
	<h2 style=" width: 100%; border-bottom: 4px solid #00008B"><b>Login</b></h2>

	<?php if (session()->getFlashdata('pesan') !== NULL) : ?>
		<div class="alert alert-warning alert-dismissible" role="alert">
			<?php echo session()->getFlashdata('pesan'); ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>
	<?php endif; ?>

	<form action="<?= base_url('login') ?>" method="POST">
		<div class="form-group">
			<label for="exampleInputEmail1">username</label>
			<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Username" name="username" style="width: 500px;">
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Password</label>
			<input type="password" class="form-control" id="exampleInputEmail1" placeholder="Password" name="password" style="width: 500px;">
		</div>
		<button type="submit" class="btn btn-success">Login</button>
		<a href="<?= base_url('register') ?>" class="btn btn-primary">Daftar</a>
	</form>
</div>


<?php
include 'footer.php';
?>