<?php 
include '../inc/koneksi.php';

$id = isset($_GET['id_bobot']) ? $_GET['id_bobot']:'';
$query = mysqli_query($konek,"DELETE FROM tbl_bobot WHERE id_bobot='$id'") or die(mysql_error());
if ($query) {
?>
	<script>
		alert('Data bobot berhasil dihapus');
		document.location='bobot.php';
	</script>
<?php
}
?>