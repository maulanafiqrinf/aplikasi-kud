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
$simpanan=$_POST['simpanan'];
$jd=$_POST['jd'];
$sisa=$_POST['sisa'];


  $sql1=$conn->query("SELECT count(*) FROM anggota WHERE kode_anggota='" . $_POST["ka"] . "'");
  $row = $sql1->fetchColumn();
if($row>0){

  if($jd<=$simpanan && $sisa>=0 ){
 $sql="UPDATE pengambilan SET tgl_pengambilan='$tgl',jumlah_pengambilan='$jd' WHERE kode_pengambilan='$idp'" ;
 $conn->exec($sql);


  echo "<script>alert(\"Data berhasil disimpan !\") ; window.location.href='?p=pengambilan' ;</script>";
}
else {
   echo "<script>alert(\"Data gagal disimpan, silahkan coba lagi !\") ; window.location.href='?p=pengambilan' ;</script>";

}
}
else {
  echo "<script>alert(\"Data gagal disimpan, kode anggota tidak terdaftar, silahkan coba lagi !\") ; window.location.href='?p=pengambilan' ;</script>";
  
}

}

 $id=$_GET['id'];
    $query3 = $conn->prepare("SELECT * FROM pengambilan WHERE kode_pengambilan='$id'");
    $query3->execute();
    $data = $query3->fetch(PDO::FETCH_ASSOC);


   
  $sql1=$conn->query("SELECT SUM(jumlah_simpan) FROM simpanan WHERE  kode_anggota='$data[kode_anggota]'");
  $row1 = $sql1->fetchColumn();
  $sql2=$conn->query("SELECT SUM(jumlah_pengambilan) FROM pengambilan WHERE  kode_anggota='$data[kode_anggota]'");
  $row2 = $sql2->fetchColumn();

  $total=$row1-$row2+$data['jumlah_pengambilan'];
  $sisa=$total-$data['jumlah_pengambilan'];

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

function cek_simpanan() {  
    jQuery.ajax({
    url: "cek_simpanan.php",
    data:'ka='+$("#ka").val(),
    type: "POST",
    success:function(data){
        document.addem.simpanan.value = data;
    },
    error:function (){}
    });
}

function calculate() {
  var simpanan=document.addem.simpanan.value;
  var jd=document.addem.jd.value;

  totalR=eval(parseInt(simpanan)-parseInt(jd));

  document.addem.sisa.value= totalR;


}
</script>
<div class="main-content">
        <div class="container-fluid">
          	<h3><a href="?p=home">Beranda </a><i class="fa fa-angle-right"></i> <a href="?p=pengambilan">Data Pengambilan</a><i class="fa fa-angle-right"></i> Tambah Pengambilan</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row">
          		<div class="col-lg-12">
                  <div class="panel">
                  <div class="panel-heading text-center">
                  	  <h4 class="mb"><strong> Transaksi Pengambilan Simpanan</strong></h4>
                      </div>
                      <div class="panel-body">

                      <form class="form-horizontal" method="post" name="addem" action="<?php $_SERVER['PHP_SELF'] ; ?>" onSubmit="return confirm('Anda yakin akan menyimpan data ?')">
                      <input type="hidden" name="idp" value="<?php echo $data['kode_pengambilan'] ; ?>">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Tanggal</label>
                              <div class="col-sm-10">
                                  <input type="date" name="tgl"  class="form-control" value="<?php echo $data['tgl_pengambilan'] ; ?>" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Kode Anggota</label>
                              <div class="col-sm-10">
                                  <input type="text" name="ka" id="ka"  class="form-control" placeholder="Masukan Kode Anggota" value="<?php echo $data['kode_anggota'] ; ?>" >
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Jumlah Simpanan</label>
                              <div class="col-sm-10">
                                  <input type="number" name="simpanan"  class="form-control"  value="<?php echo $total ; ?>" readonly="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Jumlah Diambil</label>
                              <div class="col-sm-10">
                                  <input type="number" name="jd" onkeyup="calculate()"  class="form-control" placeholder="Masukan Jumlah Pengambilan" value="<?php echo $data['jumlah_pengambilan'] ; ?>" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Sisa Tabungan</label>
                              <div class="col-sm-10">
                                  <input type="number" name="sisa" value="<?php echo $sisa ; ?>"  class="form-control" readonly="">
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
