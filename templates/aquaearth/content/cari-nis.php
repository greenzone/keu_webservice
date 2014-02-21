<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
?>
<!-- bagian kanan -->		   	  
<div id="right">
<div class=" right_box_top"></div>

<div class="text">
<img src="<?php echo "$f[folder]/images/img_h1.gif" ?>" class="img_h1"  alt="" />

<span class="a_h1">Fasilitas Pencarian Nomor Induk Siswa (NIS)<br> Al-Azhar Bumi Serpong Damai</span>
            <div style="height:8px"></div>
            <div style=" clear:both; height:5px;"></div>

<form name="cari-nis-ok" method="post" action="cari-nis-ok">
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
</form>
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
}else{
include "../../../config/koneksi.php";
?>
<!-- bagian kanan -->		   	  
<div class="row">
<div class="row_bot">

<span class="a_h1">Fasilitas Pencarian Nomor Induk Siswa (NIS)<br> Al-Azhar Bumi Serpong Damai</span>
            <div style="height:8px"></div>
            <div style=" clear:both; height:5px;"></div>

<form name="cari-nis-ok" method="post" action="cari-nis-ok">
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