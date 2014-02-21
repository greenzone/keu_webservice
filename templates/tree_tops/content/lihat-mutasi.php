<!-- insert the page content here -->
<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND ($_SESSION['leveluser']=="admin") ){
?>
<p>Maaf anda tidak berhak mengakses halaman ini. Silahkan kembali ke menu <b><a href="home">Home</a></b> dan login terlebih dahulu.</p>
<?
}else{
include "../../../config/koneksi.php";
?>
<!-- insert the page content admin here -->
<h1>Fasilitas Melihat Mutasi Rekening Harian<br> Al-Azhar Bumi Serpong Damai</h1>
<form name="lihat-mutasi-ok"  method="post"  action="lihat-mutasi-ok">
<div class="form_settings">
<table border="0">
<tr><th><b>Bank Partner</b></th><th>:</th><th>
<select name="bank">
<option value="">Pilih Bank</option>
<?php
// query untuk menampilkan bank
$query = "SELECT * FROM bank";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
echo "<option value='".$data['bank']."'>".$data['bank']."</option>";
}
?>	
</select>
</th></tr>
<tr><th><b>Tahun</b></th><th>:</th><th>
<select name="tahun1" id="tahun1">
<option value="">Pilih Tahun</option>
<?php
// query untuk menampilkan tahun1
$query1 = "SELECT * FROM tahun1";
$hasil1 = mysql_query($query1);
while ($data1 = mysql_fetch_array($hasil1))
{
echo "<option value='".$data1['tahun1']."'>".$data1['tahun1']."</option>";
}
?>		
</select>
</th></tr>
<tr><th><b>Bulan</b></th><th>:</th><th>
<select name="bulan">
<option value="">Pilih Bulan Tagihan</option>
<?php
// query untuk menampilkan bulan tagihan
$query3 = "SELECT * FROM bulan ORDER BY bulan_id ASC";
$hasil3 = mysql_query($query3);
while ($data3 = mysql_fetch_array($hasil3))
{
echo "<option value='".$data3['bulan_id']."'>".$data3['bulan']."</option>";
}
?>		
</select>
</th></tr><tr><th><b>Tanggal</b></th><th>:</th><th>
<select name="tanggal" id="tanggal">
<option value="">Pilih Tanggal</option>
<?php
// query untuk menampilkan tanggal
$i = 1;
while ($i <= 31)
{
echo "<option value='".$i."'>".$i."</option>";
$i++;
}
?>		

</select>
</th></tr>

</table>
<input class="submit" type="submit" name="lihat" value="Lihat Mutasi">
</div>
</form>

<?
}
?>