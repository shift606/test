<?php
	class Tool{
		private static $_webConfig=null;
		private static $_cookieOpr=null;
		private static $_tokenLen=32;
		private static $_logs=[];
		public static $_userCookie='Test';

		public static function checkLogin(){
			return Core_Util_Checkuser::is_login();
		}

		public static function createGuid(){
			return Core_Util_Systool::createGuid();
		}

		public static function createToken(){
			return Core_Util_Systool::createRandStr(self::$_tokenLen);
		}

		public static function getUrl($url=''){
			return WEB_ROOT.$url;
		}

		public static function setCookie($name, $value = null, $expire = null){
			if(!(self::$_cookieOpr instanceof Core_Util_Cookie)){
				self::$_cookieOpr=new Core_Util_Cookie();
			}
			return self::$_cookieOpr->setCookie($name, $value, $expire);
		}

		public static function delCookie($name){
			if(!(self::$_cookieOpr instanceof Core_Util_Cookie)){
				self::$_cookieOpr=new Core_Util_Cookie();
			}
			return self::$_cookieOpr->delCookie($name);
		}
		public static function getParams($key=null){
			$params=$GLOBALS['app']->getDispatcher()->getRequest()->getParams();
			if(isset($key)){
				return $params[$key];
			}
			return $params;
		}

		public static function getConf($path=null){
			if(!(self::$_webConfig instanceof Model_Core_Config)){
				self::$_webConfig=new Model_Core_Config();
			}
			return self::$_webConfig->getConfig($path);
		}
		public static function enCookie($guid,$token){
			return Model_User_Interface::encodeLoginCookie($guid,$token);
		}

		public static function deCookie($cookie){
			return Model_User_Interface::decodeLoginCookie($cookie);
		}

		public static function log($model='base',$content='',$type=1,$num=0,$isGeneralized=false){
			if(!isset(self::$_logs[$model])||!(self::$_logs[$model] instanceof Model_Log_Interface)){
				self::$_logs[$model]=new Model_Log_Interface();
			}
			return self::$_logs[$model]->_writeLogIntoDatabase($content,$type,$num,$isGeneralized);
		}

		public static function syslog($content='',$type=1,$num=0,$isGeneralized=false){
			if(!isset(self::$_logs['sys'])||!(self::$_logs['sys'] instanceof Model_Log_Interface)){
				self::$_logs['sys']=new Model_Core_Log();
			}
			return self::$_logs['sys']->log($content,$type,$num,$isGeneralized);
		}


	}