<?php
if (! defined ( 'MUST_FROM_INDEX' )) exit ( 'Cannot access file directly' );
//WS Configuration
define ( 'NAMA_WS', 'sik_al_azhar_bsd' );
define ( 'NAMA_WSDL', 'ws_' . NAMA_WS . '.wsdl' );
//Create WS Service Instance with WSDL
$ws_svr = new nusoap_server ();
$ws_svr->soap_defencoding = 'UTF-8';
$ws_svr->configureWSDL ( NAMA_WS, 'urn:' . NAMA_WSDL, '', 'document');   ////////////////////

$len_userid=16; // ubah strlen nya menjadi panjang virtual account 8123000111212011

//Web Service Function - inquiry 
function inquiry($refno, $vano, $trxdate) { 
global $conn, $ws_svr, $len_userid;;
$v_vano = (!$vano || $vano=='')? '' : $vano;
$v_vano=(string)$v_vano;
if (strlen($vano)<$len_userid){  // ubah strlen nya menjadi panjang virtual account
	$return = 'namasiswa;000000;360'.';'.'DIGIT VAC KURANG!'.';'.'30';
}else{
	$kode=substr($v_vano,4,2);
	$jenis_tagihan_id = mysql_query("SELECT * FROM jenis_tagihan WHERE jenis_tagihan_id=$kode");
	$a = mysql_fetch_array ($jenis_tagihan_id);
	$unit = $a['unit'];
	$jenis_tagihan = $a['jenis_tagihan'];
	$tabel_siswa = "siswa_".$unit;
	$tabel_tagihan = "tagihan_".$unit;

	if (substr($v_vano,7,1)<>"0"){
		$nis=substr($v_vano,7,9);
	}else{
		$nis=substr($v_vano,8,8);
	}

	switch ($jenis_tagihan){
		case "Uang Sukarela":
			$sql = mysql_query("SELECT * FROM $tabel_siswa WHERE nis=$nis"); 
			if (mysql_num_rows($sql)=='1'){
				$row = mysql_fetch_array ($sql);
				$nama = $row['nama'];
				$nama_siswa = substr($nama,0,30);
				$return = $nama_siswa.';000000;360;Uang Sukarela;00';
			}else{
				$return = $nama_siswa.';000000;360;Nama Siswa Tidak Ditemukan;15';
			}	
		break;

		default:
			$sql = mysql_query("SELECT * FROM $tabel_siswa WHERE nis=$nis"); 
			if (mysql_num_rows($sql)=='1'){
				$sql = mysql_query("SELECT * FROM $tabel_tagihan WHERE vacc=$v_vano AND bayar='N'"); 
				if (mysql_num_rows($sql)=='1'){
					$row = mysql_fetch_array ($sql);
					$nama = $row['nama'];
					$nama_siswa = substr($nama,0,30);
					$tagihan = $row['tagihan']*100;
					$return = $nama_siswa.';'.$tagihan.';'.'360'.';'.$row['pembayaran'].' bulan '.$row['bulan'].' TP '.$row['tahun'].';'.'00';
				}else{
					$return = $nama_siswa.';000000;360;Tagihan Siswa Sudah Terbayar;15';
				}
			}else{
				$return = $nama_siswa.';000000;360;Nama Siswa Tidak Ditemukan;15';
			}	
		break;
	}
}
return $return;
}

