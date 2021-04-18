<?php
include './Facebook/autoload.php';
include './fb-config.php';
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; //optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/php_start/demo_MVC/facebook(Login)/fb-callback.php',$permissions);
?>