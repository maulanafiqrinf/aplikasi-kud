
<?php 
require_once('../config/config.php');
require_once('../config/function.php');

                $connection= new Connection();
                $conn=$connection->getConnection();


$id=$_GET['id'];
    $query3 = $conn->prepare("SELECT * FROM pinjaman LEFT JOIN anggota ON pinjaman.kode_anggota=anggota.kode_anggota WHERE kode_pinjaman='$id'");
    $query3->execute();
    $data = $query3->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
<title>Cetak Kwitansi</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

<link href="../assets/bs/css/bootstrap.css" rel="stylesheet">
<style type="text/css">
  @media print {
tr.vendorListHeading {
    background-color: #1a4567 !important;
    -webkit-print-color-adjust: exact; 
}}

@media print {
    .vendorListHeading th {
    color: white !important;
}}
</style>
</head>
<body>
<div class="container">


					<div class="row">
						<div class="col-md-12 text-center">
							<!-- RECENT PURCHASES -->

										<strong style="font-size:20px"> <u>KWITANSI PENCAIRAN DANA PINJAMAN</u></strong><br>
                    Koperasi Syariah BMT Nurul Ummah
                      </div>
                      <div class="col-sm-5">
                      <br><br>

                      <table class="table table-bordered">
                      <tr>
                      <td><strong>Kode Pinjaman</strong>  </td>
                      <td><?php echo $data['kode_pinjaman'] ; ?></td>
                      </tr>
                      <tr>
                      <td><strong>Tanggal</strong> </td>
                      <td><?php echo date('d M Y', strtotime($data['tgl_pinjam'])) ; ?></td>
                      </tr>

                      <tr>
                      <td><strong>Kode Anggota</strong>  </td>
                      <td><?php echo $data['kode_anggota'] ; ?></td>
                      </tr>

                      <tr>
                      <td><strong>Nama Anggota</strong>  </td>
                      <td><?php echo $data['nama_anggota'] ; ?></td>
                      </tr>
                      </table>
                      </div>
                      </div>


                      <div class="row">

                          
                              <div class="col-sm-12">
                      <div><strong>Detail Pinjaman :</strong></div>
                      <table class="table table-bordered">

                      <tr>
                      <td><strong>Jumlah Pinjaman</strong>  </td>
                      <td>Rp.<?php echo number_format($data['jumlah_pinjam']) ; ?> </td>
                      </tr>
                      <tr>
                      <td><strong>Terbilang </td>
                      <td style="text-transform: capitalize;"><?php echo Terbilang($data['jumlah_pinjam']) ; ?> Rupiah</td>
                      </tr>
                      <tr>
                      <td><strong>Angsuran Perbulan</strong> </td>
                      <td>Rp.<?php echo number_format($data['angsuran_bulanan']) ; ?> </td>
                      </tr>
                      <tr>
                      <td><strong>Tenor</strong> </td>
                      <td><?php echo $data['tenor'] ; ?> Bulan</td>
                      </tr>

                      </table>
                      </div>
                      </div>
                      <table width="100%">
                      <tr><td width="50%">
                      <div class="text-center">
                                 Kasir,<br><br><br>
                                 (<u>..................</u>)
                                 </div>

                      </td>
                      <td>

                      <div class="text-center">
                                 Anggota Penerima,<br><br><br>
                                 (<u><?php echo $data['nama_anggota'] ; ?></u>)

                      </div>
                      </td>
                      </tr>
                      </table>
								</div>
                </div>
                </div>
                <script type="text/javascript">
                  window.print();
                </script>
                </body>
                </html>