<?php
	class Core_Db_Mysqli{
		private static $_instance;
		private static $_conf;
		private static $_conns=[];

		private function __construct(){
			self::init();
		}
		private static function init(){
			if(!isset(self::$_conf)){
				$C=Core_Util_Config::getInstance();
				self::$_conf=$C['database'];
			}
		}
		public static function getInstance(){
			if(!(self::$_instance instanceof self)){
				self::$_instance = new self;
			}
			return self::$_instance;
		}
		public function __clone(){
			trigger_error('Clone is not allow!',E_USER_ERROR);
		}

		public static function getConn($conf='default',$name=null,$new=false){
			self::init();
			if(!isset($conf)){
				$conf='default';
			}
			if(!isset(self::$_conf[$conf])){
				return false;
			}
			if($new){
				return new Core_Db_Mysqli_Connect(self::$_conf[$conf]);
			}
			if(!isset($name)){
				$name=$conf;
			}
			if(!isset(self::$_conns[$name])){
				self::$_conns[$name]=new Core_Db_Mysqli_Connect(self::$_conf[$conf]);
			}
			return self::$_conns[$name];
		}
	}