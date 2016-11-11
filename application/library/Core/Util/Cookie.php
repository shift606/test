<?php
	class Core_Util_Cookie{
		const COOKIE_EXPIRE=1;
		private $_cookieDomain;
		private $_cookiePath;
		public function __construct($path='/'){
			$this->_cookieDomain=Tool::getConf('site/domain')['value'];
			$this->_cookiePath=$path;
		}
		public function setCookie($name, $value = null, $expire = null, $path = null, $domain = null, $secure = null, $httponly = null) {
			return setcookie($name, $value, $expire,isset($path)?$path:$this->_cookiePath,$this->_cookieDomain, $secure, $httponly);
		}
		public function delCookie($name){
			return setcookie($name,'',self::COOKIE_EXPIRE,$this->_cookiePath,$this->_cookieDomain);
		}
	}