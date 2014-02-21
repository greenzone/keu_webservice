<!-- insert the page content here -->
<?php
session_start();
include "../../../config/koneksi.php";
?>
<h1>Fasilitas Pencarian Nomor Induk Siswa (NIS)<br> Al-Azhar Bumi Serpong Damai</h1>
<form name="cari-nis-ok"  method="post"  action="cari-nis-ok">
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
<select name="unit">
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
<tr><th><b>Nama Siswa</b></th><th>:</th><th><input type='text' name="nama"></select></th></tr>
<tr><th><b>Kelas Siswa</b></th><th>:</th><th><input type='text' name="kelas"></select></th></tr>
</table>
<input class="submit" type="submit" name="cari" value="Cari Siswa">
</div>
</form>