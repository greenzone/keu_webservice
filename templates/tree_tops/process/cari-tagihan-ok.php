<?php
$tahun = $_POST['tahun'];
$unit  = $_POST['unit'];
$jenis_tagihan  = $_POST['jenis_tagihan'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];

// pastikan nama atau kelas tidak kosong.
if (empty($tahun) || empty($unit) || empty($jenis_tagihan) || (empty($nama) && empty($kelas))){
?>
<h1>MAAF TERJADI KESALAHAN DALAM INPUT</h1>
<p>Silahkan pilih Tahun Ajaran, Unit Siswa, Jenis Tagihan dan masukkan Nama atau Kelas yang benar.<br>
<a href='cari-tagihan'><b>ULANGI LAGI</b></a>
</p>
<?
}
else{
include "../../../config/koneksi.php";

$tabel="tagihan_".strtolower($unit);
$cari_tagihan=mysql_query("SELECT * FROM $tabel WHERE tahun='$tahun' AND pembayaran='$jenis_tagihan' AND nama LIKE '%$nama%' AND kelas LIKE '%$kelas%'");
	if (!($cari_tagihan)){
		$banyak="0";
	}else{
		$banyak=mysql_num_rows($cari_tagihan);
	}
?>
<h1>HASIL PENCARIAN</h1>
<form name="export-excel"  method="post"  action="export-excel.php?op=cari-tagihan">
<p>Ditemukan <? echo $banyak; ?> Tagihan Siswa<br>
Tahun <? echo $tahun; ?>;<br> <input name="tahun" value="<? echo $tahun; ?>" type="hidden">
Unit <? echo $unit; ?>;<br> <input name="unit" value="<? echo $unit; ?>" type="hidden">
Jenis Tagihan <? echo $jenis_tagihan; ?>;<input name="jenis_tagihan" value="<? echo $jenis_tagihan; ?>" type="hidden"> <input name="nama" value="<? echo $nama; ?>" type="hidden"> <input name="kelas" value="<? echo $kelas; ?>" type="hidden">.</p>
<div class="form_settings">
<table border="0">
<tr><th align='center'><b>No</b></th><th align='center'>NIS</th><th>NAMA SISWA</th><th>KELAS</th><th align='center'>TAGIHAN</th><th align='center'>KETERANGAN</th><th align='center'>REFNO</th><th align='center'>TGL BAYAR</th></tr>
<?
$no = 1;
while($r = mysql_fetch_array($cari_tagihan)){

$vacc = $r['vacc'];
$nis1 = substr($vacc,7,9);
if (substr($nis1,0,1)=="0"){
  $nis = substr($nis1,1,8);
}else{
  $nis = $nis1;
};

if ($r['bayar']=="Y"){
  $ket="TERBAYAR";
}else{
  $ket="BELUM";
}

$uang=rp($r['tagihan']);
echo "<tr><td align='center'>$no</td>
		  <td align='center'>$nis</td>
		  <td>$r[nama]</td>
		  <td align='center'>$r[kelas] $r[paralel]</td>
		  <td align='center'>$uang</td>
		  <td align='center'>$ket</td>
		  <td align='center'>$r[refno] $r[rek]</td>
		  <td align='center'>$r[trxdate]</td>          
	  </tr>";
$no++;
}
?>
</table>
<input class="submit1" type="submit" name="export" value="export_EXCEL">
</div>
</form>
<br>
<br>
<?
}
?>