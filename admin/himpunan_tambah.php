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
								$id = isset($_GET['id_kriteria']) ? $_GET['id_kriteria']:'';
								$query = "SELECT * FROM tbl_kriteria WHERE id_kriteria='".$id."'";
								$sql = mysqli_query($konek,$query);
								if (mysqli_num_rows($sql)>0) {
									$rows=mysqli_fetch_array($sql);
								}
								?>
								<form method="POST" action="himpunan_tambah.php">
									<input type="hidden" name="kriteria_id" value="<?php print $id; ?>" />
									<table align="left">
										<tr>
											<td>NAMA KRITERIA</td>
											<td>:</td>
											<td><strong><?php print $rows['nama_kriteria'] ?></strong></td>
										</tr>
										<tr>
											<td>NAMA HIMPUNAN</td>
											<td>:</td>
											<td><input type="text" name="namahimpunan" required /></td>
										</tr>
										<tr>
											<td>NILAI</td>
											<td>:</td>
											<td><input type="text" name="nilai" required /></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="3">
												<button class="btn btn-danger" name="simpan" type="submit"><i class="icon-save"></i> Simpan</button>
												<button class="btn" onclick="self.history.back()" type="button">Batal</button>
											</td>
										</tr>
									</table>
								</form>
								<?php 
								if (isset($_POST['simpan'])) {
									$kriteria_id = $_POST['kriteria_id'];
									$namahimp = $_POST['namahimpunan'];
									$nilai = $_POST['nilai'];

									$cek_data = mysqli_num_rows(mysqli_query($konek,"SELECT nama, nilai FROM tbl_himpunan WHERE nama='$_POST[namahimpunan]' AND nilai='$_POST[nilai]'"));
									if ($cek_data>0) {
										echo "<script>window.alert('Data himpunan sudah ada! Mohon ulangi.');
                        window.location=(href='himpunan_tambah.php')</script>";
									} else {
										$sql = "INSERT INTO tbl_himpunan VALUES('','$kriteria_id','$namahimp','$nilai')";
										$query = mysqli_query($konek,$sql);
										if ($query) {
											echo "<script>window.alert('Data himpunan berhasil ditambah');
                        window.location=(href='himpunan.php')</script>";
										}
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