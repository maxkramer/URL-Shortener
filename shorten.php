<?php
	include_once('includes.php');
	if (!isset($_GET['url'])) {
		header("Location: $homepage");
	}
	
	mysql_connect($host, $username, $password);
	mysql_select_db($db);
	
	$url = $_GET['url'];
	$browser = browser_details();
	$ip = user_ip();
	
	$url = mysql_real_escape_string($url);
	$browser = mysql_real_escape_string($browser);
	$ip = mysql_real_escape_string($ip);
	$number_of_visits = 1;
	
	$query = mysql_query("SELECT * FROM `urls` WHERE `url` = '$url'");
	
	
	if ($query){	
		if (mysql_num_rows($query) >= 1) {
			$array = mysql_fetch_array($query);
			header("Location: $redirect/" . $array[0]['short_url']);
			exit;
		}
	}
	
	
	mysql_query("INSERT INTO `urls` (`url`, `number_of_visits`, `uploader_ip`, `uploader_browser`, `last_visit`) VALUES ('$url', $number_of_visits, '$ip', '$browser', now())");
	
	$arr = mysql_fetch_array(mysql_query("SELECT `id` FROM `urls` WHERE `url` = '$url' AND `uploader_ip` = '$ip'"));
	$id = $arr[0]['id'];
	
	$short_url = gen_short_url($id);
	$short_url = mysql_real_escape_string($short_url);
			
	mysql_query("UPDATE `urls` SET `short_url` = '$short_url' WHERE `id` = '$id'");
	
	$array = array(
		'long_url' => $url,
		'id' => (int)$id,
		'short_url' => $short_url
	);
	exit(json_encode($array));
?>