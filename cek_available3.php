<?php
require_once("include/config.php");
$connection=new Connection() ;
$conn=$connection->getConnection();


if(!empty($_POST["nis"])) {
  $sql2=$conn->query("SELECT * FROM siswa WHERE nis='" . $_POST["nis"] . "'");
  $sql2->execute();
  $row2= $sql2->fetch(PDO::FETCH_ASSOC);
  $sql1=$conn->query("SELECT count(*) FROM siswa WHERE nis='" . $_POST["nis"] . "'");
  $row = $sql1->fetchColumn();
  $user_count = $row[0];
  if($user_count>0) {
      echo "<span class='status-available'>Nama Siswa : '".$row2['nama_siswa']."', Kelas : '".$row2['kelas']."'</span>";
  }else{
      echo "<span class='status-not-available'> Mohon maaf NIS tidak ada.</span>";
  }
}
?>