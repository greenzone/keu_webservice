<?php
$tahun = $_POST['tahun'];
$unit  = $_POST['unit'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];

// pastikan nama atau kelas tidak kosong.
if (empty($tahun) || empty($unit) || (empty($nama) && empty($kelas))){
?>
<h1>MAAF TERJADI KESALAHAN DALAM INPUT</h1>
<p>Silahkan pilih Tahun Ajaran, Unit Siswa dan masukkan Nama atau Kelas yang benar.<br>
<a href='cari-nis'><b>ULANGI LAGI</b></a>
</p>
<?
}
else{
include "../../../config/koneksi.php";

$tabel="siswa_".strtolower($unit);
$cari_nis=mysql_query("SELECT * FROM $tabel WHERE tahun='$tahun' AND nama LIKE '%$nama%' AND kelas LIKE '%$kelas%'");
	if (!($cari_nis)){
		$banyak="0";
	}else{
		$banyak=mysql_num_rows($cari_nis);
	}
?>
<h1>HASIL PENCARIAN</h1>
<p>Ditemukan <? echo $banyak; ?> Siswa<br></p>
<div class="form_settings">
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
</div>

<?
}
?>