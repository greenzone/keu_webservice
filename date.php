<?php
function jin_date_diff($d1, $d2){
    $d1 = (is_string($d1) ? strtotime($d1) : $d1);
    $d2 = (is_string($d2) ? strtotime($d2) : $d2);

    $diff_secs = abs($d1 - $d2);
    $base_year = min(date("Y", $d1), date("Y", $d2));

    $diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
    return array(
        "years" => date("Y", $diff) - $base_year,
        "months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
        "months" => date("n", $diff) - 1,
        "days_total" => floor($diff_secs / (3600 * 24)),
        "days" => date("j", $diff) - 1,
        "hours_total" => floor($diff_secs / 3600),
        "hours" => date("G", $diff),
        "minutes_total" => floor($diff_secs / 60),
        "minutes" => (int) date("i", $diff),
        "seconds_total" => $diff_secs,
        "seconds" => (int) date("s", $diff)
    );
}
// memperoleh tanggal dan waktu sekarang 
	$now = getdate(); 
	if (strlen($now['mon'])=='1'){
		$mon='0'.$now['mon'];	
	}else{
		$mon=$now['mon'];	
	}
	if (strlen($now['mday'])=='1'){
		$mday='0'.$now['mday'];	
	}else{
		$mday=$now['mday'];	
	}
	if (strlen($now['hours'])=='1'){
		$hours='0'.$now['hours'];	
	}else{
		$hours=$now['hours'];	
	}
	if (strlen($now['minutes'])=='1'){
		$minutes='0'.$now['minutes'];	
	}else{
		$minutes=$now['minutes'];	
	}
	if (strlen($now['seconds'])=='1'){
		$seconds='0'.$now['seconds'];	
	}else{
		$seconds=$now['seconds'];	
	}
	
$date = $now['year'].$mon.$mday.$hours.$minutes.$seconds; // menyimpan sebagai strings 
$currentTime = $now["hours"] . ":" . $now["minutes"] . ":" . $now["seconds"]; 
$currentDate = $now["year"]. "-" . $now["mon"] . "-" . $now["mday"] ; 

$a = "2011-08-08 00:00:00";
$b = "$currentDate"." "."$currentTime";
$hasil = jin_date_diff($a, $b);

$lama=$hasil['days_total'];


?>