<?php include_once 'head.php'; ?>
<body class="contrast-red">
	
	<?php include_once 'navbar.php'; ?>

<div id="wrapper">
	<div id="main-nav-bg"></div>
	<nav class="" id="main-nav">
		<div class="navigation">
			<?php include_once 'sidebar.php'; ?>
		</div>		
	</nav>

	<section id="content">
		<div class="container-fluid">
			<div class="row-fluid" id="content-wrapper">
				<div class="span12">

					<?php include_once 'header.php'; ?>

					<div class="row-fluid">
						<div class="span12 box">
							<div class="box-content">
								<h3>Tambah Himpunan</h3>
								<?php 
								$id = isset($_GET['id_himpunan']) ? $_GET['id_himpunan']:'';
								$query = "SELECT tbl_himpunan.id_himpunan,tbl_himpunan.nama,tbl_himpunan.nilai,
								tbl_kriteria.id_kriteria,tbl_kriteria.nama_kriteria 
								FROM tbl_kriteria JOIN tbl_himpunan ON 
								tbl_kriteria.id_kriteria=tbl_himpunan.id_kriteria WHERE id_himpunan='".$id."'";
								$sql = mysqli_query($konek,$query);
								if (mysqli_num_rows($sql)>0) {
									$rows=mysqli_fetch_array($sql);
								}
								?>
								<form method="POST" action="">
									<input type="hidden" name="id" value="<?php print $id; ?>" />
									<table align="left">
										<tr>
											<td>NAMA KRITERIA</td>
											<td>:</td>
											<td><strong><?php print $rows['nama_kriteria'] ?></strong></td>
										</tr>
										<tr>
											<td>NAMA HIMPUNAN</td>
											<td>:</td>
											<td><input type="text" name="namahimpunan" value="<?php print $rows['nama'] ?>" required /></td>
										</tr>
										<tr>
											<td>NILAI</td>
											<td>:</td>
											<td><input type="text" name="nilai" value="<?php print $rows['nilai']; ?>" required /></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="3">
												<button class="btn btn-danger" name="ubah" type="submit"><i class="icon-save"></i> Simpan</button>
												<button class="btn" onclick="self.history.back()" type="button">Batal</button>
											</td>
										</tr>
									</table>
								</form>
								<?php 
								if (isset($_POST['ubah'])) {
									$id = $_POST['id'];
									$nama = $_POST['namahimpunan'];
									$nilai = $_POST['nilai'];

									$query = mysqli_query($konek,"UPDATE tbl_himpunan SET nama='$nama', nilai='$nilai' WHERE id_himpunan='$id'");

									if ($query) {
										echo "<script>window.alert('Data himpunan berhasil diubah');
                    window.location=(href='himpunan.php')</script>";
									}
								}
								?>
								<div class="clearfix"></div>
								<hr class="hr-normal"/>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

</div>

<?php include_once 'footer.php'; ?>