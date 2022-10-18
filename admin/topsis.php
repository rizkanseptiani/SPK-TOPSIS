<?php
    $dbhost='localhost';
    $dbuser='root';
    $dbpass='';
    $dbname='spktopsis';
    $db=new mysqli($dbhost,$dbuser,$dbpass,$dbname);

    // $sql="
    // SELECT
    // b.name,c.criteria,a.value,c.weight,c.attribute
    // FROM
    // topsis_evaluations a
    // JOIN
    // topsis_alternatives b USING(id_alternative)
    // JOIN
    // topsis_criterias c USING(id_criteria)
    // ";

    $sql = "SELECT  
    a.nama_guru as name, b.nama_kriteria as criteria, c.nilai as value,b.bobot_kriteria as weight, b.atribut as attribute  
    FROM
    tbl_guru a, tbl_kriteria b, tbl_himpunan c,  tbl_klasifikasi d 
    where  
    a.id_guru=d.id_guru and c.id_himpunan=d.id_himpunan and b.id_kriteria=c.id_kriteria";

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

<table border="1" cellpadding="1" cellspacing="1">
  <thead>
    <tr>
      <th rowspan="4">No</th> 
      <th rowspan="3">Alternatif</th>
      <th rowspan="3">nama</th>
      <th colspan='<?php echo $jml_kriteria ?>'>Keriteria (<?php print $jml_kriteria ?>)</th>
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
    }
    ?>
  </tbody>
</table>

<header>
  <h2>Rating Kinerja Ternormalisasi (r<sub>ij</sub>)</h2>
</header>
<table border="1" cellspacing="0" cellpadding="1">
  <thead>
    <tr>
      <th rowspan="3">No</th>
      <th rowspan="3">Alternatif</th>
      <th rowspan="3">Nama</th>
      <th colspan="<?php print $jml_kriteria; ?>"><center>Kriteria</center></th>
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
  <thead>
  <?php 
  $i=0;
  foreach ($data as $nama => $krit) {
    echo "<tr>
    <td>".(++$i)."</td>
    <th>A{$i}</th>
    <td>{$nama}</td>";
    foreach ($kriteria as $k) {
      echo "<td align='center'>".round(($krit[$k])/sqrt($nilai_kuadrat[$k]),4)."</td>";
    }
    echo "</tr>";
  }
  ?>
  </thead>
</table>

<header><h2>Rating Bobot Ternormalisasi(y<sub>ij</sub>)</h2></header>
<table border="1" cellpadding="0" cellspacing="0">
  <thead>    
    <tr>
      <th rowspan="3">No</th>
      <th rowspan="3">Alternatif</th>
      <th rowspan="3">Nama</th>
      <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
    </tr>
    <tr>
    <?php 
    foreach ($kriteria as $k) {
      echo "<th>{$k}</td>\n";
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
  $y=array();
  foreach ($data as $nama => $krit) {
    echo "<tr>
    <td>".(++$i)."</td>
    <th>A{$i}</th>
    <td>{$nama}</td>";
    foreach ($kriteria as $k) {
      $y[$k][$i-1]=round(($krit[$k]/sqrt($nilai_kuadrat[$k])),4)*$bobot[$k];
      echo "<td align='center'>".$y[$k][$i-1]."</td>";
    }
    echo "</tr>";
  }
  ?>
  </tbody>
</table>

<header><h2>Solusi Ideal positif (A<sup>+</sup>)</h2></header>
<table border="1" cellspacing="0" cellpadding="2">
  <thead>
    <tr>
      <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
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


<header><h2>Solusi Ideal negatif (A<sup>-</sup>)</h2></header>
<table border="1" cellspacing="0" cellpadding="2">
  <thead>
    <tr>
      <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
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



<header><h2>Jarak positif (D<sub>i</sub><sup>+</sup>)</h2></header>
<table border="1" cellpadding="1" cellspacing="0">
  <thead>
    <tr>
      <th>No</th>
      <th>Alternatif</th>
      <th>Nama</th>
      <th>D<sup>+</sup></th>
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


<header><h2>Jarak positif (D<sub>i</sub><sup>-</sup>)</h2></header>
<table border="1" cellpadding="1" cellspacing="0">
  <thead>
    <tr>
      <th>No</th>
      <th>Alternatif</th>
      <th>Nama</th>
      <th>D<sup>+</sup></th>
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

<header>
  <h2>Nilai Preferensi(V<sub>i</sub>)</h2>                                  
</header>

<table border="1" cellpadding="1" cellspacing="0">
  <thead>
    <tr>
      <th>No</th>
      <th>Alternatif</th>
      <th>Nama</th>
      <th>V<sub>i</sub></th>
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