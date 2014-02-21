<!-- insert the page content here -->
<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
?>
<!-- bagian kanan -->		   	  
<div id="right">
<div class=" right_box_top"></div>

<div class="text">
<img src="<?php echo "$f[folder]/images/img_h1.gif" ?>" class="img_h1"  alt="" />

<span class="a_h1">Contact Us<br> Al-Azhar Bumi Serpong Damai</span>
			<div style="height:8px"></div>
			<div style=" clear:both; height:5px;"></div>
<b>
<p>Hubungi kami di:<br>
Bagian Keuangan Al-Azhar Bumi Serpong Damai (BSD)<br>
Yayasan Muslim Bumi Serpong Damai<br>
Telp: (021) 537-5647 </p>
</b>
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			 <div style=" clear:both; height:1px;"></div>
		  </div>
		  <div class="right_box_bot"></div>
		  <div style="height: 15px;"></div>
</div>
<div style="clear: both"></div>
<?
}else{
?>
<!-- bagian kanan -->		   	  
<div class="row">
<div class="row_bot">

<span class="a_h1">Contact Us<br> Al-Azhar Bumi Serpong Damai</span>
			<div style="height:8px"></div>
			<div style=" clear:both; height:5px;"></div>
<b>
<p>Hubungi kami di:<br>
Bagian Keuangan Al-Azhar Bumi Serpong Damai (BSD)<br>
Yayasan Muslim Bumi Serpong Damai<br>
Telp: (021) 537-5647 </p>
</b>
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
<div style="clear: both"></div>
<br>
<br>
<br>
</div>
</div>
<div style="height:15px"></div>
<?
}
?>