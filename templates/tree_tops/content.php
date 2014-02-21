<?php 
if ($_GET['module']=='home'){
   include "$f[folder]/content/home.php";      
}else if ($_GET['module']=='lihat-tagihan'){
   include "$f[folder]/content/lihat-tagihan.php";      
}else if ($_GET['module']=='cari-tagihan'){
   include "$f[folder]/content/cari-tagihan.php";      
}else if ($_GET['module']=='lihat-mutasi'){
   include "$f[folder]/content/lihat-mutasi.php";      
}else if ($_GET['module']=='cari-nis'){
   include "$f[folder]/content/cari-nis.php";      
}else if ($_GET['module']=='contact-us'){
   include "$f[folder]/content/contact-us.php";      
}else if ($_GET['module']=='login'){
   include "$f[folder]/cek_login.php";      
}else if ($_GET['module']=='logout'){
   include "$f[folder]/cek_logout.php";      
}else if ($_GET['module']=='cari-nis-ok'){
   include "$f[folder]/process/cari-nis-ok.php";      
}else if ($_GET['module']=='lihat-tagihan-ok'){
   include "$f[folder]/process/lihat-tagihan-ok.php";      
}else if ($_GET['module']=='cari-tagihan-ok'){
   include "$f[folder]/process/cari-tagihan-ok.php";      
}else if ($_GET['module']=='lihat-mutasi-ok'){
   include "$f[folder]/process/lihat-mutasi-ok.php";      
}
?>