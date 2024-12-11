<?php 
require_once('config/config.php');

                $connection= new Connection();
                $conn=$connection->getConnection();

$pencarianSQL	= "";
# PENCARIAN DATA 
if(isset($_POST['btnCari'])) {
	$txtKataKunci	= trim($_POST['txtKataKunci']);

	// Menyusun sub query pencarian
	$pencarianSQL	= "WHERE pinjaman.kode_anggota='$txtKataKunci' OR anggota.nama_anggota LIKE '%$txtKataKunci%' ";
}

# Teks pada form
$dataKataKunci = isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : '';



				$baris	= 50;
				$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
				$sql2 = $conn->query("SELECT * FROM  pinjaman LEFT JOIN anggota ON pinjaman.kode_anggota=anggota.kode_anggota $pencarianSQL ");
				$total = $sql2->rowCount();
				$maks	= ceil($total/$baris);
				$mulai	= $baris * ($hal-1); 
?>
<div class="main-content">
				<div class="container-fluid">
<h3><a href="?p=home">Beranda </a><i class="fa fa-angle-right"></i> Data Pinjaman</h3>

					<div class="row">
						<div class="col-md-12">
							<!-- RECENT PURCHASES -->
							<div class="panel">
								<div class="panel-heading">
										<div class="text-left"><a href="?p=tambah_pinjaman" class="btn btn-danger">Tambah Pinjaman</a></div>
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
												<th>No</th>
												<th>Kode Pinjaman</th>
												<th>Tanggal</th>
												<th>Kode Anggota</th>
												<th>Nama Anggota</th>
												<th>Jumlah Pinjaman</th>
												<th>Tenor</th>
												<th>Angsuran</th>
												<th>Status</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
										<?php $sqlget=$conn->prepare("SELECT * FROM pinjaman LEFT JOIN anggota ON pinjaman.kode_anggota=anggota.kode_anggota   $pencarianSQL ORDER BY kode_pinjaman DESC LIMIT $mulai,$baris");
				$sqlget->execute();
				$no=0;

				while($data=$sqlget->fetch(PDO::FETCH_ASSOC)){
					$id=$data['kode_pinjaman'];
					$no++;
	
				
				?>
										
											<tr>
												<td><?php echo $no ; ?></td>

												<td><a href="?p=detail_pinjaman&&id=<?php echo $data['kode_pinjaman'] ; ?>"><?php echo $data['kode_pinjaman'] ; ?></a></td>
												<td><?php echo date('d M Y', strtotime($data['tgl_pinjam'])) ; ?></td>
												<td><?php echo $data['kode_anggota'] ; ?></td>
												<td><?php echo $data['nama_anggota'] ; ?></td>
												<td>Rp.<?php echo number_format($data['jumlah_pinjam']) ; ?></td>
												<td><?php echo $data['tenor'] ; ?> Bulan</td>
												<td>Rp.<?php echo number_format($data['angsuran_bulanan']) ; ?></td>
												<td><?php echo $data['status'] ; ?></td>
												<td><div class='btn-group'>
						  <button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown">
						    <span class="fa fa-cog"></span> &nbsp;<span class="fa fa-caret-down"></span>
						  </button>
						  <ul class="dropdown-menu dropdown-menu-right" role="menu" >
						    
						    <li><a href="?p=edit_pinjaman&&id=<?php echo $data['kode_pinjaman'] ; ?>">Edit</a></li>

						    <li><a href="pages/kwitansi_pinjaman.php?id=<?php echo $data['kode_pinjaman'] ; ?>" target="_blank">Cetak</a></li>
<li><a href="?p=hapus_pinjaman&&id=<?php echo $data['kode_pinjaman'] ; ?>" onClick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a></li>
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
	echo "<a href=?p=pinjaman&hal=$h>$h</a> ";
	
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