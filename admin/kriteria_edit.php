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
									<h3>Ubah Kriteria</h3>
									<?php 
									$id = isset($_GET['id_kriteria']) ? $_GET['id_kriteria']:'';
									$sql = mysqli_query($konek,"SELECT * FROM tbl_kriteria WHERE id_kriteria='$id'");
									$data = mysqli_fetch_array($sql);
									?>
									<form method='POST' action='kriteria_edit.php'>
									<input type="hidden" name="kriteria_id" value="<?php print $id; ?>"/>
										<table align='left'>
											<tr>
												<td>NAMA KRITERIA</td>
												<td>:</td>
												<td><input type="text" name="nama_kriteria" value="<?php print $data['nama_kriteria'] ?>" required></td>
											</tr>
											<tr>
												<td>Atribut</td>
												<td>:</td>
												<td>
													<select name='atribut'>
														<option>Pilih Atribut</option>
														<option value="benefit" <?php if($data['atribut']=='benefit'){print 'selected';} ?>>Benefit</option>
														<option value="cost" <?php if($data['atribut']=='cost'){print 'selected';} ?>>Cost</option>
													</select>
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
		$id_kriteria = $_POST['kriteria_id'];
		$nama_kriteria = $_POST['nama_kriteria'];
		$atribut = $_POST['atribut'];
    $sql = mysqli_query($konek,"UPDATE tbl_kriteria SET nama_kriteria='$nama_kriteria', atribut='$atribut' WHERE id_kriteria='$id_kriteria'");
    if ($sql) {
    	echo "<script>window.alert('Data kriteria berhasil diubah');
       		 window.location=(href='kriteria.php')</script>";
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