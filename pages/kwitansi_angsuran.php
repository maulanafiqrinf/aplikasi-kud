
<?php 
require_once('../config/config.php');
require_once('../config/function.php');

                $connection= new Connection();
                $conn=$connection->getConnection();


$id=$_GET['id'];
    $query3 = $conn->prepare("SELECT * FROM angsuran LEFT JOIN pinjaman ON angsuran.kode_pinjaman=pinjaman.kode_pinjaman LEFT JOIN anggota ON pinjaman.kode_anggota=anggota.kode_anggota WHERE no_angsuran='$id'");
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

                    <strong style="font-size:20px"> <u>KWITANSI ANGSURAN PINJAMAN</u></strong><br>
                    Koperasi Syariah BMT Nurul Ummah
                      </div>
                      <div class="col-sm-5">
                      <br><br>

                      <table class="table table-bordered">
                      <tr>
                      <td><strong>No Angsuran</strong>  </td>
                      <td><?php echo $data['no_angsuran'] ; ?></td>
                      </tr>
                      <tr>
                      <td><strong>Kode Pinjaman</strong>  </td>
                      <td><?php echo $data['kode_pinjaman'] ; ?></td>
                      </tr>
                      <tr>
                      <td><strong>Tanggal</strong> </td>
                      <td><?php echo date('d M Y', strtotime($data['tgl_angsuran'])) ; ?></td>
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
                      <div><strong>Detail Angsuran :</strong></div>
                      <table class="table table-bordered">

                      <tr>
                      <td><strong>Jumlah Angsuran</strong>  </td>
                      <td>Rp.<?php echo number_format($data['jumlah_angsuran']) ; ?> </td>
                      </tr>
                      <tr>
                      <td><strong>Terbilang </td>
                      <td style="text-transform: capitalize;"><?php echo Terbilang($data['jumlah_angsuran']) ; ?> Rupiah</td>
                      </tr>
                      <tr>
                      <td><strong>Angsuran Ke</strong> </td>
                      <td> <?php echo number_format($data['angsuran_ke']) ; ?> </td>
                      </tr>
                      <tr>
                      <td><strong>Sisa Angsuran</strong> </td>
                      <td><?php echo $data['tenor']-$data['angsuran_ke'] ; ?> </td>
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