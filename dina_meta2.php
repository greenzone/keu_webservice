<?php
if (isset($_GET['id'])){
  $sql = mysql_query("select tag from berita where id_berita='$_GET[id]'");
  $j   = mysql_fetch_array($sql);
	echo "$j[tag]";
}
else{
		echo "Sistem Keuangan Online Al-Azhar, Yayasan Muslim, Lakhar, TK, SD, SMP, SMA, BSD, Perguruan Islam.";
}
?>
