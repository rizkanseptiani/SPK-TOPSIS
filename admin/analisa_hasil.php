<?php include_once 'head.php'; ?>

<body class="contrast-red">
	<?php include_once 'navbar.php'; ?>

	<div id="main-nav-bg"></div>
	<nav class="" id="main-nav">
		<div class="navigation">
			<?php include_once 'sidebar.php'; ?>
		</div>
	</nav>

	<section id="content">
		<div class="container-fluid" id="content-wrapper">
			<div class="span12">
				<?php include_once 'header.php'; ?>


				<?php
    $dbhost='localhost';
    $dbuser='root';
    $dbpass='';
    $dbname='pegawai';
    $db=new mysqli($dbhost,$dbuser,$dbpass,$dbname);

    $sql = "SELECT  
    a.nama_pegawai name, b.nama_kriteria as criteria, c.nilai as value,b.bobot_kriteria as weight, b.atribut as attribute  
    FROM
    tbl_pegawai a, tbl_kriteria b, tbl_himpunan c,  tbl_klasifikasi d 
    where  
    a.id_pegawai=d.id_pegawai and c.id_himpunan=d.id_himpunan and b.id_kriteria=c.id_kriteria";

    $result=$db->query($sql);
    $data=array();
    $kriterias=array();
    $bobot=array();
    $atribut=array();
    $nilai_kuadrat=array();
  while($row=$result->fetch_object()){
    if(!isset($data[$row->name])){
    $data[$row->name]=array();
    }
    if(!isset($data[$row->name][$row->criteria])){
    $data[$row->name][$row->criteria]=array();
    }
    if(!isset($nilai_kuadrat[$row->criteria])){
    $nilai_kuadrat[$row->criteria]=0;
    }
    $bobot[$row->criteria]=$row->weight;
    $atribut[$row->criteria]=$row->attribute;
    $data[$row->name][$row->criteria]=$row->value;
    $nilai_kuadrat[$row->criteria]+=pow($row->value,2);
    $kriterias[]=$row->criteria;
  }
  $kriteria=array_unique($kriterias);
  $jml_kriteria=count($kriteria);


