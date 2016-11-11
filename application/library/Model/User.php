<?php
	class Model_User extends Model_User_Interface{
		protected $_log;

		public function __construct(){
			$this->_log=new Model_User_Log();
			parent::__construct();
		}

		public function createUser($mobile,$passwd,$mail='',$username=null){

			if(!isset($mobile)){
				return Err::USER_INFO_MOBILE_IS_NULL;
			}
			if(!Core_Util_Validate::checkMobile($mobile)){
				return Err::USER_INFO_MOBILE_WRONG_FORMAT;
			}

			if(!isset($passwd)){
				return Err::USER_INFO_PASSWORD_IS_NULL;
			}
			$chkpd=Core_Util_Validate::checkLength($passwd,8,16);
			if($chkpd===-1){
				return Err::USER_INFO_PASSWORD_TOO_SHORT;
			}
			if($chkpd===-2){
				return Err::USER_INFO_PASSWORD_TOO_LONG;
			}
			if($chkpd!==true){
				return Err::USER_INFO_PASSWORD_UNKNOW;
			}

			if(($mail!='')&&(!Core_Util_Validate::checkEmailFormat($mail))){
				return Err::USER_INFO_EMAIL_WRONG_FORMAT;
			}

			if(!isset($username)){
				$username=$mobile;
			}

			if($this->checkMobileExists($mobile)){
				return Err::USER_INFO_IS_EXIST;
			}

			return $this->_createUserIntoDatabase($username,$mobile,$mail,$passwd);
		}

		public function getUserById($id){
			return $this->_getUserFromDataBase('id',$id);
		}

		public function getUserByGuid($guid){
			return $this->_getUserFromDataBase('guid',$guid);
		}

		public function getUserByMobile($mobile){
			return $this->_getUserFromDataBase('mobile',$mobile);
		}

		public function checkMobileExists($mobile){
			return $this->_checkExistsFromDataBase('mobile',$mobile);
		}

		public function logout($logout_value='',$force=false){
			return $this->_logout($logout_value,$force);
		}

		public function log($content='',$type=1,$num=0,$userid=null,$isGeneralized=false){
			$this->_log->log($content,$type,$num,$userid,$isGeneralized);
		}

		public function login($permanent=null){
			$res=parent::login($permanent);
			if($res===true){
				$this->_afterLogin();
			}
			return $res;
		}

		private function _afterLogin(){
			$this->_log->log('登录成功');
			$this->_updateLastLoginInfoIntoDatabase();
		}

	}