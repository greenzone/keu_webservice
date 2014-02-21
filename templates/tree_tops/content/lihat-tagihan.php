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
<h1>Fasilitas Lihat Tagihan<br> Al-Azhar Bumi Serpong Damai</h1>
<form name="lihat-tagihan-ok"  method="post"  action="lihat-tagihan-ok">
<div class="form_settings">
<table border="0">
<tr><th><b>Pilih Tahun Ajaran</b></th><th>:</th><th>
<select name="tahun">
<option value="">Pilih Tahun Ajaran</option>
<?php
// query untuk menampilkan tahun
$query = "SELECT * FROM tahun";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
echo "<option value='".$data['tahun']."'>".$data['tahun']."</option>";
}
?>	
</select>
</th></tr>
<tr><th><b>Unit</b></th><th>:</th><th>
<select name="unit" id="unit">
<option value="">Pilih Unit</option>
<?php
// query untuk menampilkan unit
$query1 = "SELECT * FROM unit";
$hasil1 = mysql_query($query1);
while ($data1 = mysql_fetch_array($hasil1))
{
echo "<option value='".$data1['unit']."'>".$data1['unit']."</option>";
}
?>		
</select>
</th></tr>
<tr><th><b>Jenis Tagihan</b></th><th>:</th><th>
<select name="jenis_tagihan">
<option value="">Pilih Jenis Tagihan</option>
<?php
// query untuk menampilkan jenis tagihan
$query2 = "SELECT DISTINCT jenis_tagihan FROM jenis_tagihan ORDER BY jenis_tagihan_id ASC";
$hasil2 = mysql_query($query2);
while ($data2 = mysql_fetch_array($hasil2))
{
echo "<option value='".$data2['jenis_tagihan']."'>".$data2['jenis_tagihan']."</option>";
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
echo "<option value='".$data3['bulan']."'>".$data3['bulan']."</option>";
}
?>		
</select>
</th></tr><tr><th><b>Kelas</b></th><th>:</th><th>
<select name="kelas" id="kelas">
<option value="">Pilih Unit Dulu</option>
</select>
</th></tr>

<tr><th><b>Paralel</b></th><th>:</th><th>
<select name="paralel" id="paralel">
<option value="">Pilih Kelas Dulu</option>
</select>
</th></tr>

</table>
<input class="submit" type="submit" name="lihat" value="Lihat Tagihan">
</div>
</form>

<?
}
?>