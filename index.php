<?php
	include_once('includes.php');
	
	
	if (!isset($_GET['url'])) {
		header("Location: $homepage");
	}
	
	mysql_connect($host, $username, $password);
	mysql_select_db($db);
	
	$short_url = $_GET['url'];
	
	$short_url = mysql_real_escape_string($short_url);
	
	$query = mysql_query("SELECT `url` FROM `urls` WHERE `short_url` = '$short_url'");
	
	if (!$query) {
		header("Location: $homepage");
	}
	
	$array = mysql_fetch_array($query);
		
	$url = $array[0];
			
	if (mysql_num_rows($query) > 0) {
		mysql_query("UPDATE `urls` SET `last_visit` = now(), `number_of_visits` = (number_of_visits + 1) WHERE `short_url` = '$short_url'") or die(mysql_error());
		header("Location: $url");
	}
	
?>