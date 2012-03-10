<?php
session_start();
require dirname(__FILE__).'/classes/Page.class.php';
require dirname(__FILE__).'/classes/Localization.class.php';
$l10n = new Localization(dirname(__FILE__).'/lang/');

if(!file_exists(dirname(__FILE__).'/config.php')) {
	echo "Missing config.php file !";
	exit;
}

require dirname(__FILE__).'/config.php';