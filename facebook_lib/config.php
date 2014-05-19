<?php
//Facebook Application Configuration.
$facebook_appid='1417253511882673';
$facebook_app_secret='f22cbbeb984d2c7be2cfc2b6b36dc999';
$facebook_scope='email,user_birthday'; // Don't modify this

$facebook = new Facebook(array(
'appId'  => $facebook_appid,
'secret' => $facebook_app_secret,
));
?>
