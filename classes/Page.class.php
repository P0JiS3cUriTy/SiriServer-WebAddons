<?php
class Page {
	private $title;
	function __construct($title) {
		$this->title = $title;
	}
	
	function printHeader() {
		echo '<!DOCTYPE html> 
<html> 
	<head> 
	<title>'.$this->title.'</title> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0-rc.1/jquery.mobile-1.1.0-rc.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.1.0-rc.1/jquery.mobile-1.1.0-rc.1.min.js"></script>
	<script type="text/javascript">if (window.location.hash == "#_=_")window.location.hash = "";</script>
</head> 
<body> 

<div data-role="page">

	<div data-role="header">
		<h1>'.$this->title.'</h1>
	</div><!-- /header -->

	<div data-role="content">';
	}
	
	function printFooter($navbar='') {
		echo '	</div><!-- /content -->

</div><!-- /page -->

</body>
</html>';
	}
}