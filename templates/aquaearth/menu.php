<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
?>
   <div id="buttons">
	  <a href="home" class="but" title="">Home</a><div class="but_razd"></div>
	  <a href="cari-nis" class="but" title="">Cari NIS</a><div class="but_razd"></div>
	  <a href="contact-us" class="but" title="">Contact Us</a><div class="but_razd"></div>
	</div>
<?
}else{
?>
   <div id="buttons">
	  <a href="home" class="but" title="">Home</a><div class="but_razd"></div>
	  <a href="lihat-tagihan" class="but" title="">Lihat Tagihan</a><div class="but_razd"></div>
	  <a href="cari-tagihan" class="but" title="">Cari Tagihan</a><div class="but_razd"></div>
	  <a href="lihat-mutasi" class="but" title="">Lihat Mutasi</a><div class="but_razd"></div>
	  <a href="cari-nis" class="but" title="">Cari NIS</a><div class="but_razd"></div>
	  <a href="contact-us" class="but" title="">Contact Us</a><div class="but_razd"></div>
	  <a href="logout" class="but" title="">Logout</a></li>	  
	</div>
<?
}
?>