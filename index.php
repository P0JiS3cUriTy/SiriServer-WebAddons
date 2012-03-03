<?php
require 'config.php';
require 'classes/Page.class.php';

$page = new Page(SERVER_NAME);

$page->printHeader();

if(defined("SERVER_HOST") )
{
	$fp = @fsockopen(SERVER_HOST, SERVER_PORT, $errno, $errstr, 3);
	if(!$fp)
	{
		echo '<p style="font-size:2em;color:red;text-align:center;"><img src="images/siri-offline.png"><br />Server is offline</p>';
	} else{
		echo '<p style="font-size:2em;color:green;text-align:center;"><img src="images/siri-online.png"><br />Server is online</p>';
		fclose($fp);
	}
}

echo '<h2>How to connect</h2>';

if(file_exists("server.pem"))
{
	echo '<ol data-role="listview" data-inset="true">';
	echo '<li>Install Spire</li>';
	echo '<li>Set host to: <strong>https://'.SERVER_HOST.':'.SERVER_PORT.'</strong> in Spire settings</li>';
	echo '<li><a rel="external" href="server.pem">Install the certificate</a></li>';
	echo '<li>Activate Siri in <em>Settings -> Siri</em></li>';
	echo '</ul>';
}

$page->printFooter();