//Web Service Function - payment
function payment($refno, $vano, $trxdate, $custname, $bill, $payment, $ccy) { 
global $conn, $ws_svr, $len_userid;
$v_vano = (!$vano || $vano=='')? '' : $vano;
$v_vano=(string)$v_vano;
if (strlen($vano)<$len_userid){  // ubah strlen nya menjadi panjang virtual account
	$return = '30';
}else{
	$kode=substr($v_vano,4,2);
	$jenis_tagihan_id = mysql_query("SELECT * FROM jenis_tagihan WHERE jenis_tagihan_id=$kode");
	$a = mysql_fetch_array ($jenis_tagihan_id);
	$unit = $a['unit'];
	$jenis_tagihan = $a['jenis_tagihan'];
	$tabel_siswa = "siswa_".$unit;
	$tabel_tagihan = "tagihan_".$unit;
	if (substr($v_vano,7,1)<>"0"){
		$nis=substr($v_vano,7,9);
	}else{
		$nis=substr($v_vano,8,8);
	}
	$cek = mysql_query("SELECT * FROM mutasi_bris WHERE refno='$refno'"); 
	if (mysql_num_rows( $cek )== '1') {
		$return = '12';
	}else{
		switch ($jenis_tagihan){
			case "Uang Masuk": //partial
				$sql = mysql_query("SELECT * FROM $tabel_tagihan WHERE vacc='$vano' AND bayar='N'"); 
				if (mysql_num_rows($sql)=='1') {
					$row = mysql_fetch_array ($sql);		
					$id = $row['id'];
					$no = $id+1;
					$tahun = $row['tahun'];
					$nama = $row['nama'];
					$nama_siswa = substr($nama,0,30);
					$kelas = $row['kelas'];
					$paralel = $row['paralel'];
					$unit = $row['unit'];
					$tagihan = $row['tagihan'];
					$payment1 = ($payment/100);
					$pembayaran = $row['pembayaran'];
					$bulan = $row['bulan'];
					$ket = $pembayaran.' TP '.$tahun.' angsuran ke '.$id;
					$tagih = $tagihan - $payment1;		
					if (($bill/100) <> $tagihan){
						$return = '13';			
					}else{
						if ($payment1==$tagihan AND $custname==$nama_siswa){
							mysql_query("INSERT INTO mutasi_bris(refno,vacc,nama,kelas,paralel,rek,uang,ket,trxdate) 
										VALUES('$refno','$v_vano','$nama','$kelas','$paralel','BRIS','$payment1','$ket','$trxdate')");
							mysql_query("UPDATE $tabel_tagihan SET bayar='Y', rek='BRIS', refno='$refno', trxdate='$trxdate' WHERE (vacc='$v_vano' AND id='$id')");
							$return = '00';	
						}else if ($payment1 < $tagihan AND $custname==$nama_siswa){
							mysql_query("INSERT INTO mutasi_bris(refno,vacc,nama,kelas,paralel,rek,uang,ket,trxdate)
										VALUES('$refno','$v_vano','$nama','$kelas','$paralel','BRIS','$payment1','$ket','$trxdate')");
							mysql_query("UPDATE $tabel_tagihan SET bayar='Y', rek='BRIS', refno='$refno', trxdate='$trxdate' WHERE (vacc='$v_vano' AND id='$id')");
							mysql_query("INSERT INTO $tabel_tagihan(id,tahun,vacc,nama,kelas,paralel,unit,tagihan,pembayaran,bulan,bayar,rek,refno,user,trxdate) 
										VALUES('$no','$tahun','$v_vano','$nama','$kelas','$paralel','$unit','$tagih','$pembayaran','$bulan','N','','','BMI','$trxdate')");	
							$return = '00';	
						}else if ($payment1 > $tagihan AND $custname==$nama_siswa){
							$return = '13';
						}
					}		
				}else{
					$return = '15';
				}	
			break;

			case "Uang Sukarela": //none
				$sql = mysql_query("SELECT * FROM $tabel_siswa WHERE nis='$nis' AND aktif='Y'"); 
				if (mysql_num_rows($sql)=='1') {
					$row = mysql_fetch_array ($sql);		
					$tahun = $row['tahun'];
					$nama = $row['nama'];
					$nama_siswa = substr($nama,0,30);
					$kelas = $row['kelas'];
					$paralel = $row['paralel'];
					$unit = $row['unit'];
					$payment1 = ($payment/100);
					$pembayaran = 'Uang Sukarela';
					$ket = $pembayaran.' '.$nama;
						$bulan = substr($trxdate,0,2);
						$sql1 = mysql_query("SELECT * FROM bulan WHERE bulan_id='$bulan'");
						$b=mysql_fetch_array ($sql1);
						$bulan1=$b['bulan'];
					if ($custname==$nama_siswa){
						mysql_query("INSERT INTO mutasi_bris(refno,vacc,nama,kelas,paralel,rek,uang,ket,trxdate) 
									VALUES('$refno','$v_vano','$nama','$kelas','$paralel','BRIS','$payment1','$ket','$trxdate')");
						mysql_query("INSERT INTO $tabel_tagihan(id,tahun,vacc,nama,kelas,paralel,unit,tagihan,pembayaran,bulan,bayar,rek,refno,user,trxdate) 
									VALUES('1','$tahun','$v_vano','$nama','$kelas','$paralel','$unit','$payment1','$pembayaran','$bulan1','Y','BRIS','$refno','BMI','$trxdate')");	
						$return = '00';	
					}else{
						$return = '15';
					}		
				}else{
					$return = '15';
				}	
			break;

			default: //full
				$sql = mysql_query("SELECT * FROM $tabel_tagihan WHERE vacc='$vano' AND bayar='N'"); 
				if (mysql_num_rows($sql)=='1') {
					$row = mysql_fetch_array ($sql);
					$id = $row['id'];
					$no = $id+1;
					$tahun = $row['tahun'];
					$nama = $row['nama'];
					$nama_siswa = substr($nama,0,30);
					$kelas = $row['kelas'];
					$paralel = $row['paralel'];
					$unit = $row['unit'];
					$tagihan = $row['tagihan'];
					$payment1 = ($payment/100);
					$pembayaran = $row['pembayaran'];
					$bulan = $row['bulan'];
					$ket = $pembayaran.' bulan '.$bulan. ' TP '.$tahun;	
					switch ($bulan){
						case 'Juli':
							$bulan1='Agustus';
						break;
						case 'Agustus':
							$bulan1='September';
						break;
						case 'September':
							$bulan1='Oktober';
						break;
						case 'Oktober':
							$bulan1='November';
						break;
						case 'November':
							$bulan1='Desember';
						break;
						case 'Desember':
							$bulan1='Januari';
						break;
						case 'Januari':
							$bulan1='Februari';
						break;
						case 'Februari':
							$bulan1='Maret';
						break;
						case 'Maret':
							$bulan1='April';
						break;
						case 'April':
							$bulan1='Mei';
						break;
						case 'Mei':
							$bulan1='Juni';
						break;
						case 'Juni':
							$bulan1='Juli';
							switch ($tahun){
								case'2010-2011':
									$tahun='2011-2012';
								break;
								case'2011-2012':
									$tahun='2012-2013';				
								break;
							}
						break;
						default:
						break;  
					}
					if ($payment1==$tagihan && $custname==$nama_siswa){
						mysql_query("INSERT INTO mutasi_bris(refno,vacc,nama,kelas,paralel,rek,uang,ket,trxdate) 
									VALUES('$refno','$v_vano','$nama','$kelas','$paralel','BRIS','$payment1','$ket','$trxdate')");
						mysql_query("UPDATE $tabel_tagihan SET bayar='Y', rek='BRIS', refno='$refno', trxdate='$trxdate' WHERE (vacc='$v_vano' AND id='$id')");
						mysql_query("INSERT INTO $tabel_tagihan(id,tahun,vacc,nama,kelas,paralel,unit,tagihan,pembayaran,bulan,bayar,rek,refno,user,trxdate) 
									VALUES('$no','$tahun','$v_vano','$nama','$kelas','$paralel','$unit','$tagihan','$pembayaran','$bulan1','N','','','BMI','$trxdate')");	
						$return = '00';	
					}else if ($payment1 < $tagihan && $custname==$nama_siswa){
						$return = '16';
					}else if ($payment1 > $tagihan && $custname==$nama_siswa){
						$return = '13';
					}		
				}else{
					$return = '15';
				}	
			break;
		}
	}
}
return $return;
}

//Web Service Function - Reversal
function reversal($refno, $vano, $trxdate, $paymentdate, $bill, $payment) { 
global $conn, $ws_svr, $len_userid;
$v_vano = (!$vano || $vano=='')? '' : $vano;
$v_vano=(string)$v_vano;
if (strlen($vano)<$len_userid){  // ubah strlen nya menjadi panjang virtual account
	$return = '30';
}else{
	$kode=substr($v_vano,4,2);
	$jenis_tagihan_id = mysql_query("SELECT * FROM jenis_tagihan WHERE jenis_tagihan_id=$kode");
	$a = mysql_fetch_array ($jenis_tagihan_id);
	$unit = $a['unit'];
	$jenis_tagihan = $a['jenis_tagihan'];
	$tabel_siswa = "siswa_".$unit;
	$tabel_tagihan = "tagihan_".$unit;
	if (substr($v_vano,7,1)<>"0"){
		$nis=substr($v_vano,7,9);
	}else{
		$nis=substr($v_vano,8,8);
	}
	$cek = mysql_query("SELECT * FROM mutasi_bris WHERE refno='$refno'"); 
	if (mysql_num_rows( $cek )<>1) {
		$return = '12';
	}else{
		switch ($jenis_tagihan){
			case 'Uang Sukarela': //none
			$bill1 = ($bill/100);
			$pay1 = ($payment/100);
			$sql = mysql_query("SELECT * FROM $tabel_tagihan WHERE (vacc='$v_vano' AND bayar='Y' AND refno='$refno' AND tagihan='$pay1')"); 
			if (mysql_num_rows($sql)=='1') {
				$row = mysql_fetch_array ($sql);
				$id = $row['id'];
				$no = $row['id']+1;
				$nama = $row['nama'];
				$kelas = $row['kelas'];
				$paralel = $row['paralel'];
				$tagihan = $row['tagihan'];
				$ket = 'reversal Uang Sukarela refno '.$refno;
				if ($bill1=='000000'){
					mysql_query("INSERT INTO mutasi_bris(refno,vacc,nama,kelas,paralel,rek,uang,ket,trxdate) 
								VALUES('$refno','$v_vano','$nama','$kelas','$paralel','BRIS','$pay1','$ket','$trxdate')");
					mysql_query("DELETE FROM $tabel_tagihan WHERE (vacc='$v_vano' AND bayar='Y' AND refno='$refno' AND tagihan='$pay1')");
					$return = '00';	
				}else{
					$return = '13';			
				}
			}else{
				$return = '15';
			}
			break;

			case 'Uang Masuk': //partial
			$bill1 = ($bill/100);
			$pay1 = ($payment/100);
			$sql = mysql_query("SELECT * FROM $tabel_tagihan WHERE (vacc='$v_vano' AND bayar='Y' AND refno='$refno' AND tagihan='$bill1')"); 
			if (mysql_num_rows($sql)=='1') {
				$row = mysql_fetch_array ($sql);
				$id = $row['id'];
				$no = $row['id']+1;
				$nama = $row['nama'];
				$kelas = $row['kelas'];
				$paralel = $row['paralel'];
				$tagihan = $row['tagihan'];
				$ket = 'reversal Uang Sukarela refno '.$refno;
				if ($bill1==$tagihan){
					$data = mysql_fetch_array (mysql_query("SELECT * FROM $tabel_tagihan WHERE (vacc='$v_vano' AND bayar='N')")); 
					$tagih = $data['tagihan'];
					$tagih1 = $tagih + $pay1;
					mysql_query("INSERT INTO mutasi_bris(refno,vacc,nama,kelas,paralel,rek,uang,ket,trxdate) 
								VALUES('$refno','$v_vano','$nama','$kelas','$paralel','BRIS','$pay1','$ket','$trxdate')");
					mysql_query("DELETE FROM $tabel_tagihan WHERE (vacc='$v_vano' AND bayar='Y' AND refno='$refno' AND tagihan='$bill1')");
					mysql_query("UPDATE $tabel_tagihan SET tagihan='$tagih1' WHERE (vacc='$v_vano' AND bayar='N')");									
					$return = '00';	
				}else{
					$return = '13';			
				}
			}else{
				$return = '15';
			}
			break;

			default: //full 
			$bill1 = ($bill/100);
			$pay1 = ($payment/100);
			$sql = mysql_query("SELECT * FROM $tabel_tagihan WHERE (vacc='$v_vano' AND bayar='Y' AND refno='$refno' AND tagihan='$bill1')"); 
			if (mysql_num_rows($sql)=='1') {
				$row = mysql_fetch_array ($sql);
				$id = $row['id'];
				$no = $row['id']+1;
				$nama = $row['nama'];
				$kelas = $row['kelas'];
				$paralel = $row['paralel'];
				$tagihan = $row['tagihan'];
				$ket = 'reversal '.$paymentdate.' refno '.$refno;		
				if ($bill1==$tagihan){
					mysql_query("INSERT INTO mutasi_bris(refno,vacc,nama,kelas,paralel,rek,uang,ket,trxdate) 
								VALUES('$refno','$v_vano','$nama','$kelas','$paralel','BRIS','$pay1','$ket','$trxdate')");
					mysql_query("DELETE FROM $tabel_tagihan WHERE (vacc='$v_vano' AND bayar='N' AND id='$no')");
					mysql_query("UPDATE $tabel_tagihan SET bayar='N', rek='', refno='', trxdate='' WHERE (vacc='$v_vano' AND id='$id')");
					$return = '00';	
				}else{
					$return = '13';			
				}
			}else{
				$return = '15';
			}
			break;	
		}
	}
}
return $return;
}

//Web Service Function - echo1
function echo1($echodate) { 
global $conn, $ws_svr;
if (strlen($echodate)==14){  // ubah strlen nya menjadi panjang virtual account
	$return = '00';
}else{
	$return = '30';
}
return $return;
}

//Web Service Function - signon
function signon($signondate) { 
global $conn, $date, $ws_svr;
$kode=substr($signondate,15,21);
if ($kode=='bris'){
    $return = $date.';00;www.alazhar-bsd.net';
}else{
    $return = $date.';30;www.alazhar-bsd.net';
}
return $return;
}

//Web Service Function - signoff
function signoff($signoffdate) { 
global $conn, $date, $ws_svr;
$kode=substr($signondate,15,21);
if ($kode=='bris'){
    $return = $date.';00;www.alazhar-bsd.net';
}else{
    $return = $date.';30;www.alazhar-bsd.net';
}
return $return;
}

//Register Function inquiry to Service
$ws_svr->register ( 'inquiry', array ('refno' => 'xsd:string', 'vano' => 'xsd:string', 'trxdate' => 'xsd:string'), array ('return' => 'xsd:string' ), 'urn:' . NAMA_WSDL, 'urn:' . NAMA_WSDL . '#inquiry', '', 'literal', 'Deskripsi fungsi inquiry' );
//Register Function payment to Service
$ws_svr->register ( 'payment', array ('refno' => 'xsd:string', 'vano' => 'xsd:string', 'trxdate' => 'xsd:string', 'custname' => 'xsd:string', 'bill' => 'xsd:string', 'payment' => 'xsd:string', 'ccy' => 'xsd:string'), array ('return' => 'xsd:string' ), 'urn:' . NAMA_WSDL, 'urn:' . NAMA_WSDL . '#payment', '', 'literal', 'Deskripsi fungsi payment' );
//Register Function reversal to Service
$ws_svr->register ( 'reversal', array ('refno' => 'xsd:string', 'vano' => 'xsd:string', 'trxdate' => 'xsd:string', 'paymentdate' => 'xsd:string', 'bill' => 'xsd:string', 'payment' => 'xsd:string'), array ('return' => 'xsd:string' ), 'urn:' . NAMA_WSDL, 'urn:' . NAMA_WSDL . '#reversal', '', 'literal', 'Deskripsi fungsi reversal' );
//Register Function echo1 to Service
$ws_svr->register ( 'echo1', array ('echodate' => 'xsd:string'), array ('return' => 'xsd:string' ), 'urn:' . NAMA_WSDL, 'urn:' . NAMA_WSDL . '#echo1', '', 'literal', 'Deskripsi fungsi echo' );
//Register Function signon to Service
$ws_svr->register ( 'signon', array ('signondate' => 'xsd:string'), array ('return' => 'xsd:string' ), 'urn:' . NAMA_WSDL, 'urn:' . NAMA_WSDL . '#signon', '', 'literal', 'Deskripsi fungsi signon' );
//Register Function signoff to Service
$ws_svr->register ( 'signoff', array ('signoffdate' => 'xsd:string'), array ('return' => 'xsd:string' ), 'urn:' . NAMA_WSDL, 'urn:' . NAMA_WSDL . '#signoff', '', 'literal', 'Deskripsi fungsi signoff' );

//Create The Service Response
$HTTP_RAW_POST_DATA = isset ( $HTTP_RAW_POST_DATA ) ? $HTTP_RAW_POST_DATA : '';
$ws_svr->service ( $HTTP_RAW_POST_DATA );
exit ();				   
?>