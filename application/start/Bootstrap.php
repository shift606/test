<?php
	class Bootstrap extends Yaf_Bootstrap_Abstract{

		public function _initSession(){
			session_start();
			if(!isset($_SESSION['current_user'])){
				$_SESSION['current_user']=null;
			}
		}

		public function _initConfig(){
			Core_Util_Config::getInstance();
		}

		public function _initDatabase(){
			Core_Util_Database::getInstance();
		}

		public function _initUser(){
			if(!isset($_SESSION['current_user'])){
				if(isset($_COOKIE[Tool::$_userCookie])){
					$user=new Test_Model_User();
					$login_cookie=Tool::deCookie($_COOKIE[Tool::$_userCookie]);
					$result=$user->loginByCookie($login_cookie[0],$login_cookie[1]);
					if(!$result){
						$user->logout('',true);
					}
				}
			}
		}

	}