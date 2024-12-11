<?php
require_once("config/config.php");
$connection=new Connection() ;
$conn=$connection->getConnection();


if(isset($_POST['ka'])) {
	$ka=$_POST['ka'];
  $sql2=$conn->query("SELECT SUM(jumlah_simpan) AS total FROM simpanan WHERE  kode_anggota='$ka' ");
  $sql2->execute();
  $total=$sql2->fetch(PDO::FETCH_ASSOC); 

  $sql3=$conn->query("SELECT SUM(jumlah_pengambilan) AS total2 FROM pengambilan WHERE  kode_anggota='$ka' ");
  $sql3->execute();
  $total3=$sql3->fetch(PDO::FETCH_ASSOC); 
  $totali=$total['total']-$total3['total2'] ;


      echo $totali ;

}
?>