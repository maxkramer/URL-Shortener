<?php
	include('Browser.php');
	$host = 'localhost';
	$username = 'db_username';
	$password = 'db_password';
	$db = 'db_name';
	
	$homepage = 'http://maxk.me'; // homepage if something goes wrong
	$redirect = 'http://url.maxk.me'; // domain which short-urls will be appended onto. I.e http://url.maxk.me/1 will re-direct to maxk.me.
	
	function browser_details() {
		$browser = new Browser();
		return $browser->getPlatform() . ' ' . $browser->getBrowser() . ' ' . $browser->getVersion();
	}
	function user_ip() {
		return getenv("REMOTE_ADDR");
	}
	function gen_short_url ($num) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$base = strlen($characters); // 62
    	$string = $characters[$num % $base];
    	while (($num = intval($num / $base)) > 0)
    	{
        	$string = $characters[$num % $base] . $string;
    	}
    	return $string;
	}
?>