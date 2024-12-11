
<?php 
require_once('../config/config.php');
require_once('../config/function.php');

                $connection= new Connection();
                $conn=$connection->getConnection();



?>
<!DOCTYPE html>
<html>
<head>
<title>Cetak Laporan Pinjaman</title>

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
<?php
if(isset($_POST['btntanggal'])){

  $dr=$_POST['dari'];
  $sp=$_POST['sampai'];
  $dari=$dr." 00:00:00";
  $sampai=$sp." 23:59:59";




        $sqlgetin4=$conn->prepare("SELECT COUNT(*) FROM pinjaman WHERE tgl_pinjam BETWEEN '$dari' AND '$sampai'");
      $sqlgetin4->execute();
        $ju=$sqlgetin4->fetch(PDO::FETCH_COLUMN)+0;

        $sqlgetin77=$conn->prepare("SELECT SUM(jumlah_pinjam) FROM pinjaman WHERE tgl_pinjam BETWEEN '$dari' AND '$sampai'");
      $sqlgetin77->execute();
        $jt=$sqlgetin77->fetch(PDO::FETCH_COLUMN)+0;



  ?>



<div class="container">


					<div class="row">
						<div class="col-md-12 text-center">
							<!-- RECENT PURCHASES -->

										<strong style="font-size:20px"> LAPORAN DATA PINJAMAN <br>  KOPERASI SYARIAH BMT NURUL UMMAH</strong><br>
                   
                      </div>
                      <div class="col-sm-5">
                      <br><br>

                      <table class="table table-bordered">
                      <tr>
                      <td><strong>Priode </strong></td>
                      <td><?php echo  date('d M Y', strtotime($dari))." s/d ".date('d M Y', strtotime($sampai)) ; ?></td>
                      </tr>
                      <tr>
                      <td><strong>Jumlah Data</strong> </td>
                      <td><?php echo number_format($ju) ; ?> </td>
                      </tr>
                      

                      </table>
                      </div>
                      </div>
                      <div class="row">

                          
                              <div class="col-sm-12">
                                 <table class="table table-bordered">
                                 <tr align="center">
                                 <td><strong>No</strong></td>
                                 <td><strong>Tanggal  </strong></td>
                                 <td><strong>No Simpanan  </strong></td>
                                 <td><strong>Kode Anggota</strong></td>
                                 <td><strong>Nama Anggota</strong></td>
                                 <td><strong>Tenor</strong></td>
                                 <td><strong>Jumlah Pinjaman</strong></td>
                                 </tr>

                                 <?php


    $query = $conn->prepare("SELECT * FROM pinjaman LEFT JOIN anggota ON pinjaman.kode_anggota=anggota.kode_anggota WHERE tgl_pinjam BETWEEN '$dari' AND '$sampai' ");
    $query->execute();
    $no=0;
    while($data2 = $query->fetch(PDO::FETCH_ASSOC)) {
      $no++;
      $tr=date('d-m-Y', strtotime($data2['tgl_pinjam']));


      echo "<tr align='center'><td>$no</td><td>$tr</td><td>$data2[kode_pinjaman]</td><td>$data2[kode_anggota]</td><td>$data2[nama_anggota]</td><td>$data2[tenor] Bulan</td><td>Rp.".number_format($data2['jumlah_pinjam'])."</td></tr>";
    }

?>
<tr>
<td colspan="6" align="center"><strong>Total </strong></td>
<td align="center"><Strong>Rp.<?php echo number_format($jt) ; ?></Strong></td>
</tr>


                                 </table>
                                 <div class="text-right">
                                 Mengetahui,<br><br><br>
                                 (<u>Kepala Cabang</u>)
                                 </div>
								</div>
                </div>
                </div>
                <script type="text/javascript">
                  window.print();
                </script>

                <?php }
if(isset($_POST['btnbulan'])){

  $bln=$_POST['bulan'];
  $tahun=$_POST['tahun'];
  $priode=$tahun."-".$bln."-";
  $nb=namabulan($bln);



        $sqlgetin4=$conn->prepare("SELECT COUNT(*) FROM simpanan WHERE tgl_simpan LIKE '%$priode%'");
      $sqlgetin4->execute();
        $ju=$sqlgetin4->fetch(PDO::FETCH_COLUMN)+0;

        $sqlgetin77=$conn->prepare("SELECT SUM(jumlah_simpan) FROM simpanan WHERE tgl_simpan LIKE '%$priode%'");
      $sqlgetin77->execute();
        $jt=$sqlgetin77->fetch(PDO::FETCH_COLUMN)+0;



  ?>



<div class="container">


          <div class="row">
            <div class="col-md-12 text-center">
              <!-- RECENT PURCHASES -->


                    <strong style="font-size:20px"> LAPORAN DATA PINJAMAN <br>  KOPERASI SYARIAH BMT NURUL UMMAH</strong><br>
                   
                      </div>
                      <div class="col-sm-5">
                      <br><br>

                      <table class="table table-bordered">
                      <tr>
                      <td><strong>Priode </strong></td>
                      <td><?php echo  $nb." ".$tahun ; ?></td>
                      </tr>
                      <tr>
                      <td><strong>Jumlah Data</strong> </td>
                      <td><?php echo number_format($ju) ; ?> </td>
                      </tr>
                      

                      
                      </table>
                      </div>
                      </div>
                      <div class="row">

                          
                              <div class="col-sm-12">
                                 <table class="table table-bordered">
                                 <tr align="center">
                                 <td><strong>No</strong></td>
                                 <td><strong>Tanggal  </strong></td>
                                 <td><strong>No Simpanan  </strong></td>
                                 <td><strong>Kode Anggota</strong></td>
                                 <td><strong>Nama Anggota</strong></td>
                                 <td><strong>Tenor</strong></td>
                                 <td><strong>Jumlah Pinjaman</strong></td>
                                 </tr>

                                 <?php


    $query = $conn->prepare("SELECT * FROM pinjaman LEFT JOIN anggota ON pinjaman.kode_anggota=anggota.kode_anggota WHERE tgl_pinjam LIKE '%$priode%' ");
    $query->execute();
    $no=0;
    while($data2 = $query->fetch(PDO::FETCH_ASSOC)) {
      $no++;
      $tr=date('d-m-Y', strtotime($data2['tgl_pinjam']));


      echo "<tr align='center'><td>$no</td><td>$tr</td><td>$data2[kode_pinjaman]</td><td>$data2[kode_anggota]</td><td>$data2[nama_anggota]</td><td>$data2[tenor] Bulan</td><td>Rp.".number_format($data2['jumlah_pinjam'])."</td></tr>";
    }
?>
<tr>
<td colspan="6" align="center"><strong>Total </strong></td>
<td align="center"><Strong>Rp.<?php echo number_format($jt) ; ?></Strong></td>
</tr>


                                 </table>
                                 <div class="text-right">
                                 Mengetahui,<br><br><br>
                                 (<u>Kepala Cabang</u>)
                                 </div>
                </div>
                </div>
                </div>
                <script type="text/javascript">
                  window.print();
                </script>
                
                <?php }
                ?>
                </body>
                </html>