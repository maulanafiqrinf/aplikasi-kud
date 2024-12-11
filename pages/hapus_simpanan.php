<?php
require_once('config/config.php');

$connection=new Connection();
$conn=$connection->getConnection();
$id=$_GET['id'];


$sql2="DELETE FROM simpanan WHERE no_simpanan='$id'";
	$delete2=$conn->exec($sql2);

?>

				<script>
					alert('Data berhasil dihapus');
					window.location.href="?p=simpanan";
					</script>