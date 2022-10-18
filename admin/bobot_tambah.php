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
									<h3>Tambah Bobot</h3>
									<form method='POST' action='bobot_tambah.php'>
										<table align='left'>
											<tr>
												<td>NAMA BOBOT</td>
												<td>:</td>
												<td><input type="text" name="nama_bobot" required></td>
											</tr>
											<tr>
												<td>NILAI</td>
												<td>:</td>
												<td><input type="text" name="nilai" required>
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

    $cek_data = mysqli_num_rows(mysqli_query($konek,"SELECT nama_bobot FROM tbl_bobot WHERE nama_bobot='$_POST[nama_bobot]'"));
    if ($cek_data > 0){
        echo "<script>window.alert('Data kriteria sudah ada! Mohon ulangi.');
                window.location=(href='bobot_tambah.php')</script>";
	} else {
        $sql = "INSERT INTO tbl_bobot VALUES('','$_POST[nama_bobot]','$_POST[nilai]')";
        $query = mysqli_query($konek,$sql);
        if($query) {
        echo "<script>window.alert('Data Bobot berhasil ditambah');
                window.location=(href='bobot.php')</script>";
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