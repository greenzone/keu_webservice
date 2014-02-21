<?php
include "date.php";   

if ($lama > "336"){
	echo "<script> alert('Maaf, Waktu Akses Sie Keuangan On-Line Al-Azhar BSD telah Habis!'); </script>";
}
else{
  header('location:home'); 
}
?>