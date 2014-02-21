<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
$tahun = $_POST['tahun'];
$unit  = $_POST['unit'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];

// pastikan nama atau kelas tidak kosong.
if (empty($tahun) || empty($unit) || (empty($nama) && empty($kelas))){
?>
<!-- bagian kanan -->		   	  
<div id="right">
<div class=" right_box_top"></div>

<div class="text">
<img src="<?php echo "$f[folder]/images/img_h1.gif" ?>" class="img_h1"  alt="" />

<span class="a_h1">MAAF TERJADI KESALAHAN DALAM INPUT</span>
            <div style="height:8px"></div>
            <div style=" clear:both; height:5px;"></div>
<b><p>Silahkan pilih Tahun Ajaran, Unit Siswa dan masukkan Nama atau Kelas yang benar.<br>
<a href='cari-nis'><b>ULANGI LAGI</b></a>
</p></b>

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
}
else{
include "../../../config/koneksi.php";

$tabel="siswa_".strtolower($unit);
$cari_nis=mysql_query("SELECT * FROM $tabel WHERE tahun='$tahun' AND nama LIKE '%$nama%' AND kelas LIKE '%$kelas%'");
$banyak=mysql_num_rows($cari_nis);
?>
<!-- bagian kanan -->		   	  
<div id="right">
<div class=" right_box_top"></div>

<div class="text">
<img src="<?php echo "$f[folder]/images/img_h1.gif" ?>" class="img_h1"  alt="" />

<span class="a_h1">HASIL PENCARIAN</span>
            <div style="height:8px"></div>
            <div style=" clear:both; height:5px;"></div>
<b><p>Ditemukan <? echo $banyak; ?> Siswa<br></p></b>
<table border="0">
<tr><th align='center'><b>No</b></th><th align='center'>TAHUN_PELAJARAN</th><th>NIS</th><th>NAMA_SISWA</th><th align='center'>KELAS</th><th align='center'>UNIT</th></tr>
<?
$no = 1;
while($r = mysql_fetch_array($cari_nis)){
echo "<tr><td align='center'>$no</td>
          <td align='center'>$r[tahun]</td>
          <td>$r[nis]</td>
          <td>$r[nama]</td>
          <td align='center'>$r[kelas] $r[paralel]</td>
          <td align='center'>$r[unit]</td>
      </tr>";
$no++;
}
?>

</table>
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
}
}else{

$tahun = $_POST['tahun'];
$unit  = $_POST['unit'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];

// pastikan nama atau kelas tidak kosong.
if (empty($tahun) || empty($unit) || (empty($nama) && empty($kelas))){
?>
<!-- bagian kanan -->		   	     	  
<div class="row">
<div class="row_bot">

<span class="a_h1">MAAF TERJADI KESALAHAN DALAM INPUT</span>
            <div style="height:8px"></div>
            <div style=" clear:both; height:5px;"></div>
<b><p>Silahkan pilih Tahun Ajaran, Unit Siswa dan masukkan Nama atau Kelas yang benar.<br>
<a href='cari-nis'><b>ULANGI LAGI</b></a>
</p></b>

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
else{
include "../../../config/koneksi.php";

$tabel="siswa_".strtolower($unit);
$cari_nis=mysql_query("SELECT * FROM $tabel WHERE tahun='$tahun' AND nama LIKE '%$nama%' AND kelas LIKE '%$kelas%'");
$banyak=mysql_num_rows($cari_nis);
?>
<!-- bagian kanan -->		   	  
<div class="row">
<div class="row_bot">

<span class="a_h1">HASIL PENCARIAN</span>
            <div style="height:8px"></div>
            <div style=" clear:both; height:5px;"></div>
<b><p>Ditemukan <? echo $banyak; ?> Siswa<br></p></b>
<table border="0">
<tr><th align='center'><b>No</b></th><th align='center'>TAHUN_PELAJARAN</th><th>NIS</th><th>NAMA_SISWA</th><th align='center'>KELAS</th><th align='center'>UNIT</th></tr>
<?
$no = 1;
while($r = mysql_fetch_array($cari_nis)){
echo "<tr><td align='center'>$no</td>
          <td align='center'>$r[tahun]</td>
          <td>$r[nis]</td>
          <td>$r[nama]</td>
          <td align='center'>$r[kelas] $r[paralel]</td>
          <td align='center'>$r[unit]</td>
      </tr>";
$no++;
}
?>

</table>
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
}
?>