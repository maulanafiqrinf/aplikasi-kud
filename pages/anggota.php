<?php 
require_once('config/config.php');

                $connection= new Connection();
                $conn=$connection->getConnection();

$pencarianSQL	= "";
# PENCARIAN DATA 
if(isset($_POST['btnCari'])) {
	$txtKataKunci	= trim($_POST['txtKataKunci']);

	// Menyusun sub query pencarian
	$pencarianSQL	= "WHERE kode_anggota='$txtKataKunci' OR no_ktp='$txtKataKunci' OR nama_anggota LIKE '%$txtKataKunci%' ";
}

# Teks pada form
$dataKataKunci = isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : '';



				$baris	= 50;
				$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
				$sql2 = $conn->query("SELECT * FROM anggota $pencarianSQL ");
				$total = $sql2->rowCount();
				$maks	= ceil($total/$baris);
				$mulai	= $baris * ($hal-1); 
?>
<div class="main-content">
				<div class="container-fluid">
<h3><a href="?p=home">Beranda </a><i class="fa fa-angle-right"></i> Data Anggota</h3>

					<div class="row">
						<div class="col-md-12">
							<!-- RECENT PURCHASES -->
							<div class="panel">
								<div class="panel-heading">
										<div class="text-left"><a href="?p=tambah_anggota" class="btn btn-danger">Tambah Anggota</a></div>
									<div class="right">

				<form  method="post" action="<?php $_SERVER['PHP_SELF'] ; ?>">
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control"  name="txtKataKunci" placeholder="Cari data disini ...">
						<span class="input-group-btn"><button type="submit" name="btnCari" class="btn btn-danger">Cari</button> </span></div></div>
				</form>

									</div>
								</div>
								<div class="panel-body no-padding">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Kode Anggota</th>
												<th>Nama Anggota</th>
												<th>No KTP</th>
												<th>Gender</th>
												<th>Alamat</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
										<?php $sqlget=$conn->prepare("SELECT * FROM anggota  $pencarianSQL ORDER BY kode_anggota DESC LIMIT $mulai,$baris");
				$sqlget->execute();
				$no=0;

				while($data=$sqlget->fetch(PDO::FETCH_ASSOC)){
					$id=$data['kode_anggota'];
					$no++;
	
				
				?>
										
											<tr>
												<td><a href="#"><?php echo $data['kode_anggota'] ; ?></a></td>
												<td><?php echo $data['nama_anggota'] ; ?></td>
												<td><?php echo $data['no_ktp'] ; ?></td>
												<td><?php echo $data['gender'] ; ?></td>
												<td><?php echo $data['alamat'] ; ?><br> <?php echo $data['no_hp'] ; ?></td>
												<td><div class='btn-group'>
						  <button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown">
						    <span class="fa fa-cog"></span> &nbsp;<span class="fa fa-caret-down"></span>
						  </button>
						  <ul class="dropdown-menu dropdown-menu-right" role="menu" >
						    
						    <li><a href="?p=edit_anggota&&id=<?php echo $data['kode_anggota'] ; ?>">Edit</a></li>
<li><a href="?p=hapus_anggota&&id=<?php echo $data['kode_anggota'] ; ?>" onClick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a></li>
						  </ul>
						</div></td>
											</tr>

											<?php } ?>
										</tbody>
									</table>
								</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-6">Total Data : <?php echo $total ; ?> | Pages ( <?php for($h=1;$h<=$maks;$h++){
	echo "<a href=?p=anggota&hal=$h>$h</a> ";
	
} ?> )
	        </div>
									</div>
								</div>
							</div>
							<!-- END RECENT PURCHASES -->
						</div>
					</div>
					
				</div>
			</div>