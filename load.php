<?php
session_start();
require dirname(__FILE__).'/config.php';
require dirname(__FILE__).'/classes/Localization.class.php';
$l10n = new Localization();
require dirname(__FILE__).'/classes/Page.class.php';
