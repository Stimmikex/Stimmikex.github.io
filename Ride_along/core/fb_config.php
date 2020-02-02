<?php
include_once 'Facebook/autoload.php'; //include facebook SDK
######### Facebook API Configuration ##########
$appId = '651434252260653'; //Facebook App ID
$appSecret = '383308e099d5ea89ea6edd6c4e0e598d'; // Facebook App Secret
$homeurl = 'https://localhost/Ride_along/';  //return to home
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook\Facebook(array(
  'app_id'  => $appId,
  'app_secret' => $appSecret,
  'default_graph_version' => 'v2.2',
));

$fbuser = null;
?>