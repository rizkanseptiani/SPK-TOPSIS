<?php 
include '../inc/koneksi.php';

$id = isset($_GET['id_pegawai']) ? $_GET['id_pegawai']:'';
$query = mysqli_query($konek,"DELETE FROM tbl_pegawai WHERE id_pegawai='$id'") or die(mysql_error());
if ($query) {
?>
	<script>
		alert('Data pegawai berhasil dihapus');
		document.location='pegawai.php';
	</script>
<?php
}
?>