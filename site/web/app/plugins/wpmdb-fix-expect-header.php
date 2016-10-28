<?php
/* 
Plugin Name: WPMDB - Fix cURL Expect Header
Plugin URI: https://gist.github.com/JRGould/bd4e23a40111f5f3cd69b6913e05de00/
Description: Preempts automatic inclusion of "Expect: 100-continue" header by cURL which can cause null response from remote site, resulting in "cURL Error 52: Empty reply from server."
Author: Delicious Brains 
Author URI: http://deliciousbrains.com 
Version: 0.1
Network: True
*/ 

function dbrains_preempt_expect_header($r, $url) {
	$r['headers']['Expect'] = '';
	return $r;
}
add_filter( 'http_request_args', 'dbrains_preempt_expect_header', 10, 2 );
