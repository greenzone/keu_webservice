<!-- insert your sidebar items here -->
<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
?>
<!-- bagian kiri -->		   	  
<div id="left">
<h1 class="h1_left">Login User</h1>
<ul class="spis">
<form name="login" action="login" method="POST" onSubmit="return validasi(this)">
Username&nbsp;&nbsp;: <input type="text" name="username" id="username">
Password&nbsp;&nbsp;&nbsp;: <input type="password" name="password" id="password"><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input class="submit2" type="submit" value="Login">
</form>
</ul>
<div style="height:5px"></div>
<h1 class="h1_left">Partner</h1>
<img src="foto_banner/muammalat.jpg" class="img_h1"  alt="" align="middle" /><br />
<img src="foto_banner/bri-syariah.jpg" class="img_h1"  alt="" align="middle" />
<div style="height:300px"></div>
</div>
<?
}else{
?>

<?
}
?>