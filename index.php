<?php
require 'load.php';

$page = new Page(SERVER_NAME);

$page->printHeader();

if(defined("SERVER_HOST") )
{
	$fp = @fsockopen(SERVER_HOST, SERVER_PORT, $errno, $errstr, 3);
	if(!$fp)
	{
		echo '<p style="font-size:2em;color:red;text-align:center;"><img src="images/siri-offline.png"><br />'.$l10n->t('SERVER_OFFLINE').'</p>';
	} else{
		echo '<p style="font-size:2em;color:green;text-align:center;"><img src="images/siri-online.png"><br />'.$l10n->t('SERVER_ONLINE').'</p>';
		fclose($fp);
	}
}

echo '<h2>'.$l10n->t('HOW_CONNECT').'</h2>';

if(file_exists("server.pem"))
{
	echo '<ol data-role="listview" data-inset="true">';
	echo '<li>'.$l10n->t('INSTALL_SPIRE').'</li>';
	echo '<li>'.sprintf($l10n->t('SPIRE_SETTINGS'), '<strong>https://'.SERVER_HOST.':'.SERVER_PORT.'</strong>').'</li>';
	echo '<li><a rel="external" href="server.pem">'.$l10n->t('INSTALL_CERT').'</a></li>';
	echo '<li>'.$l10n->t('ACTIVATE_SIRI').'</li>';
	echo '</ul>';
}

$page->printFooter();