<?php
include "../../config/koneksi.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = anti_injection($_POST['username']);
$pass     = anti_injection(md5($_POST['password']));

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($pass)){
?>
<div class="row">
<div class="row_bot">

<h1 align="center">LOGIN GAGAL</h1>
<div style="height: 5px;"></div>
<center>
Maaf, anda salah memasukkan username atau password.<br>
<a href='home'><b>ULANGI LAGI</b></a>
</center>

<div style="clear: both"></div>
</div>
</div>
<div style="height:15px"></div>  
<?
}
else{
$login=mysql_query("SELECT * FROM users WHERE username='$username' AND password='$pass' AND blokir='N'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();

  $_SESSION[namauser]     = $r[username];
  $_SESSION[namalengkap]  = $r[nama_lengkap];
  $_SESSION[passuser]     = $r[password];
  $_SESSION[leveluser]    = $r[level];

	$sid_lama = session_id();
	
	session_regenerate_id();

	$sid_baru = session_id();

  mysql_query("UPDATE users SET id_session='$sid_baru' WHERE username='$username'");
  header('location:home');
}
else{
?>
<div class="row">
<div class="row_bot">

<h1 align="center">LOGIN GAGAL</h1>
<div style="height: 5px;"></div>
<center>
Username atau Password Anda tidak benar.<br>
Atau account Anda sedang diblokir.<br>
<a href='home'><b>ULANGI LAGI</b></a>
</center>

<div style="clear: both"></div>
</div>
</div>
<div style="height:15px"></div>  
<?
}
}
?>
