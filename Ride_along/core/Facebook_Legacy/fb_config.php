<?php
include_once 'facebook.php'; //include facebook SDK
######### Facebook API Configuration ##########
$appId = '238722499878103'; //Facebook App ID
$appSecret = '358724bd7aef483de851cb2e263663d1'; // Facebook App Secret
$homeurl = 'https://getaride.me/Ride_along/';  //return to home
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret,
  'default_graph_version' => 'v2.2',
));
$fbuser = $facebook->getUser();
?>