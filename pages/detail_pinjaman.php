<?php 
require_once('config/config.php');

                $connection= new Connection();
                $conn=$connection->getConnection();
                $id=$_GET['id'];

$sqlget1=$conn->prepare("SELECT * FROM pinjaman LEFT JOIN anggota ON pinjaman.kode_anggota=anggota.kode_anggota   WHERE kode_pinjaman='$id'");
				$sqlget1->execute();
				 $data1=$sqlget1->fetch(PDO::FETCH_ASSOC);
?>
<div class="main-content">
				<div class="container-fluid">
<h3><a href="?p=home">Beranda </a><i class="fa fa-angle-right"></i> <a href="?p=pinjaman">Data Pinjaman</a> <i class="fa fa-angle-right"></i> Detail Pinjaman</h3>

					<div class="row">
						<div class="col-md-12">
							<!-- RECENT PURCHASES -->
							<div class="panel">
								<div class="panel-heading  no-padding">
								<div class="col-sm-5 no-padding">
								<table class="table table-bordered">
									<tr>
										<td>Kode Pinjaman</td>
										<td><?php echo $data1['kode_pinjaman'] ; ?></td>
									</tr>
									<tr>
									<td>Tanggal Pinjaman</td>
										<td><?php echo $data1['tgl_pinjam'] ; ?></td>
									</tr>
									<tr>
									<td>Jumlah Pinjaman</td>
										<td>Rp.<?php echo number_format($data1['jumlah_pinjam']) ; ?></td>
										</tr>
									<tr>
									<td>Tenor</td>
										<td><?php echo  $data1['tenor'] ; ?> Bulan</td>
										</tr>
								</table>
								</div>
								<div class="col-sm-2">
								</div>

								<div class="col-sm-5 no-padding">
								<table class="table table-bordered">
								<tr>
									<td>Kode Anggota</td>
										<td><?php echo $data1['kode_anggota']  ; ?></td>
									</tr>
								<tr>
									<td>Nama Anggota</td>
										<td><?php echo $data1['nama_anggota']  ; ?></td>
									</tr>
								<tr>
									<td>Status</td>
										<td><?php echo $data1['status']  ; ?></td>
									</tr>
								</table>
								</div>
										 
								</div>
								<div class="panel-body no-padding">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>No Angsuran</th>
												<th>Tanggal</th>
												<th>Kode Pinjaman</th>
												<th>Jumlah Angsuran</th>
												<th>Angsuran Ke</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
										<?php 
										$sqlget=$conn->prepare("SELECT * FROM angsuran LEFT JOIN pinjaman ON angsuran.kode_pinjaman=pinjaman.kode_pinjaman LEFT JOIN anggota ON pinjaman.kode_anggota=anggota.kode_anggota WHERE pinjaman.kode_pinjaman='$id'");
				$sqlget->execute();
				$no=0;

				while($data=$sqlget->fetch(PDO::FETCH_ASSOC)){
					$id=$data['no_angsuran'];
					$no++;
	
				
				?>
										
											<tr>
												<td><?php echo $no ; ?></td>

												<td><?php echo $data['no_angsuran'] ; ?></td>
												<td><?php echo date('d M Y', strtotime($data['tgl_angsuran'])) ; ?></td>
												<td><?php echo $data['kode_pinjaman'] ; ?></td>
												<td>Rp.<?php echo number_format($data['jumlah_angsuran']) ; ?></td>
												<td><?php echo $data['angsuran_ke'] ; ?></td>
												<td><div class='btn-group'>
						  <button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown">
						    <span class="fa fa-cog"></span> &nbsp;<span class="fa fa-caret-down"></span>
						  </button>
						  <ul class="dropdown-menu dropdown-menu-right" role="menu" >
						    <li><a href="pages/kwitansi_angsuran.php?id=<?php echo $data['no_angsuran'] ; ?>" target="_blank">Cetak</a></li>
						  </ul>
						</div></td>
											</tr>

											<?php } ?>
										</tbody>
									</table>
								</div>
								<div class="panel-footer">
									<div class="row">

									</div>
								</div>
							</div>
							<!-- END RECENT PURCHASES -->
						</div>
					</div>
					
				</div>
			</div>