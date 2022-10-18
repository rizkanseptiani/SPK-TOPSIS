<?php 
include_once 'head.php';
?>
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
					<?php include_once 'header.php'; ?>
					
					<div class='row-fluid'>
				    <div class='span12 box'>
			        <div class='box-content'>
								<h3>Tambah Pegawai</h3>
								<form method='POST' action='pegawai_tambah.php'>
								<table align='left'>
									<tr>
										<td>NIP</td>
										<td> : </td>
										<td><input type=text name='nip' placeholder='nip' required></td>
									</tr>			
									<tr>
										<td>NAMA</td>
										<td> : </td>
										<td><input type=text name='nama_pegawai' placeholder='Nama Pegawai' required></td>
									</tr>
									<tr>
										<td>JENIS KELAMIN</td>
										<td>:</td>
										<td><select name="jenkel">
												<option value="">-Pilih-</option>
												<option value="L">Laki-Laki</option>
												<option value="P">Perempuan</option>
											</select>
										</td>
									</tr>
	                <tr>
	                    <td>TEMPAT LAHIR</td>
	                    <td>:</td>
	                    <td><input type=text name='tmpt_lahir' placeholder='tempat lahir' required></td>
	                </tr>
	                <tr>
	                    <td>TANGGAL LAHIR</td>
	                    <td>:</td>
	                    <td>
	                    <div class='datepicker input-append' id='datepicker'>
	                        <input class='input-medium' data-format='dd-MM-yyyy' placeholder='Tanggal Lahir' type=text name='tgl_lahir' />
	                        <span class='add-on'>
	                            <i data-date-icon='icon-calendar' data-time-icon='icon-time'></i>
	                        </span>
	                    </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td>JABATAN</td>
	                    <td>:</td>
	                    <td><input type=text name='jabatan' placeholder='jabatan' /></td>
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
				    $tgl = date("Y-m-d",strtotime($_POST['tgl_lahir']));

				    $cek_data = mysqli_num_rows(mysqli_query($konek,"SELECT nip FROM tbl_pegawai WHERE nip='$_POST[nip]'"));
				    if ($cek_data > 0){
				        echo "<script>window.alert('Data sudah ada! Mohon ulangi.');
				                window.location=(href='pegawai_tambah.php')</script>";
				    } else {
				        $sql = "INSERT INTO tbl_pegawai VALUES('','$_POST[nip]','$_POST[nama_pegawai]','$_POST[jenkel]',
				                '$_POST[tmpt_lahir]','$_POST[tgl_lahir]','$_POST[jabatan]')";
				        $query = mysqli_query($konek,$sql) or die(mysqli_error());
				        if($query) {
				        echo "<script>window.alert('Data pegawai berhasil ditambah');
				            window.location=(href='pegawai.php')</script>";
				        }
				    }
				}
				?>
			            <div class='clearfix'></div>
			            <hr class='hr-normal' />
			        </div>
				    </div>
					</div>

				</div>
			</div>
		</div>
	</section>
</div>

<?php include_once 'footer.php'; ?>