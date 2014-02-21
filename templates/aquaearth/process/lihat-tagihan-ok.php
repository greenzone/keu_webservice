<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
?>
<!-- bagian kanan -->		   	  
<div class="row">
<div class="row_bot">

<span class="a_h1">Maaf, Terjadi Kesalahan!<br> Anda belum Login!</span>
      <div style="height:8px"></div>
      <div style=" clear:both; height:5px;"></div>
<b>
<p>Maaf anda tidak berhak mengakses halaman ini. Silahkan kembali ke menu <b><a href="home">Home</a></b> dan login terlebih dahulu.</p>
</b>
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
}else{
include "../../../config/koneksi.php";

$op = $_GET['op'];

$tahun = $_POST['tahun'];
$unit  = $_POST['unit'];
$jenis_tagihan = $_POST['jenis_tagihan'];
$bulan = $_POST['bulan'];
$kelas = $_POST['kelas'];
$paralel = $_POST['paralel'];

if ($op=='kosongkanKelas'){
echo "<option>Pilih Unit Dulu</option>\n";
}else if ($op=='kosongkanParalel'){
echo "<option>Pilih Kelas Dulu</option>\n";
}else if ($op=='viewKelas'){
$unit = $_GET['unit'];
$tabel = strtolower($_GET['tabel']);
$option = mysql_query("SELECT DISTINCT kelas FROM $tabel WHERE unit='$unit' ORDER BY id ASC");
echo "<option value=''>Pilih Kelas</option>\n";
while($op = mysql_fetch_array($option)){
  echo "<option>".$op['kelas']."</option>\n";
  }
}else if ($op=='viewParalel'){
$unit = $_GET['unit'];
$kelas = $_GET['kelas'];
$tabel = strtolower($_GET['tabel']);
$option = mysql_query("SELECT DISTINCT paralel FROM $tabel WHERE unit='$unit' AND kelas='$kelas' ORDER BY id ASC");
echo "<option value=''>Pilih Paralel</option>\n";
while($op = mysql_fetch_array($option)){
  echo "<option>".$op['paralel']."</option>\n";
  }
}

$tabel="tagihan_".strtolower($unit);
$lihat_tagihan=mysql_query("SELECT * FROM $tabel WHERE tahun='$tahun' AND unit='$unit' AND pembayaran='$jenis_tagihan' AND bulan='$bulan' AND kelas='$kelas' AND paralel='$paralel'");
$banyak=mysql_num_rows($lihat_tagihan);
?>
<!-- bagian kanan -->		   	  
<div class="row">
<div class="row_bot">

<span class="a_h1">HASIL PENCARIAN</span>
      <div style="height:8px"></div>
      <div style=" clear:both; height:5px;"></div>
<form name="export-excel"  method="post"  action="export-excel.php?op=lihat-tagihan">
<b>
<p>Ditemukan <? echo $banyak; ?> Tagihan Siswa <br>
Tahun <? echo $tahun; ?>;<br> <input name="tahun" value="<? echo $tahun; ?>" type="hidden">
Unit <? echo $unit; ?>;<br> <input name="unit" value="<? echo $unit; ?>" type="hidden">
Jenis Tagihan <? echo $jenis_tagihan; ?>;<br> <input name="jenis_tagihan" value="<? echo $jenis_tagihan; ?>" type="hidden">
Bulan <? echo $bulan; ?>;<br> <input name="bulan" value="<? echo $bulan; ?>" type="hidden">
Kelas <? echo $kelas; ?> <? echo $paralel; ?>.<input name="kelas" value="<? echo $kelas; ?>" type="hidden"> <input name="paralel" value="<? echo $paralel; ?>" type="hidden"></p> 
</b>
<div class="form_settings">
<table border="0">
<tr><th align='center'><b>No</b></th><th align='center'>NIS</th><th>NAMA SISWA</th><th>KELAS</th><th align='center'>TAGIHAN</th><th align='center'>KETERANGAN</th><th align='center'>REFNO</th><th align='center'>TGL BAYAR</th></tr>
<?
$no = 1;
while($r = mysql_fetch_array($lihat_tagihan)){

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
?>