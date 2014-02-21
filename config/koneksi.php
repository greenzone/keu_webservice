<?php
$server = "localhost";
$username = "alazh926_keu3";
$password = "alazh926_keu3";
$database = "alazh926_keu3";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
