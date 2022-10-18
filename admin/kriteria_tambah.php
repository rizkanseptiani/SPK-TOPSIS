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
									<h3>Tambah Kriteria</h3>
									<form method='POST' action='kriteria_tambah.php'>
										<table align='left'>
											<tr>
												<td>NAMA KRITERIA</td>
												<td>:</td>
												<td><input type="text" name="nama_kriteria" required></td>
											</tr>
											<tr>
												<td>Atribut</td>
												<td>:</td>
												<td>
													<select name='atribut'>
														<option value="benefit">Benefit</option>
														<option value="cost">Cost</option>
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
												<button class='btn btn-danger' name="simpan" type='submit'><i class='icon-save'></i> Simpan</button>
		                    <button class='btn' onclick=self.history.back() type='button'>Batal</button>
												</td>
											</tr>
										</table>
									</form>

<?php
if(isset($_POST['simpan'])){

    $cek_data = mysqli_num_rows(mysqli_query($konek,"SELECT nama_kriteria FROM tbl_kriteria WHERE nama_kriteria='$_POST[nama_kriteria]'"));
    if ($cek_data > 0){
        echo "<script>window.alert('Data kriteria sudah ada! Mohon ulangi.');
                window.location=(href='kriteria_tambah.php')</script>";
	} else {
        $sql = "INSERT INTO tbl_kriteria VALUES('','$_POST[nama_kriteria]','$_POST[atribut]')";
        $query = mysqli_query($konek,$sql);
        if($query) {
        echo "<script>window.alert('Data kriteria berhasil ditambah');
                window.location=(href='kriteria.php')</script>";
        }
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