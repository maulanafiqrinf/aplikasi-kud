<?php

require_once("config/config.php");

require_once("config/function.php");
$connection=new Connection() ;
$conn=$connection->getConnection();

if(isset($_POST['simpan'])){
$idanggota=$_POST['idanggota'];
$nama=$_POST['nama'];
$noid=$_POST['noid'];
$jk=$_POST['jk'];
$alamat=$_POST['alamat'];
$nohp=$_POST['nohp'];
$tgg=date('Y-m-d');

 $sql="UPDATE anggota SET nama_anggota='$nama',no_ktp='$noid',gender='$jk',alamat='$alamat',no_ktp='$nohp' WHERE kode_anggota='$idanggota'" ;
 $conn->exec($sql);

  echo "<script>alert(\"Data berhasil disimpan !\") ; window.location.href='?p=anggota' ;</script>";

}



//Kode buat tamu

 $id=$_GET['id'];
    $query3 = $conn->prepare("SELECT * FROM anggota WHERE kode_anggota='$id'");
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
    url: "cek_available.php",
    data:'noid='+$("#noid").val(),
    type: "POST",
    success:function(data){
        $("#user-availability-status").html(data);
    },
    error:function (){}
    });
}
</script>
<div class="main-content">
        <div class="container-fluid">
            <h3><a href="?p=home">Beranda </a><i class="fa fa-angle-right"></i> <a href="?p=tamu">Data Anggota </a><i class="fa fa-angle-right"></i> Tambah Anggota</h3>
            
            <!-- BASIC FORM ELELEMNTS -->
            <div class="row">
              <div class="col-lg-12">
                  <div class="panel">
                  <div class="panel-heading">
                      <h4 class="mb"><strong> Tambah Anggota</strong></h4>
                      </div>
                      <div class="panel-body">

                      <form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF'] ; ?>" onSubmit="return confirm('Anda yakin akan menyimpan data ?')">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Kode Anggota</label>
                              <div class="col-sm-10">
                                  <input type="text" name="idanggota"  class="form-control"  readonly="readonly" value="<?php echo $id ; ?>" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Nama Anggota</label>
                              <div class="col-sm-10">
                                  <input type="text" name="nama"  class="form-control" placeholder="Masukan Nama Anggota" value="<?php echo $data['nama_anggota'] ; ?>" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">No.Identitas(KTP)</label>
                              <div class="col-sm-10">
                                  <input type="text" name="noid" id="noid"  class="form-control" placeholder="Masukan No Identitas (KTP)"  required="required" value="<?php echo $data['no_ktp'] ; ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Jenis Kelamin</label>
                              <div class="col-sm-10">
                                  <select   class="form-control" name="jk" required >
                                    <option value="<?php echo $data['gender'] ; ?>"><?php echo $data['gender'] ; ?></option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Alamat</label>
                              <div class="col-sm-10">
                                  <textarea class="form-control" name="alamat" placeholder="Contoh: Jl.Jendral Sudirman No.24 Sukabumi"><?php echo $data['alamat'] ; ?></textarea>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">No Hp</label>
                              <div class="col-sm-10">
                                  <input type="text" name="nohp" value="<?php echo $data['no_hp'] ; ?>"  class="form-control" placeholder="Masukan No HP" required>
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
