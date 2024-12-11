<?php
require_once("config/config.php");
$connection=new Connection() ;
$conn=$connection->getConnection();


if(!empty($_POST["ka"])) {
  $sql2=$conn->query("SELECT * FROM anggota WHERE kode_anggota='" . $_POST["ka"] . "'");
  $sql2->execute();
  $row2= $sql2->fetch(PDO::FETCH_ASSOC);
  $sql1=$conn->query("SELECT count(*) FROM anggota WHERE kode_anggota='" . $_POST["ka"] . "'");
  $row = $sql1->fetchColumn();
  $user_count = $row[0];
  if($user_count==0) {
      echo "<span class='status-not-available'>Maaf, kode anggota tidak ditemukan, silahkan cek kembali!!!.</span>";
  }else{
      echo "<span class='status-available'> Kode anggota '".$row2['kode_anggota']."', Nama Anggota '".$row2['nama_anggota']."' </span>";
  }
}
?>