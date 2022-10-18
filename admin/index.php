<?php
include "head.php";
?>
<body class='contrast-red '>

<?php include_once 'navbar.php'; ?>

<div id='wrapper'>
  <div id='main-nav-bg'></div>
  <nav class='' id='main-nav'>
    <div class='navigation'>
    <?php
    include "sidebar.php";
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
        <labeltxt><p style='text-align:right'>Selamat datang <b><?php echo $_SESSION['nama'];?></b> di halaman Admin.<br></p></labeltxt>
      <h3>Latar Belakang</h3>
      <p style='text-align:justify; text-indent:20px'>Badan Pusat Statistik adalah Lembaga Pemerintah Non-Kementrian yang bertanggung jawab langsung kepada Presiden. Kantor BPS Provinsi Jawa Timur secara rutin memberikan penghargaan kepada pegawai teladan setiap tahunnya. Penghargaan diberikan berdasarkan proses pemilihan karyawan terbaik yang dilaksanakan oleh Bidang HRD (Human Resource Development). Pegawai teladan dipilih dan diputuskan berdasarkan kriteria dan sub kriteria yang memiliki nilai intensitas kepentingannya masing-masing yang sudah ditetapkan oleh perusahaan. Pegawai merupakan suatu bagian paling penting dalam kemajuan perusahaan. Perkembangan perusahaan sangat ditentukan oleh kualitas pegawai yang bekerja pada perusahaan tersebut.</p>
      <p style='text-align:justify; text-indent:20px'>SPK dapat digunakan sebagai alat dalam membantu Kantor BPS Provinsi Jawa Timur untuk menentukan pilihan pegawai teladan yang berhak mendapat penghargaan. SPK dibangun dan dilakukan dengan memperhitungkan kriteria dan alternatif yang ada salah satunya dengan menerapkan metode perhitungan TOPSIS. Secara umum terdapat tiga alasan utama terkait TOPSIS yang banyak digunakan dalam pembuatan SPK. Pertama, konsep yang sederhana serta cukup mudah dipahami. Kedua, komputasi yang efisien. Ketiga, mempunyai kemampuan dalam mengukur kinerja relatif dari banyak alternatif keputusan dalam bentuk matematis yang sederhana dan tidak rumit.</p>
        <div class='clearfix'></div>
        
      </div>
    </div>
  </div>

</div>
</div>
</div>
</section>
</div>
<?php
include "footer.php";
?>