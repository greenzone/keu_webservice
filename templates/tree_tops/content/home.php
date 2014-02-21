<!-- insert the page content here -->
<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
?>
<h1>Welcome to Al-Azhar Bumi Serpong Damai</h1>
<p>SIstem Keuangan online (SIK) ini adalah sistem berbasis website dan webservices yang telah terhubung dengan 2 Bank Besar. yaitu Bank Muammalat Indonesia (BMI) dan Bank Rakyat Indonesia Syariah (BRIS). SIK ini dirancang terhubung dengan Bank untuk mengupdate data tagihan siswa-siswi Al-Azhar BSD secara realtime. Dengan SIK ini siswa-siswi Al-Azhar BSD dapat langsung membayar tagihan Uang Masuk (UM), Uang Kegiatan (Operasional), Uang SPP dan Uang Sumbangan Sukarela.</p>
<p>Siswa-siswi Al-Azhar BSD yang ingin membayar tagihan tersebut, dapat membayarkannya melalui BMI atau BRIS dengan cara datang langsung ke Teller masing-masing Bank dan menyebutkan Nomor Induk Siswa (NIS) dan jenis tagihan pembayaran.</p>
<p>Bagi siswa-siswi yang tidak hafal NIS nya, bisa mencari NIS nya <b><a href="cari-nis">disini</a></b>.</p>
<p>Bagi pengguna yang ingin melihat data tagihan siswa-siswi Al-Azhar BSD dapat login dengan memasukkan username dan password di menu sidebar.</p>
<h1>Browser Compatibility</h1>
<p>SIK ini telah dites dan berjalan maksimal di browser:</p>
<ul>
        <li>Internet Explorer 8</li>
        <li>Internet Explorer 7</li>
        <li>FireFox 3</li>
        <li>Google Chrome 2</li>
        <li>Safari 4</li>
</ul>
<?
}else{
?>
<!-- insert the page content admin here -->
<h1>Welcome <?php echo $_SESSION[nama_lengkap]; ?></h1>
<p>Sekarang anda berada di halaman Administrator SIstem Keuangan online (SIK). Silahkan pilih menu diatas. Jangan lupa untuk <b><a href="logout">Logout</a></b> jika telah selesai menggunakan.</p>
<?
}
?>