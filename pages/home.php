<?php
require_once('config/config.php');

$connection = new Connection();
$conn = $connection->getConnection();


$sql1 = $conn->query("SELECT COUNT(*) FROM anggota");
$reservasi = $sql1->fetchColumn();
$sql2 = $conn->query("SELECT SUM(jumlah_simpan) FROM simpanan");
$tamu = $sql2->fetchColumn();
$sql3 = $conn->query("SELECT SUM(jumlah_pinjam) FROM pinjaman");
$kamar = $sql3->fetchColumn();
$sql4 = $conn->query("SELECT SUM(jumlah_simpan) FROM simpanan");
$rev = $sql4->fetchColumn();
?>
<div class="main-content">
	<div class="container-fluid">
		<!-- OVERVIEW -->

		<div class="panel panel-headline">
			<div class="panel-heading">
				<h3 class="panel-title">Ringkasan Data</h3>
				<p class="panel-subtitle">Periode: <?php echo date('d M Y'); ?></p>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-3">
						<div class="metric">
							<span class="icon"><i class="fa fa-users"></i></span>
							<p>
								<span class="number"><?php echo number_format($reservasi); ?></span>
								<span class="title">Anggota</span>
							</p>
						</div>
					</div>
					<div class="col-md-3">
						<div class="metric">
							<span class="icon"><i class="fa fa-download"></i></span>
							<p>
								<span class="number"><?php echo number_format($tamu * 0.001); ?>K</span>
								<span class="title">Simpanan</span>
							</p>
						</div>
					</div>
					<div class="col-md-3">
						<div class="metric">
							<span class="icon"><i class="fa fa-upload"></i></span>
							<p>
								<span class="number"><?php echo number_format($kamar * 0.001); ?>K</span>
								<span class="title">Pinjaman</span>
							</p>
						</div>
					</div>
					<div class="col-md-3">
						<div class="metric">
							<span class="icon"><i class="fa fa-dollar"></i></span>
							<p>
								<span class="number"><?php echo number_format($rev * 0.001); ?>K</span>
								<span class="title">Total Pembayaran</span>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END OVERVIEW -->
		<div class="row">
			<div class="col-md-12">
				<!-- RECENT PURCHASES -->
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Short Link</h3>
					</div>
					<div class="panel-body ">
						<a href="?p=tambah_anggota"><button class="btn btn-success" type="button">Tambah Anggota</button></a>
						<a href="?p=tambah_simpanan"><button class="btn btn-primary" type="button">Tambah Simpanan</button></a>
						<a href="?p=tambah_pengambilan"><button class="btn btn-warning" type="button">Tambah Pengambilan</button></a>
						<a href="?p=tambah_pinjaman"><button class="btn btn-danger" type="button">Tambah Pinjaman</button></a>
						<a href="?p=tambah_sngsuran"><button class="btn btn-inverse" type="button">Tambah Angsuran</button></a>

					</div>
					<div class="panel-footer">
					</div>
				</div>
				<!-- END RECENT PURCHASES -->
			</div>

		</div>

	</div>
	<!-- END TIMELINE -->
</div>