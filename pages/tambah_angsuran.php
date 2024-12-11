<?php

require_once("config/config.php");

require_once("config/function.php");
$connection=new Connection() ;
$conn=$connection->getConnection();

$tgg=date('Y-m-d');


$iddd="";
if(isset($_POST['lihat'])){
  $id=$_POST['no_pinjaman'];


                    $coba1=$conn->prepare("SELECT * FROM  pinjaman WHERE kode_pinjaman='$id' ");
        $coba1->execute();

        $coba=$coba1->fetch(PDO::FETCH_ASSOC) ;
  $lama=$coba['tenor'];
  if($id!=$coba['kode_pinjaman']){
    $iddd="";
  ?>
  <script>
alert('Mohon maaf kode pinjaman yang anda masukan tidak ada !');
</script>
<?php
  }
    else {
      $idd=$coba['kode_pinjaman'];

  $sql1=$conn->query("SELECT count(*) FROM angsuran WHERE kode_pinjaman='$idd'");
  $cek = $sql1->fetchColumn();
      if($cek>=$lama){
        $iddd="";
    ?>
    <script>
alert('Mohon maaf no pinjaman yang anda masukan sudah lunas !');
</script>
<?php
  }
      else {
        
        $iddd=$coba['kode_pinjaman'];
      }
      }
    }
  
    ?>

<style>
#frmCheckUsername {border-top:#F0F0F0 2px solid;background:#FAF8F8;padding:10px;}
.demoInputBox{padding:7px; border:#F0F0F0 1px solid; border-radius:4px;}
.status-available{color:#2FC332;}
.status-not-available{color:#D60202;}

.dropdown-menu a {
    text-decoration: none;
    display: block;
    text-align: left;
}
#nou {
    text-decoration: none;

</style>

<script>
function checkAvailability() {  
    jQuery.ajax({
    url: "cek_available2.php",
    data:'ka='+$("#ka").val(),
    type: "POST",
    success:function(data){
        $("#user-availability-status").html(data);
    },
    error:function (){}
    });
}

function cekangsuran() {
  var pinjaman=document.addem.pinjaman.value;
  var tenor=document.addem.tenor.value;

  totalR=eval(parseInt(pinjaman)*0.2);
    angsur=eval(parseInt(pinjaman)+ totalR);
      cicil=eval(angsur/parseInt(tenor));

  document.addem.angsuran.value= cicil.toFixed(0);


}

</script>
<div class="main-content">
        <div class="container-fluid">
          	<h3><a href="?p=home">Beranda </a><i class="fa fa-angle-right"></i> <a href="?p=pinjaman">Data Pinjaman</a><i class="fa fa-angle-right"></i> Transaksi Angsuran</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row">
          		<div class="col-lg-12">
                  <div class="panel">
                  <div class="panel-heading text-center">
                  	  <h4 class="mb"><strong>Transaksi Angsuran</strong></h4>
                      </div>
                      <div class="panel-body">
                      <form method="post" action="<?php $_SERVER['PHP_SELF'] ; ?>">
    <div class="form-group">
      <div class="input-group">
        <input type="text" name="no_pinjaman" class="form-control" placeholder="Masukan kode pinjaman">
        <div class="input-group-btn">
          <button class="btn btn-success" type="submit" name="lihat">Lihat Data</button>
        </div>
      </div>
    </div>
    </form>
    <table class="table table-bordered text-center">
    <form method="post" action="?p=isi_transaksi" onSubmit="return confirm('Anda yakin akan melakukan konfirmasi pembayaran?')">
      <tr class="danger">
        <td><strong>Kode Pinjaman</strong></td>
        <td><strong>Kode Anggota</strong></td>
        <td><strong>Nama Anggota</strong></td>
        <td><strong>Angsuran Bulanan</strong></td>
        <td><strong>Angsuran Ke</strong></td>
      </tr>
      <?php


                    $coba2=$conn->prepare("SELECT * FROM  pinjaman LEFT JOIN anggota ON pinjaman.kode_anggota=anggota.kode_anggota WHERE kode_pinjaman='$iddd' ");
        $coba2->execute();

        while($data=$coba2->fetch(PDO::FETCH_ASSOC)){


  $sql7=$conn->query("SELECT count(*) FROM angsuran WHERE kode_pinjaman='$data[kode_pinjaman]'");
  $ke= $sql7->fetchColumn();

        $angsur=$ke+1 ;
        
        ?>
        <input type="hidden" name="kp" value="<?php echo $data['kode_pinjaman'] ; ?>">
        <input type="hidden" name="ab" value="<?php echo $data['angsuran_bulanan'] ; ?>">
        <input type="hidden" name="ke" value="<?php echo $angsur ; ?>">
        <input type="hidden" name="tenor" value="<?php echo $data['tenor'] ; ?>">
        <tr>
          <td><?php echo $data['kode_pinjaman'] ; ?></td>
          <td><?php echo $data['kode_anggota'] ; ?></td>
          <td><?php echo $data['nama_anggota'] ; ?></td>
          <td><?php echo number_format($data['angsuran_bulanan']) ; ?></td>
          <td><?php echo $angsur ; ?></td>
        </tr>
        <tr>
          <td colspan="5" align="right"><button class="btn btn-success" type="submit" name="simpan"> Bayar Angsuran</button></td>
        </tr>
        <?php
      }
      ?></form>
      </table>
                          </div>
                          
                  </div>
                  </div>
          		</div><!-- col-lg-12-->      	
          	</div><!-- /row -->
            </div>
            </div>

