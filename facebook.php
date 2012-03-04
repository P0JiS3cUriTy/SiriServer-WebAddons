<?php
require 'load.php';
require "classes/FacebookConf.class.php";

if(isset($_GET['id']))
{
	$id = preg_replace("/[^a-zA-Z0-9-_]/", "", $_GET['id']);

	if(empty($id)) {
		$message = $l10n->t('ICLOUD_CHECK');
	} else {
		$_SESSION['id'] = $id;
		$url = 'https://graph.facebook.com/oauth/authorize?client_id='.FACEBOOK_APPID.'&redirect_uri='.FACEBOOK_CALLBACK.'&scope=publish_stream';
		header("Location: ".$url);
		exit;
	}
}
else if(isset($_GET['code'])) {

	if(!isset($_SESSION["id"])) {
		echo $l10n->t("BROWSER_COOKIES");
		exit;
	}
	
	$id = $_SESSION["id"];
	unset($_SESSION["id"]);
	
	$code = preg_replace("/[^a-zA-Z0-9-_]/", "", $_GET['code']);
	$url = 'https://graph.facebook.com/oauth/access_token?client_id='.FACEBOOK_APPID.'&redirect_uri='.FACEBOOK_CALLBACK.'&client_secret='.FACEBOOK_APPSECRET.'&code='.$code;
	$response = file_get_contents($url);
	parse_str($response, $fb);
	if(isset($fb['access_token'])) {
		$conf = new FacebookConf("facebook.conf");
		$conf->setToken($id, $fb['access_token']);
		$conf->save();
		$message = $l10n->t('ACCOUNT_REGISTERED');
	} else {
		$message = $l10n->t('ERROR_COMMUNICATION_FACEBOOK');
	}
}
else {
	$message = $l10n->t("UNKNOWN_REQUEST");
}

if(isset($message)) {
	$page = new Page(SERVER_NAME);
	$page->printHeader();
	echo '<p>'.$message.'</p>';
	$page->printFooter();
}