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
									<div align='left'><span><h3>Data Himpunan</h3></span></div>
									<div class='row-fluid'>
										<div class='span12 box bordered-box green-border' style='margin-bottom: 0;'>
											<span>
												<table class='table-bordered table-striped' style='margin-bottom: 0;'>
													<tr>
														<td>Nama Kriteria</td><td>&nbsp;</td>
														<td>
														<?php 
															$id = isset($_GET['id_kriteria']) ? $_GET['id_kriteria'] : false;
															// menampilkan data kriteria
															$result = mysqli_query($konek,"SELECT * FROM tbl_kriteria");
															// membuat combobox
															echo "<select name=\"prdId\" onchange=\"changeValue(this.value)\">";
															echo "<option>- Pilih -</option>";
															while ($row=mysqli_fetch_array($result)) {
																echo "<option value=\"".$row['id_kriteria']."\"".($id ? ($id==$row['id_kriteria'] ? 'selected' : '') : '').">".$row['nama_kriteria']."</option>";
															}
															echo "<select>";
														?>
														</td>
													</tr>
												</table><br/>
											</span>

											<div class='box-content box-no-padding'>
												<div class='responsive-table'>
													<div class='scrollable-area'>
														<div align='right'><?php if($id>0){?><a href="himpunan_tambah.php?id_kriteria=<?php print $id; ?>"><button class='btn btn-success'>Tambah Himpunan</button></a><?php } ?></div>
														<table class='table table-bordered table-hover table-striped' style='margin-bottom: 0;'>
															<thead>
																<tr>
																	<th><center>NO</center></th>
																	<th><center>NAMA</center></th>
																	<th><center>NILAI</center></th>
																	<th><center>AKSI</center></th>
																</tr>
															</thead>
															<?php 
															if ($id) {
																$q = "SELECT tbl_kriteria.id_kriteria,tbl_kriteria.nama_kriteria, tbl_himpunan.id_himpunan,tbl_himpunan.nama,tbl_himpunan.nilai
																FROM tbl_kriteria JOIN tbl_himpunan ON tbl_kriteria.id_kriteria=tbl_himpunan.id_kriteria
																WHERE tbl_kriteria.id_kriteria='$id'";
																$result = mysqli_query($konek,$q);
																$no=1;
																while ($row=mysqli_fetch_array($result)) {
																	?>
																<tbody>
																	<tr>
																		<td><center><?php print $no; ?></center></td>
																		<td><center><?php print $row['nama'] ?></center></td>
																		<td><center><?php print $row['nilai'] ?></center></td>
																		<td>
																			<div class="text-right">
																				<center>
																					<a class="btn btn-success btn-mini" href="himpunan_edit.php?id_himpunan=<?php print $row['id_himpunan']; ?>">
																						<i class="icon-edit"></i>
																					</a>
																					<a class="btn btn-danger btn-mini" href="himpunan_hapus.php?id_himpunan=<?php print $row['id_himpunan']; ?>">
																						<i class="icon-trash"></i>
																					</a>
																				</center>
																			</div>
																		</td>
																	</tr>
																</tbody>
															<?php
															$no++;
																}
															}
															?>
															
															<script type="text/javascript">
                                    function changeValue(id) {
                                        window.location = "?id_kriteria="+id;
                                    };
                                </script>
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