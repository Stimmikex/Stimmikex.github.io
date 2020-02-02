<?php
	$pageName = 'Login';
?>
<!DOCTYPE html>
<html class="no-js" lang="IS_is">
	<head>
		<?php require_once 'inc/head.php'; ?>
	</head>
	<body>
		<?php require_once 'inc/header.php'; ?>
		<?php
			$helper = $fb->getRedirectLoginHelper();

			$permissions = ['email']; // Optional permissions
			$loginUrl = $helper->getLoginUrl('https://getaride.me/Ride_along/core/fb-callback.php', $permissions);

			echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';

		/*if(!$fbuser){
				$fbuser = null;
				$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
				$output = '<a href="'.$loginUrl.'"><img src="img/fb_login.png"></a>';
			}else{
				$user_profile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
				$user = new Users($db);
				$user_data = $user->checkUser('facebook',$user_profile['id'],$user_profile['first_name'],$user_profile['last_name'],$user_profile['email'],$user_profile['gender'],$user_profile['locale'],$user_profile['picture']['data']['url']);
			}
			echo $output;*/
		?>
		<?php require_once 'inc/footer.php'; ?>
	</body>
</html>