?>

				<div class="row-fluid">
					<div class="span12 box">
						<div class="box-content">
							<div class="row-fluid">
								<div class='span12 box bordered-box orange-border' style='margin-bottom: 0;'>
								<h3>Evaluation Matrix (x<sub>ij</sub>)</h3>
									<div class="box-content box-no-padding">
										<div class="responsive-table">
											<form>
												<table class="table" style="margin-bottom: 0;">
													<thead>
												    <tr>
												      <th rowspan="4">No</th> 
												      <th rowspan="3">Alternatif</th>
												      <th rowspan="3">nama</th>
												      <th colspan='<?php echo $jml_kriteria ?>'><center>Keriteria</center></th>
												    </tr>
												    <tr>
												    <?php 
												      foreach ($kriteria as $k) {
												        echo "<th>{$k}</th>";
												      }
												    ?>
												    </tr>
												    <tr>
												    <?php 
												    for ($n=1; $n<=$jml_kriteria; $n++) { 
												      echo "<th>C{$n}</th>";
												    }
												     ?>
												    </tr>
												  </thead>
												  <tbody>
												    <?php 
												    $i=0;
												    foreach ($data as $nama=>$krit) {
												      echo "<tr>
												      <td>".(++$i)."</td>
												      <th>A{$i}</th>
												      <th>{$nama}</th>";
												      foreach ($kriteria as $k) {
												        echo "<td align='center'>{$krit[$k]}</td>";
												      }
												      echo "</tr>";
												    }
												    ?>
												  </tbody>
												</table>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
            <hr class="hr-normal"/>
					</div>
				</div>


				<div class="row-fluid">
					<div class="span12 box">
						<div class="box-content">
							<div class="row-fluid">
								<div class='span12 box bordered-box orange-border' style='margin-bottom: 0;'>
								<h2>Rating Kinerja Ternormalisasi (r<sub>ij</sub>)</h2>
									<div class="box-content box-no-padding">
										<div class="responsive-table">
											<form>
												<table class="table" style="margin-bottom: 0;">
													<thead>
												    <tr>
												      <th rowspan="4">No</th> 
												      <th rowspan="3">Alternatif</th>
												      <th rowspan="3">nama</th>
												      <th colspan='<?php echo $jml_kriteria ?>'><center>Keriteria</center></th>
												    </tr>
												    <tr>
												    <?php 
												      foreach ($kriteria as $k) {
												        echo "<th>{$k}</th>";
												      }
												    ?>
												    </tr>
												    <tr>
												    <?php 
												    for ($n=1; $n<=$jml_kriteria; $n++) { 
												      echo "<th>C{$n}</th>";
												    }
												     ?>
												    </tr>
												  </thead>
												  <tbody>
												    <?php 
												    $i=0;
												    foreach ($data as $nama=>$krit) {
												      echo "<tr>
												      <td>".(++$i)."</td>
												      <th>A{$i}</th>
												      <th>{$nama}</th>";
												      foreach ($kriteria as $k) {
												        echo "<td align='center'>".round(($krit[$k])/sqrt($nilai_kuadrat[$k]),4)."</td>";
												      }
												      echo "</tr>";
												    }
												    ?>
												  </tbody>
												</table>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
            <hr class="hr-normal"/>
					</div>
				</div>



				<div class="row-fluid">
					<div class="span12 box">
						<div class="box-content">
							<div class="row-fluid">
								<div class='span12 box bordered-box orange-border' style='margin-bottom: 0;'>
								<h2>Rating Bobot Ternormalisasi(y<sub>ij</sub>)</h2>
									<div class="box-content box-no-padding">
										<div class="responsive-table">
											<form>
												<table class="table" style="margin-bottom: 0;">
													<thead>
												    <tr>
												      <th rowspan="4">No</th> 
												      <th rowspan="3">Alternatif</th>
												      <th rowspan="3">nama</th>
												      <th colspan='<?php echo $jml_kriteria ?>'><center>Keriteria</center></th>
												    </tr>
												    <tr>
												    <?php 
												      foreach ($kriteria as $k) {
												        echo "<th>{$k}</th>";
												      }
												    ?>
												    </tr>
												    <tr>
												    <?php 
												    for ($n=1; $n<=$jml_kriteria; $n++) { 
												      echo "<th>C{$n}</th>";
												    }
												     ?>
												    </tr>
												  </thead>
												  <tbody>
												    <?php 
												    $i=0;
												    foreach ($data as $nama=>$krit) {
												      echo "<tr>
												      <td>".(++$i)."</td>
												      <th>A{$i}</th>
												      <th>{$nama}</th>";
												      foreach ($kriteria as $k) {
												        $y[$k][$i-1]=round(($krit[$k]/sqrt($nilai_kuadrat[$k])),4)*$bobot[$k];
      													echo "<td align='center'>".$y[$k][$i-1]."</td>";
												      }
												      echo "</tr>";
												    }
												    ?>
												  </tbody>
												</table>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
            <hr class="hr-normal"/>
					</div>
				</div>



				<div class="row-fluid">
					<div class="span12 box">
						<div class="box-content">
							<div class="row-fluid">
								<div class='span12 box bordered-box orange-border' style='margin-bottom: 0;'>
								<h2>Solusi Ideal positif (A<sup>+</sup>)</h2>
									<div class="box-content box-no-padding">
										<div class="responsive-table">
											<form>
												<table class="table" style="margin-bottom: 0;">
													<thead>
												    <tr>
												      <th colspan='<?php echo $jml_kriteria ?>'><center>Keriteria</center></th>
												    </tr>
												    <tr>
												    <?php 
												      foreach ($kriteria as $k) {
												        echo "<th>{$k}</th>";
												      }
												    ?>
												    </tr>
												    <tr>
												    <?php  
												    for ($n=1; $n<=$jml_kriteria; $n++) { 
												      echo "<th>y<sub>{$n}</sub><sup>+</sup></th>";
												    }
												    ?>
												    </tr>
												  </thead>
												  <tbody>
												  <tr>
											  	<?php 
											    $yplus=array();
											    foreach ($kriteria as $k) {
											    	$yplus[$k]=($atribut[$k]=='benefit'?max($y[$k]):min($y[$k]));
											    	echo "<th>{$yplus[$k]}</th>";
											    }
											    ?>
												  </tr>
												  </tbody>
												</table>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
            <hr class="hr-normal"/>
					</div>
				</div>


				<div class="row-fluid">
					<div class="span12 box">
						<div class="box-content">
							<div class="row-fluid">
								<div class='span12 box bordered-box orange-border' style='margin-bottom: 0;'>
								<h2>Solusi Ideal Negatif (A<sup>-</sup>)</h2>
									<div class="box-content box-no-padding">
										<div class="responsive-table">
											<form>
												<table class="table" style="margin-bottom: 0;">
													<thead>
												    <tr>
												      <th colspan='<?php echo $jml_kriteria ?>'><center>Keriteria</center></th>
												    </tr>
												    <tr>
												    <?php 
												      foreach ($kriteria as $k) {
												        echo "<th>{$k}</th>";
												      }
												    ?>
												    </tr>
												    <tr>
												    <?php  
												    for ($n=1; $n<=$jml_kriteria; $n++) { 
												      echo "<th>y<sub>{$n}</sub><sup>-</sup></th>";
												    }
												    ?>
												    </tr>
												  </thead>
												  <tbody>
												  <tr>
											  	<?php 
											    $ymin=array();
											    foreach ($kriteria as $k) {
											    	$ymin[$k]=($atribut[$k]=='cost'?max($y[$k]):min($y[$k]));
											    	echo "<th>{$ymin[$k]}</th>";
											    }
											    ?>
												  </tr>
												  </tbody>
												</table>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
            <hr class="hr-normal"/>
					</div>
				</div>



				<div class="row-fluid">
					<div class="span12 box">
						<div class="box-content">
							<div class="row-fluid">
								<div class='span12 box bordered-box orange-border' style='margin-bottom: 0;'>
								<h2>Jarak positif (D <sub>i</sub><sup>+</sup>)</h2>
									<div class="box-content box-no-padding">
										<div class="responsive-table">
											<form>
												<table class="table" style="margin-bottom: 0;">
													<thead>
												    <tr>
												      <th>No</th>
												      <th>Alternatif</th>
												      <th>Nama</th>
												      <th>D</th>
												    </tr>												    
												  </thead>
												  <tbody>
												  <?php 
												  $i=0;
												  $dplus=array();
												  foreach ($data as $nama => $krit) {
												  	echo "<tr>
												  	<td>".(++$i)."</td>
												  	<th>A{$i}</th>
												  	<td>{$nama}</td>";
												  	foreach ($kriteria as $k) {
												  		if (!isset($dplus[$i-1])) $dplus[$i-1]=0;
												  		$dplus[$i-1]+=pow($yplus[$k]-$y[$k][$i-1],2);
												  	}
												  	echo "<td>".round(sqrt($dplus[$i-1]),6)."</td>
												  	</tr>";
												  }
												  ?>
												  </tbody>
												</table>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
            <hr class="hr-normal"/>
					</div>
				</div>


				<div class="row-fluid">
					<div class="span12 box">
						<div class="box-content">
							<div class="row-fluid">
								<div class='span12 box bordered-box orange-border' style='margin-bottom: 0;'>
								<h2>Jarak positif (D <sub>i</sub><sup>-</sup>)</h2>
									<div class="box-content box-no-padding">
										<div class="responsive-table">
											<form>
												<table class="table" style="margin-bottom: 0;">
													<thead>
												    <tr>
												      <th>No</th>
												      <th>Alternatif</th>
												      <th>Nama</th>
												      <th>D</th>
												    </tr>												    
												  </thead>
												  <tbody>
												  <?php 
												  $i=0;
												  $dmin=array();
												  foreach ($data as $nama => $krit) {
												  	echo "<tr>
												  	<td>".(++$i)."</td>
												  	<th>A{$i}</th>
												  	<td>{$nama}</td>";
												  	foreach ($kriteria as $k) {
												  		if (!isset($dmin[$i-1])) $dmin[$i-1]=0;
												  		$dmin[$i-1]+=pow($ymin[$k]-$y[$k][$i-1],2);
												  	}
												  	echo "<td>".round(sqrt($dmin[$i-1]),6)."</td>
												  	</tr>";
												  }
												  ?>
												  </tbody>
												</table>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
            <hr class="hr-normal"/>
					</div>
				</div>


				<div class="row-fluid">
					<div class="span12 box">
						<div class="box-content">
							<div class="row-fluid">
								<div class='span12 box bordered-box orange-border' style='margin-bottom: 0;'>
								<h2>Nilai Preferensi (V <sub>i</sub>)</h2>
									<div class="box-content box-no-padding">
										<div class="responsive-table">
											<form>
												<table class="table" style="margin-bottom: 0;">
													<thead>
												    <tr>
												      <th>No</th>
												      <th>Alternatif</th>
												      <th>Nama</th>
												      <th>V</th>
												    </tr>												    
												  </thead>
												  <tbody>
												  <?php 
												  $i=0;
												  $V=array();
												  foreach ($data as $nama => $krit) {
												  	echo "<tr>
												  	<td>".(++$i)."</td>
												  	<th>A{$i}</th>
												  	<td>{$nama}</td>";
												  	foreach ($kriteria as $k) {
												  		$V[$i-1]=$dmin[$i-1]/($dmin[$i-1]+$dplus[$i-1]);
												  	}
												  	echo "<td>{$V[$i-1]}</td></tr>";
												  }
												  ?>
												  </tbody>
												</table>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
            <hr class="hr-normal"/>
					</div>
				</div>



			</div>
		</div>
	</section>

	<?php include_once 'footer.php'; ?>
