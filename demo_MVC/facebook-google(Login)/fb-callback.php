<?php
include './Facebook/autoload.php';
include './fb-config.php';
$helper = $fb->getRedirectLoginHelper();
if (isset($_GET['state'])) {
	$helper->getPersistentDataHandler()->set('state',$_GET['state']);
}
try {
	$accessToken = $helper->getAccessToken();
} catch (Facebook\Exceptions\FacebookResponseException $e){
	//When Grap returns an error
	echo "Graph returned an error" . $e->getMessage();
	exit;
} catch (Facebook\Exceptions\FacebookSDKException $e){
	//When Grap returns an error
	echo "Facebook SDK returned an error" . $e->getMessage();
	exit;
}

if (!isset($accessToken)) {
	if ($helper->getError()) {
		header('HTTP/1.0 401 Unauthirized');
		echo "error: " . $helper->getError() . "\n";
		echo "error Code: " . $helper->getErrorCode() . "\n";
		echo "error Reason: " . $helper->getErrorReason() . "\n";
		echo "error Description: " . $helper->getErrorDescription() . "\n";
} else {
	header('HTTP/1.0 400 Bad Request');
	echo "Bad request";
}
exit;
}

//Lấy thông tin người dùng
try {
	$response = $fb->get('/me?fields=id,name,email',$accessToken->getValue());
} catch (Facebook\Exceptions\FacebookResponseException $e) {
		echo "Graph returned an error" . $e->getMessage();
	exit;
} catch (Facebook\Exceptions\FacebookSDKException $e){
	//When Grap returns an error
	echo "Facebook SDK returned an error" . $e->getMessage();
	exit;
}

$fbUser = $response->getGraphUser();
if (!empty($fbUser)) {
	include './function.php';
	loginFromSocialCallBack($fbUser);
}
?>