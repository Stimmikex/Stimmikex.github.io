<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require_once 'core/Facebook/autoload.php';
	require_once 'core/functions.php';
	require_once 'core/db_connect.php';

	$appId = '238722499878103'; //Facebook App ID
	$appSecret = '358724bd7aef483de851cb2e263663d1'; // Facebook App Secret
	$homeurl = 'https://getaride.me/Ride_along/';  //return to home

	$fb = new Facebook\Facebook([
		'app_id' => $appId,
		'app_secret' => $appSecret,
		'default_graph_version' => 'v2.2',
	]);

	$logged = null;

	if(!session_id()) {
		session_start();
		$logged = 'out';
	}
	
	if (isset($_SESSION['fb_access_token'])) {
		$logged = 'in';
		$user_profile = $fb->get('/me?fields=id,first_name,last_name,email,gender,locale,picture', $_SESSION['fb_access_token']);
		$user = new Users($db);
		$user_data_array = $user_profile->getDecodedBody();
		$user_data = $user->checkUser('facebook',
										$user_data_array['id'],
										$user_data_array['first_name'],
										$user_data_array['last_name'],
										$user_data_array['email'],
										$user_data_array['gender'],
										$user_data_array['locale'],
										$user_data_array['picture']['data']['url']);
	}

	$websiteName = 'Ride Request';

	$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
?>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo "$websiteName - $pageName - Under Construction!"; ?></title>
<link rel="stylesheet" type="text/css" href="css/style.css">