<?php

require_once("config/config.php");

require_once("config/function.php");
$connection=new Connection() ;
$conn=$connection->getConnection();

$tgg=date('Y-m-d');

if(isset($_POST['simpan'])){
$idp=$_POST['idp'];
$tgl=$_POST['tgl'];
$ka=$_POST['ka'];
$pinjaman=$_POST['pinjaman'];
$tenor=$_POST['tenor'];
$angsuran=$_POST['angsuran'];
$status="Aktif";


 $sql="UPDATE pinjaman SET tgl_pinjam='$tgl',jumlah_pinjam='$pinjaman',tenor='$tenor',angsuran_bulanan='$angsuran' WHERE kode_pinjaman='$idp'" ;
 $conn->exec($sql);


  echo "<script>alert(\"Data berhasil disimpan !\") ; window.location.href='?p=pinjaman' ;</script>";

}



 $id=$_GET['id'];
    $query3 = $conn->prepare("SELECT * FROM pinjaman WHERE kode_pinjaman='$id'");
    $query3->execute();
    $data = $query3->fetch(PDO::FETCH_ASSOC);

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
          	<h3><a href="?p=home">Beranda </a><i class="fa fa-angle-right"></i> <a href="?p=pinjaman"> Data Pinjaman</a> <i class="fa fa-angle-right"></i> Edit Pinjaman</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row">
          		<div class="col-lg-12">
                  <div class="panel">
                  <div class="panel-heading text-center">
                  	  <h4 class="mb"><strong> Edit Data Pinjaman</strong></h4>
                      </div>
                      <div class="panel-body">
                      <form class="form-horizontal" method="post" name="addem" action="<?php $_SERVER['PHP_SELF'] ; ?>" onSubmit="return confirm('Anda yakin akan menyimpan data ?')">
                      <input type="hidden" name="idp" value="<?php echo $data['kode_pinjaman'] ; ?>">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Tanggal</label>
                              <div class="col-sm-10">
                                  <input type="date" name="tgl"  class="form-control" value="<?php echo $data['tgl_pinjam'] ; ?>" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Kode Anggota</label>
                              <div class="col-sm-10">
                                  <input type="text" name="ka" id="ka"  class="form-control" placeholder="Masukan Kode Anggota" value="<?php echo $data['kode_anggota'] ; ?>" readonly >
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Jumlah Pinjaman</label>
                              <div class="col-sm-10">
                                  <input type="number" name="pinjaman" id="pinjaman" value="<?php echo $data['jumlah_pinjam'] ; ?>" class="form-control"  value="0" >
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right" >Tenor</label>
                              <div class="col-sm-10">
                              <select name="tenor" class="form-control" id="tenor" onchange="cekangsuran()">
                                <option value="<?php echo $data['tenor'] ; ?>"><?php echo $data['tenor'] ; ?> Bulan</option>
                                <option value="6">6 Bulan</option>
                                <option value="12">12 Bulan</option>
                              </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Jumlah Angsuran</label>
                              <div class="col-sm-10">
                                  <input type="number" name="angsuran"  class="form-control" value="<?php echo $data['angsuran_bulanan'] ; ?>" readonly="">
                              </div>
                          </div>
                          <div class="form-group">
                          <div class="col-sm-12 text-right"> 
                          <button class="btn btn-warning" type="reset" name="reset">Atur Ulang</button>  
                          <button class="btn btn-success" type="submit" name="simpan">Simpan</button>
                          </div>
                          </div>

                      </form>
                          </div>
                          
                  </div>
                  </div>
          		</div><!-- col-lg-12-->      	
          	</div><!-- /row -->
            </div>
            </div>
