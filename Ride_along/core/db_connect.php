<?php
	$dbuser = 'root';
	$dbpass = '';
	$dbhost = 'localhost';
	$dbname = 'getaride';

	try {
		$db = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		echo "Connection failed! ".$e->getMessage();
	}
?>