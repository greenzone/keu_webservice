		<!-- insert your sidebar items here -->
<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
?>
		<h1>Login</h1>
		<form name="login" action="login" method="POST" onSubmit="return validasi(this)">
		<p>
		Username&nbsp;: <input type="text" name="username" id="username"><br>
		Password&nbsp;&nbsp;: <input type="password" name="password" id="password"><br>
		<input class="submit" type="submit" name="login" value="Login">
		</p>
		</form>
<?
}
?>
		<h1>Partner</h1>
		<p align="middle"><a href="http://www.muamalatbank.com/"><img src="foto_banner/muammalat.jpg" alt="BMI"></a></p>
		<p align="middle"><a href="http://www.brisyariah.co.id/"><img src="foto_banner/bri-syariah.jpg" alt="BRIS" align="middle"></a></p>

		<h1>Info Lain</h1>
		<p>You can put anything you like in the sidebar. Latest news, useful links, images, contact information. Anything you think the visitor will find useful.</p>
