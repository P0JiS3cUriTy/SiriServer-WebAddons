<?php
session_start();
require "config.php";
require "libs/twitteroauth/twitteroauth.php";
require "classes/TwitterConf.class.php";
if(isset($_GET["id"])) {
	$id = preg_replace("/[^a-zA-Z0-9-]/", "", $_GET['id']);
	
	if(empty($id)) {
		$message = "Vous devez activer iCloud pour utiliser ce service.";
	} else {
		/* Connect to Twitter and ask for token */
		$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET);
		$request_token = $connection->getRequestToken(TWITTER_CALLBACK);

		/* Save data in Session */
		$_SESSION['id'] = $id;
		$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

		// if Success, redirect to Twitter
		if($connection->http_code == 200) {
			$url = $connection->getAuthorizeURL($token,false);
			header("Location: ".$url.'&oauth_access_type=write');
			exit;
		} else {
			$message = "Erreur de communication avec Twitter.";
		}
	}
}
else if(isset($_GET["oauth_token"]) && isset($_GET["oauth_verifier"])) {

	if(!isset($_SESSION["id"]) || !isset($_SESSION["oauth_token"]) || !isset($_SESSION["oauth_token_secret"])) {
		echo "Vous devez utilisez un navigateur supportant les cookies...";
		exit;
	}

	/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
	$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

	/* Request access tokens from twitter */
	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	$id = $_SESSION["id"];
	
	/* Remove no longer needed request tokens */
	unset($_SESSION["id"]);
	unset($_SESSION["oauth_token"]);
	unset($_SESSION["oauth_token_secret"]);

	if($connection->http_code == 200) {		
		$twitterConf = new TwitterConf("twitter.conf");
		$twitterConf->setToken($id, $access_token["oauth_token"], $access_token["oauth_token_secret"]);
		$twitterConf->save();
		$message = "Votre compte a bien été enregistré.";
	} else {
		$message = "Erreur de communication avec Twitter.";
	}
}
else {
	$message = "Requête inconnue.";
}

if(isset($message)) {
	require 'classes/Page.class.php';
	$page = new Page(SERVER_NAME);
	$page->printHeader();
	echo '<p>'.$message.'</p>';
	$page->printFooter();
}