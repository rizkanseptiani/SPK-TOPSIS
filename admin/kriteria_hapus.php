<?php 
include '../inc/koneksi.php';

$id = isset($_GET['id_kriteria']) ? $_GET['id_kriteria']:'';
$query = mysqli_query($konek,"DELETE FROM tbl_kriteria WHERE id_kriteria='$id'");
if ($query) {
?>
	<script>
		alert('Data kriteria berhasil dihapus');
		document.location='kriteria.php';
	</script>
<?php
}
?>