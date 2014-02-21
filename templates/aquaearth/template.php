<?php 
error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php include "dina_titel.php"; ?></title>
<meta name="keywords" content="<?php include "dina_meta2.php"; ?>" />
<meta name="description" content="<?php include "dina_meta1.php"; ?>" />
<!-- Begin JavaScript -->
		<script type="text/javascript" src="<?php echo "$f[folder]/lib/jquery-1.4.3.min.js" ?>"></script>
		<script type="text/javascript" src="<?php echo "$f[folder]/lib/jquery-1.4.js" ?>"></script>
		<script type="text/javascript" src="<?php echo "$f[folder]/lib/jquery.tools.js" ?>"></script>
    	<script type="text/javascript" src="<?php echo "$f[folder]/lib/jquery.custom.js" ?>"></script>
<link href="<?php echo "$f[folder]/styles.css" ?>" rel="stylesheet" type="text/css" />
</head>
<body OnLoad="document.login.username.focus();">
<div id="bg">
<div id="main">
<!-- header begins -->
<div id="header">
	<div id="logo">
    	<b>Welcome...</b>
      	<h3><span id="metamorph">Bagian Keuangan YMBSD </span></h3>
    </div>
<?php
include "$f[folder]/menu.php";      
?>        
</div>
<!-- header ends -->
<div class="cont_top"></div>
<!-- content begins -->       
<div id="content">
<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
?>
<div class="top_img">
		<div class="scrollable">
				<div class="items">
					<div class="item">
						<div class="header1"></div>                                    
					</div> <!-- item -->
					<div class="item">
						<div class="header2"></div>						
					</div> <!-- item -->
					<div class="item">
						<div class="header3"></div>						
					</div> <!-- item -->
					<div class="item">
						<div class="header4"></div>						
					</div> <!-- item -->										
				</div> <!-- items -->
		</div> <!-- scrollable -->
		<div class="circl_all"><div class="navi"></div></div> 
<!-- create automatically the point dor the navigation depending on the numbers of items -->
</div>
<?
}
?>
<!-- bagian atas -->		   	  
<div style="clear: both"></div>
<div style="height: 15px"></div>
<?php
include "$f[folder]/sidebar.php";
include "$f[folder]/content.php";      
?>          
<!-- bottom begin -->    
    <div id="bottom">
<?php
include "$f[folder]/bottom.php";      
?>   
    </div>   
<!-- bottom end -->
</div>
<!-- content ends --> 
<div class="cont_bot"></div>

<!-- footer begins -->
<div id="footer">
Copyright &copy; 2011. Yayasan Muslim Bumi Serpong Damai. All Rights Reserved.<br />
<a href="http://www.alazhar-bsd.sch.id">Website</a> | Privacy Policy | Terms of Use | <abbr title="eXtensible HyperText Markup Language">XHTML</abbr> | <abbr title="Cascading Style Sheets">CSS</abbr>
</div>
<!-- footer ends -->

</div>
</div>
</body>

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
