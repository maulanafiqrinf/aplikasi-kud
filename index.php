<?php
require_once('config/config.php');

session_start();
date_default_timezone_set("Asia/Jakarta");
$tanggal = date('d-m-Y');

if (empty($_SESSION['username'])) {
	header("location:login.php"); // jika belum login, maka dikembalikan ke file form_login.php
} else {

	$connection = new Connection();
	$conn = $connection->getConnection();
	$sql78 = $conn->prepare("SELECT * FROM admin WHERE username='$_SESSION[username]'");
	$sql78->execute();
	$hasil78 = $sql78->fetch(PDO::FETCH_ASSOC);

?>

	<!doctype html>
	<html lang="en">

	<head>
		<title>Aplikasi Koperasi</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<!-- VENDOR CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
		<link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
		<!-- MAIN CSS -->
		<link rel="stylesheet" href="assets/css/main.css">
		<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
		<link rel="stylesheet" href="assets/css/demo.css">
		<!-- GOOGLE FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
		<!-- ICONS -->
	</head>

	<body>
		<!-- WRAPPER -->
		<div id="wrapper">
			<!-- NAVBAR -->
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="brand">
					<a href="?p=home" style="font-size: 25px">KUD Mina Usaha Jaya</a>
				</div>
				<div class="container-fluid">
					<div class="navbar-btn">
					</div>
					<div id="navbar-menu">
						<ul class="nav navbar-nav navbar-right">

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span><?php echo $hasil78['nama_admin']; ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
								<ul class="dropdown-menu">
									<li><a href="?p=profil"><i class="lnr lnr-user"></i> <span>Profil</span></a></li>
									<li><a href="logout.php"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<!-- END NAVBAR -->
			<!-- LEFT SIDEBAR -->
			<div id="sidebar-nav" class="sidebar" >
				<div class="sidebar-scroll">
					<nav>
						<ul class="nav">
							<li><a href="?p=home"><i class="lnr lnr-home"></i> <span>Beranda</span></a></li>
							<li>
								<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-database"></i> <span>Master Data</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="subPages" class="collapse ">
									<ul class="nav">
										<li><a href="?p=anggota" class="">Anggota</a></li>
										<li><a href="?p=simpanan" class="">Simpanan</a></li>
										<li><a href="?p=pengambilan" class="">Pengambilan</a></li>
										<li><a href="?p=pinjaman" class="">Pinjaman</a></li>
										<li><a href="?p=angsuran" class="">Angsuran</a></li>
									</ul>
								</div>
							</li>
							<li>
								<a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr-list"></i> <span>Transaksi</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="subPages2" class="collapse ">
									<ul class="nav">
										<li><a href="?p=tambah_simpanan" class="">Simpanan</a></li>
										<li><a href="?p=tambah_pengambilan" class="">Pengambilan</a></li>
										<li><a href="?p=tambah_pinjaman" class="">Pinjaman</a></li>
										<li><a href="?p=tambah_angsuran" class="">Angsuran</a></li>
									</ul>
								</div>
							</li>
							<li>
								<a href="#subPages3" data-toggle="collapse" class="collapsed"><i class="lnr lnr-printer"></i> <span>Laporan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="subPages3" class="collapse ">
									<ul class="nav">
										<li><a href="?p=laporan_anggota" class="">Anggota</a></li>
										<li><a href="?p=laporan_simpanan" class="">Simpanan</a></li>
										<li><a href="?p=laporan_pinjaman" class="">Pinjaman</a></li>
									</ul>
								</div>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<!-- END LEFT SIDEBAR -->
			<!-- MAIN -->
			<div class="main">
				<!-- MAIN CONTENT -->
				<?php include('isi.php'); ?>
				<!-- END MAIN CONTENT -->
			</div>
			<!-- END MAIN -->
			<div class="clearfix"></div>
			<footer>
				<div class="container-fluid">
					<p class="copyright">&copy; 2022 <a href="#" target="_blank">Aplikasi KUD Mina Usaha Jaya </a>. All Rights Reserved. Developed by teamme</a></p>
				</div>
			</footer>
		</div>
		<!-- END WRAPPER -->
		<!-- Javascript -->
		<script src="assets/vendor/jquery/jquery.min.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
		<script src="assets/vendor/chartist/js/chartist.min.js"></script>
		<script src="assets/scripts/klorofil-common.js"></script>
		<script>
			$(function() {
				var data, options;

				// headline charts
				data = {
					labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
					series: [
						[23, 29, 24, 40, 25, 24, 35],
						[14, 25, 18, 34, 29, 38, 44],
					]
				};

				options = {
					height: 300,
					showArea: true,
					showLine: false,
					showPoint: false,
					fullWidth: true,
					axisX: {
						showGrid: false
					},
					lineSmooth: false,
				};

				new Chartist.Line('#headline-chart', data, options);


				// visits trend charts
				data = {
					labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
					series: [{
						name: 'series-real',
						data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
					}, {
						name: 'series-projection',
						data: [240, 350, 360, 380, 400, 450, 480, 523, 555, 600, 700, 800],
					}]
				};

				options = {
					fullWidth: true,
					lineSmooth: false,
					height: "270px",
					low: 0,
					high: 'auto',
					series: {
						'series-projection': {
							showArea: true,
							showPoint: false,
							showLine: false
						},
					},
					axisX: {
						showGrid: false,

					},
					axisY: {
						showGrid: false,
						onlyInteger: true,
						offset: 0,
					},
					chartPadding: {
						left: 20,
						right: 20
					}
				};

				new Chartist.Line('#visits-trends-chart', data, options);


				// visits chart
				data = {
					labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
					series: [
						[6384, 6342, 5437, 2764, 3958, 5068, 7654]
					]
				};

				options = {
					height: 300,
					axisX: {
						showGrid: false
					},
				};

				new Chartist.Bar('#visits-chart', data, options);


				// real-time pie chart
				var sysLoad = $('#system-load').easyPieChart({
					size: 130,
					barColor: function(percent) {
						return "rgb(" + Math.round(200 * percent / 100) + ", " + Math.round(200 * (1.1 - percent / 100)) + ", 0)";
					},
					trackColor: 'rgba(245, 245, 245, 0.8)',
					scaleColor: false,
					lineWidth: 5,
					lineCap: "square",
					animate: 800
				});

				var updateInterval = 3000; // in milliseconds

				setInterval(function() {
					var randomVal;
					randomVal = getRandomInt(0, 100);

					sysLoad.data('easyPieChart').update(randomVal);
					sysLoad.find('.percent').text(randomVal);
				}, updateInterval);

				function getRandomInt(min, max) {
					return Math.floor(Math.random() * (max - min + 1)) + min;
				}

			});
		</script>
	</body>

	</html>
<?php } ?>