<!-- <php 
session_start();
include '../koneksi/koneksi.php';
if(!isset($_SESSION['admin'])){
	header('location:index.php');
}
?> -->

<!DOCTYPE html>
<html>
<head>
	<title>New Normal Fashion | Admin panel</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('css/bootstrap.min.css') ?> ">
	<link rel="stylesheet" type="text/css" href="<?= base_url('css/style.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('css/bootstrap-theme.css') ?>">
	<script  src="<?= base_url('js/jquery.js') ?>"></script>
	<script  src="<?= base_url('js/bootstrap.min.js') ?>"></script>


</head>
<body>

	<nav class="navbar navbar-default" style="padding: 5px;">
		<div class="container">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-left">

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-folder-close"></i> Data Master <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?= base_url('admin/produk') ?>">Master Produk</a></li>
							<li><a href="<?= base_url('admin/customer') ?>">Master Customer</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-retweet"></i> Data Transaksi <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?= base_url('admin/produksi') ?>">Produksi</a></li>
							<li><a href="<?= base_url('admin/inventory') ?>">Inventory</a></li>
							
						</ul>
					</li>

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-stats"></i> Laporan <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?= base_url('admin/laporan/penjualan') ?>">Laporan Penjualan</a></li>
							<li><a href="<?= base_url('admin/laporan/profit') ?>">Laporan Profit</a></li>
							<li><a href="<?= base_url('admin/laporan/omset') ?>">Laporan Omset</a></li>
							<li><a href="<?= base_url('admin/laporan/pembatalan') ?>">Laporan Pembatalan	</a></li>
							<li><a href="<?= base_url('admin/laporan/inventory') ?>">Laporan Inventory</a></li>
							<li><a href="<?= base_url('admin/laporan/produksi') ?>">Laporan Produksi</a></li>
						</ul>
					</li>
					<li><a href="<?= base_url('admin/') ?>">Dashboard</a></li>

				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-cog"></i> Pemeliharaan <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?= base_url('admin/backup') ?>">Backup Database</a></li>
							<li><a href="">Retrieve Database</a></li>
						</ul>
					</li>


					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> Admin <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?= base_url('admin/logout') ?>">Log Out</a></li>
						</ul>
					</li>

				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>



