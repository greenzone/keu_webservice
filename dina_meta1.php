<?php
if (isset($_GET['id'])){
    $sql = mysql_query("select judul from berita where id_berita='$_GET[id]'");
    $j   = mysql_fetch_array($sql);
		echo "$j[judul]";
}
else{
		echo "Al-Azhar BSD adalah Perguruan Islam Yayasan Muslim yang terdiri dari TK, SD, SMP dan SMA.";
}
?>
