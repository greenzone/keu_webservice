<?php 
error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
  <title><?php include "dina_titel.php"; ?></title>
  <meta name="keywords" content="<?php include "dina_meta2.php"; ?>" />
  <meta name="description" content="<?php include "dina_meta1.php"; ?>" />
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />

  <script type="text/javascript" src="<?php echo "$f[folder]/lib/jquery-1.4.3.min.js" ?>"></script>
  <script type="text/javascript" src="<?php echo "$f[folder]/lib/jquery-1.4.js" ?>"></script>
  <script type="text/javascript" src="<?php echo "$f[folder]/lib/jquery.tools.js" ?>"></script>
  <script type="text/javascript" src="<?php echo "$f[folder]/lib/jquery.custom.js" ?>"></script>

  <link rel="stylesheet" type="text/css" href="<?php echo "$f[folder]/style/style.css" ?>" />
</head>

<body OnLoad="document.login.username.focus();">
  <div id="main">
    <div id="links"></div>
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <h1>SIstem Keuangan online<span class="alternate_colour">_(SIK)</span><br></h1>
          <h2><span class="alternate_colour">Yayasan Muslim Bumi Serpong Damai</span></h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="tab_selected" in the li tag for the selected page - to highlight which page you're on -->
<?php
include "$f[folder]/menu.php";      
?>  
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div id="panel"><img src="<?php echo "$f[folder]/style/panel1.jpg" ?>" alt="tree tops" /></div>

    <div class="sidebar">
<?php
include "$f[folder]/sidebar.php";      
?>  
    </div>

    <div id="content">
<?php
include "$f[folder]/content.php";      
?>          
    </div>

    <div id="site_content_bottom"></div>
    </div>
    <div id="footer">Copyright &copy; 2011. Yayasan Muslim Bumi Serpong Damai. All Rights Reserved. | <a href="http://www.alazhar-bsd.sch.id">Website</a> | <a href="http://www.facebook.com/alazharbsd">Facebook</a> | <a href="http://www.dcarter.co.uk">design by dcarter</a></div>
  </div>
<div style="text-align: center; font-size: 0.75em;">Design downloaded from <a href="http://www.freewebtemplates.com/">free website templates</a>.</div></body>

<script type="text/javascript">
$(document).ready(function(){
  //menampilkan kelas dari database unit
  $("#unit").change(function(){
    //ambil nilai dari unit
    unit = $("#unit").val();
    tabel = "siswa_"+unit;
    switch (unit){
      case "":
        $("#paralel").load("<?php echo "$f[folder]/process/lihat-tagihan-ok.php" ?>","op=kosongkanParalel");
        $("#kelas").load("<?php echo "$f[folder]/process/lihat-tagihan-ok.php" ?>","op=kosongkanKelas");        
        exit();
      break;
      default:
        $("#paralel").load("<?php echo "$f[folder]/process/lihat-tagihan-ok.php" ?>","op=kosongkanParalel");
        $("#kelas").load("<?php echo "$f[folder]/process/lihat-tagihan-ok.php" ?>","op=viewKelas&unit="+unit+"&tabel="+tabel);
        exit();
    }
  });		
  //menampilkan paralel dari database kelas
  $("#kelas").change(function(){
    //ambil nilai dari kelas
    unit = $("#unit").val();
    kelas = $("#kelas").val();
    tabel = "siswa_"+unit;
    switch (kelas){
      case "":
        $("#paralel").load("<?php echo "$f[folder]/process/lihat-tagihan-ok.php" ?>","op=kosongkanParalel");
        exit();
      break;
      default:
        $("#paralel").load("<?php echo "$f[folder]/process/lihat-tagihan-ok.php" ?>","op=viewParalel&unit="+unit+"&tabel="+tabel+"&kelas="+kelas);
        exit();
    }
  });		
});
</script>
</html>