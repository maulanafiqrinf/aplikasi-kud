<?php

require_once("config/config.php");

require_once("config/function.php");
$connection=new Connection() ;
$conn=$connection->getConnection();



if(isset($_POST['simpan'])){
$tgg=date('Y-m-d');
$tenor=$_POST['tenor'];
$kp=$_POST['kp'];
$ab=$_POST['ab'];
$ke=$_POST['ke'];

$sisa=$tenor-$ke;

if($sisa==0){

 $sql="INSERT INTO angsuran VALUES ('','$kp','$ab','$tgg','$ke')" ;
 $conn->exec($sql);


 $sql2="UPDATE pinjaman SET status='Lunas' WHERE kode_pinjaman='$kp'" ;
 $conn->exec($sql2);



  echo "<script>alert(\"Data berhasil disimpan & pinjaman sudah lunas !\") ; window.location.href='?p=angsuran' ;</script>";
}
else {


 $sql="INSERT INTO angsuran VALUES ('','$kp','$ab','$tgg','$ke')" ;
 $conn->exec($sql);

 echo "<script>alert(\"Data berhasil disimpan !\") ; window.location.href='?p=angsuran' ;</script>";
}
}
?>