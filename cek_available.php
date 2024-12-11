<?php
require_once("config/config.php");
$connection=new Connection() ;
$conn=$connection->getConnection();


if(!empty($_POST["noid"])) {
  $sql2=$conn->query("SELECT * FROM anggota WHERE no_ktp='" . $_POST["noid"] . "'");
  $sql2->execute();
  $row2= $sql2->fetch(PDO::FETCH_ASSOC);
  $sql1=$conn->query("SELECT count(*) FROM anggota WHERE no_ktp='" . $_POST["noid"] . "'");
  $row = $sql1->fetchColumn();
  $user_count = $row[0];
  if($user_count>0) {
      echo "<span class='status-not-available'>Maaf, No Identitas sudah digunakan atas nama '".$row2['nama_anggota']."' dengan ID Anggota '".$row2['id_anggota']."'.</span>";
  }else{
      echo "<span class='status-available'> </span>";
  }
}
?>