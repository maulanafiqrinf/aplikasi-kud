<?php
require_once('config/config.php');

$connection=new Connection();
$conn=$connection->getConnection();
$id=$_GET['id'];


$sql2="DELETE FROM pengambilan WHERE kode_pengambilan='$id'";
	$delete2=$conn->exec($sql2);

?>

				<script>
					alert('Data berhasil dihapus');
					window.location.href="?p=pengambilan";
					</script>