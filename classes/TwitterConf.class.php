<?php
class TwitterConf {

	private $consumer_secret = TWITTER_CONSUMER_SECRET;
	private $consumer_key = TWITTER_CONSUMER_KEY;
	
	private $configfile;
	private $configArray;
	
	public function __construct($configfile) {
		$this->configfile = $configfile;
		if(file_exists($configfile)) {
			$this->load();
		} else {
			$this->configArray = array();
		}
	}
	
	private function load() {
		$this->configArray = parse_ini_file($this->configfile, true);
	}
	
	public function save() {
		$this->configArray["consumer"] = array(
			'consumer_secret' => $this->consumer_secret,
			'consumer_key' => $this->consumer_key,
		);
	
		$ini = "";
		foreach($this->configArray as $section => $elems) {
			$ini .= "[".$section."]"."\n";
			foreach($elems as $k => $v) {
				$ini .= $k." = ".$v."\n";
			}
			$ini .= "\n";
		}
		file_put_contents($this->configfile, $ini);
	}
	
	public function getToken($id) {
		if(array_key_exists($id, $this->configArray)) {
			return $this->configArray[$id];
		} else {
			return null;
		}
	}
	
	public function removeToken($id) {
		unset($this->configArray[$id]);
		return true;
	}
	
	public function setToken($id, $access_token, $access_token_secret) {
		$this->configArray[$id] = array(
			'access_token' => $access_token,
			'access_token_secret' => $access_token_secret
		);
		return true;
	}
}
