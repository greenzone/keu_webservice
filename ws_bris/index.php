<?php
//just for simple security - all php files must called from index.php
define ( 'MUST_FROM_INDEX', 'WS_SIK_2011.1' );
//load nusoap library
require '../library/nusoap.php';
//load db configuration
require '../config/koneksi.php';
//load date
require '../date.php';
//load tripledes
//require 'tripledes.php';
//run ws server
require 'ws_server.php';
?>