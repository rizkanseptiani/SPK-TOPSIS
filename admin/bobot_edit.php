<?php include_once 'head.php'; ?>

<body class='contrast-red'>
	<?php include_once 'navbar.php'; ?>
	<div id='wrapper'>
		<div id='main-nav-bg'></div>
		<nav class='' id='main-nav'>
			<div class='navigation'>
				<?php include_once 'sidebar.php'; ?>
			</div>
		</nav>

		<section id='content'>
			<div class='container-fluid'>
				<div class='row-fluid' id='content-wrapper'>
					<div class='span12'>
						
					<?php include 'header.php' ?>
						<div class='row-fluid'>
							<div class='span12 box'>
								<div class='box-content'>
									<h3>Ubah Bobot</h3>
									<?php 
									$id = isset($_GET['id_bobot']) ? $_GET['id_bobot']:'';
									$sql = mysqli_query($konek,"SELECT * FROM tbl_bobot WHERE id_bobot='$id'");
									$data = mysqli_fetch_array($sql);
									?>
									<form method='POST' action='bobot_edit.php'>
									<input type="hidden" name="bobot_id" value="<?php print $id; ?>">
										<table align='left'>
											<tr>
												<td>NAMA BOBOT</td>
												<td>:</td>
												<td><input type="text" name="nama_bobot" value="<?php print $data['nama_bobot'] ?>" required></td>
											</tr>
											<tr>
												<td>NILAI</td>
												<td>:</td>
												<td><input type="text" name="nilai" value="<?php print $data['nilai'] ?>" required>
												</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											<tr>
											<tr>
												<td colspan=3>
												<button class='btn btn-danger' name="ubah" type='submit'><i class='icon-save'></i> Simpan</button>
		                    <button class='btn' onclick=self.history.back() type='button'>Batal</button>
												</td>
											</tr>
										</table>
									</form>

<?php
if(isset($_POST['ubah'])){
	$id_bobot = $_POST['bobot_id'];
	$nama_bobot = $_POST['nama_bobot'];
	$nilai = $_POST['nilai'];

  $sql = mysqli_query($konek,"UPDATE tbl_bobot SET nama_bobot='$nama_bobot', nilai='$nilai' WHERE id_bobot='$id_bobot'");
 if ($sql) {
 	echo "<script>window.alert('Data kriteria berhasil diubah');
          window.location=(href='bobot.php')</script>";
 }
}
?>

									<div class='clearfix'></div>
									<hr class='hr-normal'/>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section>

	</div>

<?php include_once 'footer.php'; ?>