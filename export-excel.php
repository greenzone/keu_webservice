<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
?>
<p>Maaf anda tidak berhak mengakses halaman ini. Silahkan kembali ke menu <b><a href="home">Home</a></b> dan login terlebih dahulu.</p>
<?
}else{
include "config/koneksi.php";
include "date.php";
include "library/exExcel.php";

$op = $_GET['op'];

switch ($op){
  case "lihat-tagihan":
  $namaFile = "lihat_tagihan_".$currentTime.".xls";
  // header file excel
  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header('Content-Type: Application/Ms-Excel');
  // header untuk nama file
  header("Content-Disposition: attachment; filename=".$namaFile."");
  header("Content-Transfer-Encoding: binary ");
  // memanggil function penanda awal file excel
  xlsBOF();

  // ------ membuat kolom pada excel --- //
  // mengisi pada cell A1 (baris ke-0, kolom ke-0)
  xlsWriteLabel(0,0,"NO");               
  // mengisi pada cell A2 (baris ke-0, kolom ke-1)
  xlsWriteLabel(0,1,"NIS");              
  // mengisi pada cell A3 (baris ke-0, kolom ke-2)
  xlsWriteLabel(0,2,"NAMA SISWA");
  // mengisi pada cell A4 (baris ke-0, kolom ke-3)
  xlsWriteLabel(0,3,"KELAS");   
  // mengisi pada cell A5 (baris ke-0, kolom ke-4)
  xlsWriteLabel(0,4,"TAGIHAN"); 
  // mengisi pada cell A6 (baris ke-0, kolom ke-4)
  xlsWriteLabel(0,5,"KETERANGAN"); 
  // mengisi pada cell A7 (baris ke-0, kolom ke-4)
  xlsWriteLabel(0,6,"REFNO/REK"); 
  // mengisi pada cell A8 (baris ke-0, kolom ke-4)
  xlsWriteLabel(0,7,"TGL BAYAR"); 

  // -------- menampilkan data --------- //
  // query menampilkan semua data
  $tahun = $_POST['tahun'];
  $unit  = strtolower($_POST['unit']);
  $jenis_tagihan = $_POST['jenis_tagihan'];
  $bulan = $_POST['bulan'];
  $kelas = $_POST['kelas'];
  $paralel = $_POST['paralel'];
  $tabel="tagihan_".strtolower($unit);
  
  $sql= "SELECT * FROM $tabel WHERE tahun='$tahun' AND unit='$unit' AND pembayaran='$jenis_tagihan' AND bulan='$bulan' AND kelas='$kelas' AND paralel='$paralel'";
  $hasil = mysql_query($sql);

  // nilai awal untuk baris cell
  $noBarisCell = 1;

  // nilai awal untuk nomor urut data
  $noData = 1;

  while ($data = mysql_fetch_array($hasil))
  {
      // menampilkan no. urut data
      xlsWriteNumber($noBarisCell,0,$noData);

      // menampilkan data nis
      $vacc = $data['vacc'];
      $nis1 = substr($vacc,7,9);
      if (substr($nis1,0,1)=="0"){
        $nis = substr($nis1,1,8);
      }else{
        $nis = $nis1;
      };
      
      xlsWriteLabel($noBarisCell,1,$nis);
      // menampilkan data nama siswa
      xlsWriteLabel($noBarisCell,2,$data['nama']);
      // menampilkan data kelas
      $kelas1=$data['kelas']." ".$data['paralel'];
      xlsWriteLabel($noBarisCell,3,$kelas1);
      // menampilkan data tagihan
      xlsWriteNumber($noBarisCell,4,$data['tagihan']);

      if ($data['bayar']=="Y"){
        $ket="TERBAYAR";
      }else{
        $ket="BELUM";
      }
      // menampilkan data ket bayar
      xlsWriteLabel($noBarisCell,5,$ket);
      // menampilkan refno dan rek
      $refno1=$data['refno'].' '.$data['rek'];
      xlsWriteLabel($noBarisCell,6,$refno1);
      // menampilkan trxdate
      xlsWriteLabel($noBarisCell,7,$data['trxdate']);

      // increment untuk no. baris cell dan no. urut data
      $noBarisCell++;
      $noData++;
  }
  // memanggil function penanda akhir file excel
  xlsEOF();
  exit();  
  break;
  
  case "cari-tagihan":
  $namaFile = "cari_tagihan_".$currentTime.".xls";
  // header file excel
  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header('Content-Type: Application/Ms-Excel');
  // header untuk nama file
  header("Content-Disposition: attachment; filename=".$namaFile."");
  header("Content-Transfer-Encoding: binary ");
  // memanggil function penanda awal file excel
  xlsBOF();

  // ------ membuat kolom pada excel --- //
  // mengisi pada cell A1 (baris ke-0, kolom ke-0)
  xlsWriteLabel(0,0,"NO");               
  // mengisi pada cell A2 (baris ke-0, kolom ke-1)
  xlsWriteLabel(0,1,"NIS");              
  // mengisi pada cell A3 (baris ke-0, kolom ke-2)
  xlsWriteLabel(0,2,"NAMA SISWA");
  // mengisi pada cell A4 (baris ke-0, kolom ke-3)
  xlsWriteLabel(0,3,"KELAS");   
  // mengisi pada cell A5 (baris ke-0, kolom ke-4)
  xlsWriteLabel(0,4,"TAGIHAN"); 
  // mengisi pada cell A6 (baris ke-0, kolom ke-4)
  xlsWriteLabel(0,5,"KETERANGAN"); 
  // mengisi pada cell A7 (baris ke-0, kolom ke-4)
  xlsWriteLabel(0,6,"REFNO/REK"); 
  // mengisi pada cell A8 (baris ke-0, kolom ke-4)
  xlsWriteLabel(0,7,"TGL BAYAR"); 

  // -------- menampilkan data --------- //
  // query menampilkan semua data
  $tahun = $_POST['tahun'];
  $unit  = strtolower($_POST['unit']);
  $jenis_tagihan = $_POST['jenis_tagihan'];
  $nama = $_POST['nama'];
  $kelas = $_POST['kelas'];
  $tabel="tagihan_".strtolower($unit);

  $sql= "SELECT * FROM $tabel WHERE tahun='$tahun' AND pembayaran='$jenis_tagihan' AND nama LIKE '%$nama%' AND kelas LIKE '%$kelas%'";
  $hasil = mysql_query($sql);

  // nilai awal untuk baris cell
  $noBarisCell = 1;

  // nilai awal untuk nomor urut data
  $noData = 1;

  while ($data = mysql_fetch_array($hasil))
  {
      // menampilkan no. urut data
      xlsWriteNumber($noBarisCell,0,$noData);

      // menampilkan data nis
      $vacc = $data['vacc'];
      $nis1 = substr($vacc,7,9);
      if (substr($nis1,0,1)=="0"){
        $nis = substr($nis1,1,8);
      }else{
        $nis = $nis1;
      };

      xlsWriteLabel($noBarisCell,1,$nis);
      // menampilkan data nama siswa
      xlsWriteLabel($noBarisCell,2,$data['nama']);
      // menampilkan data kelas
      $kelas1=$data['kelas']." ".$data['paralel'];
      xlsWriteLabel($noBarisCell,3,$kelas1);
      // menampilkan data tagihan
      xlsWriteNumber($noBarisCell,4,$data['tagihan']);

      if ($data['bayar']=="Y"){
        $ket="TERBAYAR";
      }else{
        $ket="BELUM";
      }
      // menampilkan data ket bayar
      xlsWriteLabel($noBarisCell,5,$ket);
      // menampilkan refno dan rek
      $refno1=$data['refno'].' '.$data['rek'];
      xlsWriteLabel($noBarisCell,6,$refno1);
      // menampilkan trxdate
      xlsWriteLabel($noBarisCell,7,$data['trxdate']);

      // increment untuk no. baris cell dan no. urut data
      $noBarisCell++;
      $noData++;
  }
  // memanggil function penanda akhir file excel
  xlsEOF();
  exit();  
  break;  
  
  case "lihat-mutasi":
  $namaFile = "lihat_mutasi_".$currentTime.".xls";
  // header file excel
  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header('Content-Type: Application/Ms-Excel');
  // header untuk nama file
  header("Content-Disposition: attachment; filename=".$namaFile."");
  header("Content-Transfer-Encoding: binary ");
  // memanggil function penanda awal file excel
  xlsBOF();

  // ------ membuat kolom pada excel --- //
  // mengisi pada cell A1 (baris ke-0, kolom ke-0)
  xlsWriteLabel(0,0,"NO");               
  // mengisi pada cell A2 (baris ke-0, kolom ke-1)
  xlsWriteLabel(0,1,"NIS");              
  // mengisi pada cell A3 (baris ke-0, kolom ke-2)
  xlsWriteLabel(0,2,"NAMA SISWA");
  // mengisi pada cell A4 (baris ke-0, kolom ke-3)
  xlsWriteLabel(0,3,"KELAS");   
  // mengisi pada cell A5 (baris ke-0, kolom ke-4)
  xlsWriteLabel(0,4,"JML UANG"); 
  // mengisi pada cell A6 (baris ke-0, kolom ke-5)
  xlsWriteLabel(0,5,"REFNO/REK"); 
  // mengisi pada cell A7 (baris ke-0, kolom ke-6)
  xlsWriteLabel(0,6,"KETERANGAN"); 

  // -------- menampilkan data --------- //
  // query menampilkan semua data
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

  $sql= "SELECT * FROM $tabel WHERE trxdate='$trxdate'";
  $hasil = mysql_query($sql);

  // nilai awal untuk baris cell
  $noBarisCell = 1;

  // nilai awal untuk nomor urut data
  $noData = 1;

  while ($data = mysql_fetch_array($hasil))
  {
      // menampilkan no. urut data
      xlsWriteNumber($noBarisCell,0,$noData);

      // menampilkan data nis
      $vacc = $data['vacc'];
      $nis1 = substr($vacc,7,9);
      if (substr($nis1,0,1)=="0"){
        $nis = substr($nis1,1,8);
      }else{
        $nis = $nis1;
      };

      xlsWriteLabel($noBarisCell,1,$nis);
      // menampilkan data nama siswa
      xlsWriteLabel($noBarisCell,2,$data['nama']);
      // menampilkan data kelas
      $kelas1=$data['kelas']." ".$data['paralel'];
      xlsWriteLabel($noBarisCell,3,$kelas1);
      // menampilkan data jmlh uang
      xlsWriteNumber($noBarisCell,4,$data['uang']);
      // menampilkan refno dan rek
      $refno1=$data['refno'].' '.$data['rek'];
      xlsWriteLabel($noBarisCell,5,$refno1);
      // menampilkan ket
      xlsWriteLabel($noBarisCell,6,$data['ket']);

      // increment untuk no. baris cell dan no. urut data
      $noBarisCell++;
      $noData++;
  }
  // memanggil function penanda akhir file excel
  xlsEOF();
  exit();  
  break;  
}
}
?>