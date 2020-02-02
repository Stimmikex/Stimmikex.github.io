<?php
include_once 'inc/head.php';

if(array_key_exists('logout',$_GET))
{
	//$fb->destroySession();
	session_start();
	unset($_SESSION['userdata']);
	session_destroy();
}

header('Location:index.php');
?>