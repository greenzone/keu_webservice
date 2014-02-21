<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
?>
<!-- bagian kanan -->		   	  
<div id="right">
<div class=" right_box_top"></div>

<div class="text">
<img src="<?php echo "$f[folder]/images/img_h1.gif" ?>" class="img_h1"  alt="" />

<span class="a_h1">Welcome to Al-Azhar Bumi Serpong Damai</span>
            <div style="height:8px"></div>
            <div style=" clear:both; height:5px;"></div>
            <b><p>SIstem Keuangan online (SIK) ini adalah sistem berbasis website dan webservices yang telah terhubung dengan 2 Bank Besar. yaitu Bank Muammalat Indonesia (BMI) dan Bank Rakyat Indonesia Syariah (BRIS). SIK ini dirancang terhubung dengan Bank untuk mengupdate data tagihan siswa-siswi Al-Azhar BSD secara realtime. Dengan SIK ini siswa-siswi Al-Azhar BSD dapat langsung membayar tagihan Uang Masuk (UM), Uang Kegiatan (Operasional), Uang SPP dan Uang Sumbangan Sukarela.</p>
            <p>Siswa-siswi Al-Azhar BSD yang ingin membayar tagihan tersebut, dapat membayarkannya melalui BMI atau BRIS dengan cara datang langsung ke Teller masing-masing Bank dan menyebutkan Nomor Induk Siswa (NIS) dan jenis tagihan pembayaran.</p>
            <p>Bagi siswa-siswi yang tidak hafal NIS nya, bisa mencari NIS nya <b><a href="cari-nis">disini</a></b>.</p>
            <p>Bagi pengguna yang ingin melihat data tagihan siswa-siswi Al-Azhar BSD dapat login dengan memasukkan username dan password di menu sidebar.</p>            <div style=" clear:both; height:1px;"></div>
<span class="a_h1">Browser Compatibility</span>
            <p>SIK ini telah dites dan berjalan maksimal di browser:</p>
            <ul>
                <li>Internet Explorer 8</li>
                <li>Internet Explorer 7</li>
                <li>FireFox 3</li>
                <li>Google Chrome 2</li>
               <li>Safari 4</li>
            </ul></b>
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
?>
<!-- bagian kanan -->	
<div class="row">
<div class="row_bot">

<span class="a_h1">Welcome <?php echo $_SESSION[nama_lengkap]; ?></span>
            <div style="height:8px"></div>
            <div style=" clear:both; height:5px;"></div>
            <b><p>Sekarang anda berada di halaman Administrator SIstem Keuangan online (SIK). Silahkan pilih menu diatas. Jangan lupa untuk <b><a href="logout">Logout</a></b> jika telah selesai menggunakan.</p>
            </b>
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