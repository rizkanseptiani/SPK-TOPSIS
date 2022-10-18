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
								<h3>Ubah Pegawai</h3>
								<?php 
								$id = isset($_GET['id_pegawai']) ? $_GET['id_pegawai']:'';
								$sql = mysqli_query($konek,"SELECT * FROM tbl_pegawai WHERE id_pegawai='$id'");
								$data = mysqli_fetch_array($sql);
								$jenkel=$data['jenkel'];
								?>
								<form method='POST' action='pegawai_edit.php'>
								<input type="hidden" name="id_pegawai" value="<?php echo $id; ?>"/>
								<table align='left'>
									<tr>
										<td>NIP</td>
										<td> : </td>
										<td><input type=text name='nip' placeholder='nip' value="<?=$data['nip'];?>"></td>
									</tr>			
									<tr>
										<td>NAMA</td>
										<td> : </td>
										<td><input type=text name='namapegawai' placeholder='Nama Pegawai' value="<?=$data['nama_pegawai']?>"></td>
									</tr>
									<tr>
										<td>JENIS KELAMIN</td>
										<td>:</td>
										<td><select name="jenkel">
												<option value="">-Pilih-</option>
												<option value="L" <?php if($jenkel=='L'){echo 'selected';} ?>>Laki-Laki</option>
												<option value="P" <?php if($jenkel=='P'){echo 'selected';} ?>>Perempuan</option>
											</select>
										</td>
									</tr>
	                <tr>
	                    <td>TEMPAT LAHIR</td>
	                    <td>:</td>
	                    <td><input type=text name='tmp_lahir' placeholder='tempat lahir' value="<?=$data['tmp_lahir']?>"></td>
	                </tr>
	                <tr>
	                    <td>TANGGAL LAHIR</td>
	                    <td>:</td>
	                    <td>
	                    <div class='datepicker input-append' id='datepicker'>
	                        <input class='input-medium' data-format='dd-MM-yyyy' placeholder='Tanggal Lahir' type=text name='tgl_lahir' value="<?=$data['tgl_lahir'] ?>" />
	                        <span class='add-on'>
	                            <i data-date-icon='icon-calendar' data-time-icon='icon-time'></i>
	                        </span>
	                    </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td>JABATAN</td>
	                    <td>:</td>
	                    <td><input type=text name='jabatan' placeholder='jabatan' value="<?=$data['jabatan'] ?>" /></td>
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
					$id = $_POST['id_pegawai'];
			    $nip = $_POST['nip'];
					$nama = $_POST['namapegawai'];
					$jenkel = $_POST['jenkel'];
					$tmpt = $_POST['tmp_lahir'];
			    $tgl = date("Y-m-d",strtotime($_POST['tgl_lahir']));
			    $jabatan = $_POST['jabatan'];

					$query=mysqli_query($konek,"UPDATE tbl_pegawai SET nip='$nip', nama_pegawai='$nama', jenkel='$jenkel',
				                        tmp_lahir='$tmpt', tgl_lahir='$tgl', jabatan='$jabatan' WHERE id_pegawai='$id'");
					if($query) {
					echo "<script>window.alert('Data pegawai berhasil diubah');
				            window.location=(href='pegawai.php')</script>";
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