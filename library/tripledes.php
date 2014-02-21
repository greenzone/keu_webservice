<?php
$key = "muhaeminyunus@gmail.com1";

function hex2bin($h){
  if (!is_string($h)) return null;
  $r='';
  for ($a=0; $a<strlen($h); $a+=2) { $r.=chr(hexdec($h{$a}.$h{($a+1)})); }
  return $r;
}

function encrypt($input){
	global $key;
    $td = mcrypt_module_open('tripledes', '', 'cbc', '');
    $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
    mcrypt_generic_init($td, $key, $iv);
    $encrypted_data = mcrypt_generic($td, $input);
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);

return bin2hex($encrypted_data); //
}

function decrypt($encrypt){
	global $key;
    $td = mcrypt_module_open('tripledes', '', 'cbc', ''); //ecb
    $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
    mcrypt_generic_init($td, $key, $iv);
    $decrypted_data = mdecrypt_generic($td, hex2bin($encrypt));
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);

return $decrypted_data;
} 
?>