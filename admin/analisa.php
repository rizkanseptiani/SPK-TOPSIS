<?php include_once 'head.php'; ?>

<body class="contrast-red">
  <?php include_once 'navbar.php'; ?>

  <div id="wrapper">

    <div id="main-nav-bg"></div>
    <nav class="" id="main-nav">
      <div class="navigation">
        <?php include_once 'sidebar.php'; ?>
      </div>
    </nav>

    <section id="content">
      <div class="container-fluid">
        <div class="row-fluid" id="content-wrapper">
          <div class="span12">
            <?php include_once 'header.php'; ?>

<?php 
if (!empty($_POST['btnSubmit'])) {
  unset($_SESSION['ANALISA_KRITERIA']);
  $q=mysqli_query($konek,"SELECT * FROM tbl_kriteria");
  while ($h=mysqli_fetch_array($q)) {
    $_SESSION['ANALISA_KRITERIA'][$h['id_kriteria']]=$_POST['bobot_'.$h['id_kriteria']];
  }
  exit("<script>location.href='analisa_hasil.php';</script>");
}

# menampilkan bobot
$b = mysqli_query($konek,"SELECT * FROM tbl_bobot");
while ($bobot1 = mysqli_fetch_array($b)) {
  $bobot[] = $bobot1['nilai'];
  $nmBobot[] = $bobot1['nama_bobot'];
}

# menampilkan kriteria beserta data himpunannya
$q = mysqli_query($konek,"SELECT * FROM tbl_kriteria");
while ($h=mysqli_fetch_array($q)) {
// echo $_SESSION['ANALISA_KRITERIA'][$h['id_kriteria']];
// echo "<br>";
// echo $h['id_kriteria'] .$_SESSION['ANALISA_KRITERIA'][$h['id_kriteria']];
$bobot_kriteria = $_SESSION['ANALISA_KRITERIA'][$h['id_kriteria']];
if ($_POST['btnSubmit']) {
$up = "UPDATE `tbl_kriteria` SET `bobot_kriteria`=$bobot_kriteria WHERE id_kriteria=$h[id_kriteria]";
  mysqli_query($konek,$up);
}
  # menampilkan bobot
  $no++;
  $listBobot='';
  for ($i=0; $i<count($bobot); $i++) { 
    if ($bobot[$i]==$_SESSION['ANALISA_KRITERIA'][$h['id_kriteria']]) 
    {
      $s=' selected';
    }else{
      $s='';
    }
    $listBobot.='<option value="'.$bobot[$i].'"'.$s.'>'.$nmBobot[$i].'</option>';
  }
  $daftarKriteria.='
  <tr>
  <td width="160"><strong>C'.$no.'.</strong>&nbsp;&nbsp; '.$h[''].'</td>
  <td><select name="bobot_'.$h['id_kriteria'].'" style="width:150px">'.$listBobot.'</select></td>
  </tr>
  ';
}
?>

            <div class="row-fluid">
              <div class="span12 box">
                <div class="box-content">
                  <div class="row-fluid">
                    <div class="span12 box bordered-box orange-border" style="margin-bottom: 0;">
                      <h3>Analisa</h3>
                      <div class="box-content box-no-padding">
                        <div class="responsive-table">
                          <form action="analisa.php" method="post">
                            <table class="table" style="margin-bottom: 0;">
                              <?php echo $daftarKriteria; ?>
                                                          
                            </table>
                            <input type="submit" name="btnSubmit" class="btn btn-danger" value="Submit Analisa">
                          </form>
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
        </div>
      </div>
    </section>

  </div>

<?php include_once 'footer.php'; ?>