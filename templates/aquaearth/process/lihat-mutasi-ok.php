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

$bank = $_POST['bank'];
$tahun1 = $_POST['tahun1'];
$bulan  = $_POST['bulan'];
$tanggal = $_POST['tanggal'];

$tampil_bulan=mysql_query("SELECT * FROM bulan WHERE bulan_id='$bulan'");
$a = mysql_fetch_array($tampil_bulan);
$bulan1=$a['bulan'];

  if (strlen($tanggal)=="1"){
    $tanggal1 = "0".$tanggal;
  }else{
    $tanggal1 = $tanggal;
  }

$tabel="mutasi_".strtolower($bank);
$trxdate=$tahun1.$bulan.$tanggal1;
$lihat_mutasi=mysql_query("SELECT * FROM $tabel WHERE trxdate='$trxdate'");
$banyak=mysql_num_rows($lihat_mutasi);
?>
<!-- bagian kanan -->		   	  
<div class="row">
<div class="row_bot">

<span class="a_h1">HASIL PENCARIAN</span>
      <div style="height:8px"></div>
      <div style=" clear:both; height:5px;"></div>
<form name="export-excel"  method="post"  action="export-excel.php?op=lihat-mutasi">
<b><p>Ditemukan <? echo $banyak; ?> Transaksi Mutasi <br>
Rekening <? echo $bank; ?>;<input name="bank" value="<? echo $bank; ?>" type="hidden"><br>
Tahun <? echo $tahun1; ?>;<input name="tahun1" value="<? echo $tahun1; ?>" type="hidden"><br>
Bulan <? echo $bulan1; ?>;<input name="bulan" value="<? echo $bulan; ?>" type="hidden"><br>
Tanggal <? echo $tanggal; ?>;.<input name="tanggal" value="<? echo $tanggal; ?>" type="hidden"></p>
</b>
<div class="form_settings">
<table border="0">
<tr><th align='center'><b>No</b></th><th align='center'>NIS</th><th>NAMA SISWA</th><th>KELAS</th><th align='center'>JMLH UANG</th><th align='center'>REFNO</th><th align='center'>KETERANGAN</th></tr>
<?
$no = 1;
while($r = mysql_fetch_array($lihat_mutasi)){

$vacc = $r['vacc'];
$nis1 = substr($vacc,7,9);
if (substr($nis1,0,1)=="0"){
  $nis = substr($nis1,1,8);
}else{
  $nis = $nis1;
};

$uang=rp($r['uang']);
echo "<tr><td align='center'>$no</td>
          <td align='center'>$nis</td>
          <td>$r[nama]</td>
          <td align='center'>$r[kelas] $r[paralel]</td>
          <td align='center'>$uang</td>
          <td align='center'>$r[refno] $r[rek]</td>
          <td align='center'>$r[ket]</td>          
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