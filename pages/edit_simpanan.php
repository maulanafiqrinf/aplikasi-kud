<?php

require_once("config/config.php");

require_once("config/function.php");
$connection=new Connection() ;
$conn=$connection->getConnection();

$tgg=date('Y-m-d');

if(isset($_POST['simpan'])){
$ids=$_POST['ids'];
$tgl=$_POST['tgl'];
$ka=$_POST['ka'];
$js=$_POST['js'];


 $sql="UPDATE simpanan SET tgl_simpan='$tgl', jumlah_simpan='$js' WHERE no_simpanan='$ids'" ;
 $conn->exec($sql);


  echo "<script>alert(\"Data berhasil disimpan !\") ; window.location.href='?p=simpanan' ;</script>";



}

 $id=$_GET['id'];
    $query3 = $conn->prepare("SELECT * FROM simpanan WHERE no_simpanan='$id'");
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

<div class="main-content">
        <div class="container-fluid">
          	<h3><a href="?p=home">Beranda </a><i class="fa fa-angle-right"></i> <a href="?p=simpanan">Data Simpanan</a><i class="fa fa-angle-right"></i> Tambah Simpanan</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row">
          		<div class="col-lg-12">
                  <div class="panel">
                  <div class="panel-heading text-center">
                  	  <h4 class="mb"><strong> Edit Data Simpanan</strong></h4>
                      </div>
                      <div class="panel-body">

                      <form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF'] ; ?>" onSubmit="return confirm('Anda yakin akan menyimpan data ?')">
                      <input type="hidden" name="ids" value="<?php echo $data['no_simpanan'] ; ?>">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Tanggal</label>
                              <div class="col-sm-10">
                                  <input type="date" name="tgl"  class="form-control" value="<?php echo $data['tgl_simpan'] ; ?>" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Kode Anggota</label>
                              <div class="col-sm-10">
                                  <input type="text" name="ka" id="ka"  class="form-control" placeholder="Masukan Kode Anggota" value="<?php echo $data['kode_anggota'] ; ?>" readonly>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Jumlah Simpan</label>
                              <div class="col-sm-10">
                                  <input type="number" name="js"  class="form-control" placeholder="Masukan Jumlah Simpanan" value="<?php echo $data['jumlah_simpan'] ; ?>" required>
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
