<?php
	class Model_User_Interface extends Core_Model_Base{
		protected $_data=[];
		protected $_oldData=[];
		protected $_mainTable='user';
		protected $_fields=[
			'id'=>[
				'name'=>'id',
				'type'=>'int',
			],
			'guid'=>[
				'name'=>'guid',
				'type'=>'varchar',
			],
			'username'=>[
				'name'=>'username',
				'type'=>'varchar',
			],
			'mobile'=>[
				'name'=>'mobile',
				'type'=>'varchar',
			],
			'mail'=>[
				'name'=>'mail',
				'type'=>'varchar',
			],
			'salt'=>[
				'name'=>'salt',
				'type'=>'varchar',
			],
			'passwd'=>[
				'name'=>'passwd',
				'type'=>'varchar',
			],
			'create_time'=>[
				'name'=>'create_time',
				'type'=>'varchar',
			],
			'create_ip'=>[
				'name'=>'create_ip',
				'type'=>'varchar',
			],
			'last_login_time'=>[
				'name'=>'last_login_time',
				'type'=>'varchar',
			],
			'last_login_ip'=>[
				'name'=>'last_login_ip',
				'type'=>'varchar',
			],
			'token'=>[
				'name'=>'token',
				'type'=>'varchar'
			],
			'token_expire'=>[
				'name'=>'token_expire',
				'type'=>'datetime',
			]
		];


		public function __construct(){
			parent::__construct();
			$this->_mainTable=$this->_con->table($this->_mainTable);
		}

		public static function decodeLoginCookie($cookie){
			return explode('|',$cookie);
		}
		public static function encodeLoginCookie($guid,$token){
			return $guid.'|'.$token;
		}

		public function getData($key=null){
			if(isset($key)){
				return $this->_data[$key];
			}
			return $this->_data;
		}

		protected function _logout($logoutToken='',$force=false){
			if(!$force){
				if(!isset($logoutToken)||!$logoutToken){
					return false;
				}
				if($_SESSION['current_user']['logout_value']!=$logoutToken){
					return false;
				}
			}
			$_SESSION['current_user']=null;
			Tool::delCookie(Tool::$_userCookie);
			return true;
		}

		protected function _checkExistsFromDataBase($key,$value){
			if(!isset($key)){
				return false;
			}
			$count=0;
			$stmt=$this->_con->prepare("SELECT COUNT('id') FROM {$this->_mainTable} WHERE {$this->_fields[$key]['name']}=? LIMIT 1");
			$stmt->bind_param($this->_fieldType[$this->_fields[$key]['type']],$value);
			$stmt->execute();
			$stmt->bind_result($count);
			$stmt->fetch();
			$stmt->close();
			return $count;
		}

		protected function _getUserFromDataBase($key,$value){
			if(!isset($key)){
				return false;
			}
			$readFields=[];
			/*
			foreach($this->_fields as $k=>$v){
				$readFields[]=$v['name'];
			}
			*/
			$readFields[]=$this->_fields['id']['name'];
			$readFields[]=$this->_fields['guid']['name'];
			$readFields[]=$this->_fields['username']['name'];
			$readFields[]=$this->_fields['mobile']['name'];
			$readFields[]=$this->_fields['mail']['name'];
			$readFields[]=$this->_fields['salt']['name'];
			$readFields[]=$this->_fields['passwd']['name'];
			$readFields[]=$this->_fields['create_time']['name'];
			$readFields[]=$this->_fields['create_ip']['name'];
			$readFields[]=$this->_fields['last_login_time']['name'];
			$readFields[]=$this->_fields['last_login_ip']['name'];
			$readFields[]=$this->_fields['token']['name'];
			$readFields[]=$this->_fields['token_expire']['name'];
			$readFields='`'.implode('`,`',$readFields).'`';
			$stmt=$this->_con->prepare("SELECT {$readFields} FROM {$this->_mainTable} WHERE {$this->_fields[$key]['name']}=? LIMIT 1");
			$stmt->bind_param($this->_fieldType[$this->_fields[$key]['type']],$value);
			$stmt->execute();
			$stmt->bind_result(
				$this->_data['id'],
				$this->_data['guid'],
				$this->_data['username'],
				$this->_data['mobile'],
				$this->_data['mail'],
				$this->_data['salt'],
				$this->_data['passwd'],
				$this->_data['create_time'],
				$this->_data['create_ip'],
				$this->_data['last_login_time'],
				$this->_data['last_login_ip'],
				$this->_data['token'],
				$this->_data['token_expire']
			);
			$res=$stmt->fetch();
			$stmt->close();
			return $res;
		}



		protected function _createUserIntoDatabase($username,$mobile,$mail,$passwd,$token_expire=null){
			$writeFields[]=$this->_fields['guid']['name'];
			$writeFields[]=$this->_fields['username']['name'];
			$writeFields[]=$this->_fields['mobile']['name'];
			$writeFields[]=$this->_fields['mail']['name'];
			$writeFields[]=$this->_fields['salt']['name'];
			$writeFields[]=$this->_fields['passwd']['name'];
			$writeFields[]=$this->_fields['create_time']['name'];
			$writeFields[]=$this->_fields['create_ip']['name'];
			$writeFields[]=$this->_fields['last_login_time']['name'];
			$writeFields[]=$this->_fields['last_login_ip']['name'];
			$writeFields[]=$this->_fields['token']['name'];
			$writeFields[]=$this->_fields['token_expire']['name'];
			$writeFields='`'.implode('`,`',$writeFields).'`';
			$stmt=$this->_con->prepare("INSERT INTO {$this->_mainTable} ({$writeFields}) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
			$time=time();
			$guid=Tool::createGuid();
			//$username;
			//$mobile;
			//$mail;
			$salt=md5(rand().time());
			$passwd=md5($salt.$passwd);
			$create_time=date('Y-m-d H:i:s');
			$create_ip=$_SERVER['REMOTE_ADDR'];
			$last_login_time=$create_time;
			$last_login_ip=$create_ip;
			$token=Tool::createToken();
			if(isset($token_expire)){
				$token_expire=date('Y-m-d H:i:s',1);
			}
			$stmt->bind_param('sssssssssssi',$guid,$username,$mobile,$mail,$salt,$passwd,$create_time,$create_ip,$last_login_time,$last_login_ip,$token,$token_expire);
			$result=true;
			$result=$result&&($stmt->execute());
			$stmt->close();
			if($result){
				$this->_data['guid']=$guid;
				$this->_data['username']=$username;
				$this->_data['mobile']=$mobile;
				$this->_data['mail']=$mail;
				$this->_data['salt']=$salt;
				$this->_data['passwd']=$passwd;
				$this->_data['create_time']=$create_time;
				$this->_data['create_ip']=$create_ip;
				$this->_data['last_login_time']=$last_login_time;
				$this->_data['last_login_ip']=$last_login_ip;
				$this->_data['token']=$token;
				$this->_data['token_expire']=$token_expire;
			}
			return $result;
		}

		protected function _updatePersistentLoginTokenIntoDatabase($token,$timeout){//todo:不健壮
			$_token=$this->_fields['token']['name'];
			$_token_expire=$this->_fields['token_expire']['name'];
			$_id=$this->_fields['id']['name'];
			$_id_value=$this->_data['id'];
			$stmt=$this->_con->prepare("UPDATE {$this->_mainTable} SET {$_token}=?,{$_token_expire}=? WHERE {$_id}={$_id_value}");
			$stmt->bind_param('ss',$token,$timeout);
			return $stmt->execute();
		}

		protected function _updateLastLoginInfoIntoDatabase(){
			return true;
		}

		public function loginByForm($mobile,$passwd,$permanent=null){
			if(!$this->_getUserFromDataBase('mobile',$mobile)){
				return Err::USER_MOBILE_IS_NOT_EXIST;
			}
			if(md5($this->_data['salt'].$passwd)==$this->_data['passwd']){
				return $this->login($permanent);
			}
			else{
				$_SESSION['current_user']=null;
				return Err::USER_PASSWORD_IS_INCORRECT;
			}
		}

		public function loginByCookie($guid,$token){
			if(!$this->_getUserFromDataBase('guid',$guid)){
				return false;
			}
			if($token==$this->_data['token']){
				return $this->login();
			}
			else{
				$_SESSION['current_user']=null;
				return false;
			}
		}

		public function login($permanent=null){
			$_SESSION['current_user']=[];
			$_SESSION['current_user']=array_merge($_SESSION['current_user'],$this->_data);
			$_SESSION['current_user']['logout_key']=Tool::createToken();
			$_SESSION['current_user']['logout_value']=Tool::createToken();
			if(isset($permanent)){
				$permanent=time()+$permanent*86400;
				if($this->_updatePersistentLoginTokenIntoDatabase($_SESSION['current_user']['token'],date('Y-m-d H:i:s',$permanent))){
					Tool::setCookie(Tool::$_userCookie,$_SESSION['current_user']['guid'].'|'.$_SESSION['current_user']['token'],$permanent);
				}
				else {
					return false;
				}
			}
			return true;
		}

		public function loadCurrent(){
			if(Tool::checkLogin()){
				$cuser=$_SESSION['current_user'];
				$this->_data['guid']=$cuser['guid'];
				$this->_data['username']=$cuser['username'];
				$this->_data['mobile']=$cuser['mobile'];
				$this->_data['mail']=$cuser['mail'];
				$this->_data['salt']=$cuser['salt'];
				$this->_data['passwd']=$cuser['passwd'];
				$this->_data['create_time']=$cuser['create_time'];
				$this->_data['create_ip']=$cuser['create_ip'];
				$this->_data['last_login_time']=$cuser['last_login_time'];
				$this->_data['last_login_ip']=$cuser['last_login_ip'];
				$this->_data['token']=$cuser['token'];
				$this->_data['token_expire']=$cuser['token_expire'];
				return true;
			}
			else {
				return false;
			}
		}

	}