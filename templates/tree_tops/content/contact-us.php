<!-- insert the page content here -->
<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
?>
<h1>Contact Us<br> Al-Azhar Bumi Serpong Damai</h1>
<p>Hubungi kami di:<br>
Bagian Keuangan Al-Azhar Bumi Serpong Damai (BSD)<br>
Yayasan Muslim Bumi Serpong Damai<br>
Telp: (021) 537-5647 </p>


<?
}else{
?>
<!-- insert the page content admin here -->
<h1>Contact Us<br> Al-Azhar Bumi Serpong Damai</h1>
<p>Hubungi kami di:<br>
Bagian Keuangan Al-Azhar Bumi Serpong Damai (BSD)<br>
Yayasan Muslim Bumi Serpong Damai<br>
Telp: (021) 537-5647 </p>



<?
}
?>