<?php
  	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  	$url = trim($actual_link, '/');
  	$page_name1 = substr($url, strrpos($url, '/')+1);
	$page_name2 = substr($page_name1, count($page_name1)-1, -4);

	//include_once 'core/fb_config.php';

	/*if ($fbuser) {
		$logged = 'in';

		$oauth_uid = $_SESSION['fb_238722499878103_user_id'];
		$userID = null;

		$userIdQuery = 'SELECT id FROM users WHERE oauth_uid=:oauth_uid LIMIT 1';
		$userIdRes = $db->prepare($userIdQuery);
		$userIdRes->bindParam(':oauth_uid', $oauth_uid);
		$userIdRes->execute();

		while ($row = $userIdRes->fetch(PDO::FETCH_ASSOC)) {
			$userID = $row['id'];
		}

		$userIdQuery = $userIdRes = null;

		echo '<div style="display:none;" id="user_id_div">'.$userID.'</div>';
	} else {
		$logged = 'out';
	}*/

	/*if(!$fbuser){
		$fbuser = null;
		$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
		$output = '<a href="'.$loginUrl.'"><img src="img/fb_login.png"></a>';
	}else{
		$user_profile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
		$user = new Users($db);
		$user_data = $user->checkUser('facebook',$user_profile['id'],$user_profile['first_name'],$user_profile['last_name'],$user_profile['email'],$user_profile['gender'],$user_profile['locale'],$user_profile['picture']['data']['url']);
	}

	$helper = $facebook->getRedirectLoginHelper();

	try {
		$accessToken = $helper->getAccessToken();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}

	if (! isset($accessToken)) {
		if ($helper->getError()) {
	  		header('HTTP/1.0 401 Unauthorized');
	    	echo "Error: " . $helper->getError() . "\n";
	    	echo "Error Code: " . $helper->getErrorCode() . "\n";
	    	echo "Error Reason: " . $helper->getErrorReason() . "\n";
	    	echo "Error Description: " . $helper->getErrorDescription() . "\n";
	  	} 
	  	else {
	    	header('HTTP/1.0 400 Bad Request');
	    	echo 'Bad request';
	  	}
	  	exit;
	}*/

	if($_SERVER['HTTPS'] !== 'on') {
		header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		exit();
	}
?>
<header>
  <nav class="wrapper">
    <div class="logo"><a href="index.php" class="home-button"><img src="img/icons/carpool.png"></a></div><!-- Logo -->
    <input type="checkbox" id="menu-toggle">
      <label for="menu-toggle" class="label-toggle"></label>
    </input>
    <ul>
      	<li><a href="index.php">Home</a></li>
      	<li><a href="about.php">About us</a></li>
      	<?php 
      	if ($logged === 'in') {
      		echo '<li><a href="profile.php"><img src="'.$user_data['picture'].'" class="header_img"> Profile <span class="notification_count"></span></a></li>';
      		echo '<li><a href="logout.php?logout">Logout</a></li>';
      	}
      	else {
      		echo '<li><a href="login.php">Login</a></li>';
      	}
      	?>
    </ul>
  </nav>
</header>
<div class="content-wrap">
	<h3 align="center">THIS WEBSITE IS UNDER CONSTRUCTION!</h3>
		<!--[if lt IE 8]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->