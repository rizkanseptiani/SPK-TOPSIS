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
									<div align='left'><span><a href='kriteria_tambah.php'><button class='btn btn-success'>Tambah Kriteria</button></a></span></div>
									<div class='row-fluid'>
										<div class='span12 box bordered-box orange-border' style='margin-bottom: 0;'>
											<h3>Tabel Kriteria</h3>
											<div class='box-content box-no-padding'>
												<div class='responsive-table'>
													<div class='scrollable-area'>
														<table class='table table-bordered table-striped table-hover' style='margin-bottom: 0;'>
															<thead>
																<tr>
																	<th><center>No.</center></th>
																	<th><center>NAMA KRITERIA</center></th>
																	<th><center>ATRIBUT</center></th>
																	<th><center>SETTING</center></th>
																</tr>
															</thead>
															<tbody>
																<?php 
																$no=0;
																$hasil=mysqli_query($konek,"SELECT * FROM tbl_kriteria");
																while ($data = mysqli_fetch_array($hasil)) {
																	?>
																<tr>
																	<td><center><?php echo $no=$no+1; ?></center></td>
																	<td><center><?php print $data['nama_kriteria'] ?></center></td>
																	<td><center><?php print $data['atribut'] ?></center></td>
																	<td>
																		<div class='text-right'>
																			<center>
																				<a class='btn btn-success btn-mini' href="kriteria_edit.php?id_kriteria=<?php print $data['id_kriteria']; ?>">
																					<i class='icon-edit'></i>
																				</a>
																				<a class='btn btn-danger btn-mini' href="kriteria_hapus.php?id_kriteria=<?php print $data['id_kriteria']; ?>">
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