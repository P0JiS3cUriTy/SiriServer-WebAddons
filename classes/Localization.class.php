<?php
class Localization {

	private $lang;
	private $languages = array();
	private $defaultLanguage = 'en';
	private $localeDir;

	public function __construct($localeDir) {
		$this->localeDir = $localeDir;
		$this->lang = $this->getUserLanguage();
		if(!file_exists($this->localeDir.$this->lang.'.txt')) {
			$this->lang = $this->defaultLanguage;
		}
		$langFile = $this->localeDir.$this->lang.'.txt';
		if(file_exists($langFile)) {
			$this->languages = parse_ini_file($langFile);
		} else {
			throw new Exception('Missing default language file !');
		}
	}
	
	public function t($text) {
		return $this->__($text);
	}
	
	public function __($text) {
		if(isset($this->languages[$text])) {
			return $this->languages[$text];
		} else {
			return $text;
		}
	}
	
	public function _e($text) {
		echo __($text);
	}
	
	public function getUserLanguage() {
		if(isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
			$langs = explode(',', $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
			if(isset($langs[0]) && strlen($langs[0]) >= 2) {
				$lang = substr($langs[0], 0,2);
				return $lang;
			}
		}
		return $this->defaultLanguage;
	}
	
}