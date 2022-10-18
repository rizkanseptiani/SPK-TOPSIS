<?php 
include_once "../admin/head.php";
?>
<body class='contrast-red'>
	<?php include_once 'navbar.php'; ?>

	<div id='wrapper'>
		<div id='main-nav-bg'></div>
		<nav class='' id="main-nav">
			<div class='navigation'>
				<?php 
				include_once '../admin/sidebar.php';
				?>
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
									<div align='left'>
										<span>
											<a href="pegawai_tambah.php"><button class='btn btn-danger'>Tambah Pegawai</button></a>
										</span>
									</div>
									<div class='row-fluid'>
										<div class='span12 box bordered-box orange-border' style='margin-bottom: 0;'>
											<h3>Tabel Pegawai</h3>
											<div class='responsive-table'>
												<div class='scrollable-area'>
													<table class='data-table table table-bordered table-striped' style='margin-bottom: 0;'>
														<thead>
															<tr>
																<th><center>No.</center></th>
																<th><center>NIP</center></th>
																<th><center>NAMA</center></th>
																<th><center>JENIS KELAMIN</center></th>
																<th><center>TEMPAT LAHIR</center></th>
																<th><center>TANGGAL LAHIR</center></th>
																<th><center>JABATAN</center></th>
																<th><center>SETTING</center></th>
															</tr>
														</thead>
														<tbody>
															<?php 
															$no=0;
															$sql = mysqli_query($konek,"SELECT * FROM tbl_pegawai");
															while ($data = mysqli_fetch_array($sql)) {
																$jenkel = $data['jenkel'];
																?>
															<tr>
																<td><center><?php echo $no=$no+1; ?></center></td>
																<td><center><?php echo $data['nip']; ?></center></td>
																<td><center><?php echo $data['nama_pegawai']; ?></center></td>
																<td><center><?php echo $jenkel = ($jenkel=='L') ? 'Laki-laki' : 'Perempuan' ; ?></center></td>
																<td><center><?php echo $data['tmp_lahir']; ?></center></td>
																<td><center><?php echo date('d-m-Y',strtotime($data['tgl_lahir'])); ?></center></td>
																<td><center><?php echo $data['jabatan']; ?></center></td>						
																<td>
																	<div class='text-right'>
																		<center>
																			<a class='btn btn-success btn-mini' href="pegawai_edit.php?id_pegawai=<?php echo $data['id_pegawai'];?>">
																				<i class='icon-edit'></i>
																			</a>
																			<a class='btn btn-warning btn-mini' href="pegawai_hapus.php?id_pegawai=<?php echo $data['id_pegawai'];?>">
																				<i class='icon-trash'></i>
																			</a>
																		</center>
																	</div>
																</td>
															</tr>
																<?php
															}
															?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
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