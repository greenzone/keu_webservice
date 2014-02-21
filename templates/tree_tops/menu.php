<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
if ($_GET['module']=='home'){
?>
		  <li class="tab_selected"><a href="home">Home</a></li>
		  <li><a href="cari-nis">Cari NIS</a></li>
		  <li><a href="contact-us">Contact Us</a></li>
<?
}else if ($_GET['module']=='cari-nis' || $_GET['module']=='cari-nis-ok'){
?>
		  <li><a href="home">Home</a></li>
		  <li class="tab_selected"><a href="cari-nis">Cari NIS</a></li>
		  <li><a href="contact-us">Contact Us</a></li>
<?
}else if ($_GET['module']=='contact-us'){
?>
		  <li><a href="home">Home</a></li>
		  <li><a href="cari-nis">Cari NIS</a></li>
		  <li class="tab_selected"><a href="contact-us">Contact Us</a></li>
<?
}
}else{
if ($_GET['module']=='home'){
?>
		  <li class="tab_selected"><a href="home">Home</a></li>
		  <li><a href="lihat-tagihan">Lihat Tagihan</a></li>
		  <li><a href="cari-tagihan">Cari Tagihan</a></li>
		  <li><a href="lihat-mutasi">Lihat Mutasi</a></li>
		  <li><a href="cari-nis">Cari NIS</a></li>
		  <li><a href="contact-us">Contact Us</a></li>
		  <li><a href="logout">Logout</a></li>	  
<?
}else if ($_GET['module']=='lihat-tagihan' || $_GET['module']=='lihat-tagihan-ok'){
?>
		  <li><a href="home">Home</a></li>
		  <li class="tab_selected"><a href="lihat-tagihan">Lihat Tagihan</a></li>
		  <li><a href="cari-tagihan">Cari Tagihan</a></li>
		  <li><a href="lihat-mutasi">Lihat Mutasi</a></li>
		  <li><a href="cari-nis">Cari NIS</a></li>
		  <li><a href="contact-us">Contact Us</a></li>
		  <li><a href="logout">Logout</a></li>	  
<?
}else if ($_GET['module']=='cari-tagihan' || $_GET['module']=='cari-tagihan-ok'){
?>
		  <li><a href="home">Home</a></li>
		  <li><a href="lihat-tagihan">Lihat Tagihan</a></li>
		  <li class="tab_selected"><a href="cari-tagihan">Cari Tagihan</a></li>
		  <li><a href="lihat-mutasi">Lihat Mutasi</a></li>
		  <li><a href="cari-nis">Cari NIS</a></li>
		  <li><a href="contact-us">Contact Us</a></li>
		  <li><a href="logout">Logout</a></li>	  
<?
}else if ($_GET['module']=='lihat-mutasi' || $_GET['module']=='lihat-mutasi-ok'){
?>
		  <li><a href="home">Home</a></li>
		  <li><a href="lihat-tagihan">Lihat Tagihan</a></li>
		  <li><a href="cari-tagihan">Cari Tagihan</a></li>
		  <li class="tab_selected"><a href="lihat-mutasi">Lihat Mutasi</a></li>
		  <li><a href="cari-nis">Cari NIS</a></li>
		  <li><a href="contact-us">Contact Us</a></li>
		  <li><a href="logout">Logout</a></li>	  
<?
}else if ($_GET['module']=='cari-nis' || $_GET['module']=='cari-nis-ok'){
?>
		  <li><a href="home">Home</a></li>
		  <li><a href="lihat-tagihan">Lihat Tagihan</a></li>
		  <li><a href="cari-tagihan">Cari Tagihan</a></li>
		  <li><a href="lihat-mutasi">Lihat Mutasi</a></li>
		  <li class="tab_selected"><a href="cari-nis">Cari NIS</a></li>
		  <li><a href="contact-us">Contact Us</a></li>
		  <li><a href="logout">Logout</a></li>	  
<?
}else if ($_GET['module']=='contact-us'){
?>
		  <li><a href="home">Home</a></li>
		  <li><a href="lihat-tagihan">Lihat Tagihan</a></li>
		  <li><a href="cari-tagihan">Cari Tagihan</a></li>
		  <li><a href="lihat-mutasi">Lihat Mutasi</a></li>
		  <li><a href="cari-nis">Cari NIS</a></li>
		  <li class="tab_selected"><a href="contact-us">Contact Us</a></li>
		  <li><a href="logout">Logout</a></li>	  
<?
}else if ($_GET['module']=='logout'){
?>
		  <li><a href="home">Home</a></li>
		  <li><a href="lihat-tagihan">Lihat Tagihan</a></li>
		  <li><a href="cari-tagihan">Cari Tagihan</a></li>
		  <li><a href="lihat-mutasi">Lihat Mutasi</a></li>
		  <li><a href="cari-nis">Cari NIS</a></li>
		  <li><a href="contact-us">Contact Us</a></li>
		  <li class="tab_selected"><a href="logout">Logout</a></li>	  
<?
}
}
?>