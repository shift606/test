<?php
	class Model_User_Log extends Model_Log{
		public function __construct($table='user'){
			$this->_table=$table;
			$this->_fields['userid']='userid';
			$this->_params['userid']=isset($_SESSION['current_user']['id'])?$_SESSION['current_user']['id']:0;
			parent::__construct();
		}
		protected function _prepareStmt(){
			if($this->_isCanLog){
				$insertFields=[
					$this->_fields['type'],
					$this->_fields['num'],
					$this->_fields['content'],
					$this->_fields['is_generalized'],
					$this->_fields['userid'],
					$this->_fields['write_time']
				];
				$insertFields='`'.implode('`,`',$insertFields).'`';
				$this->_stmt=$this->_con->prepare("INSERT INTO {$this->_table} ({$insertFields}) VALUES (?,?,?,?,?,NOW())");
				$this->_stmt->bind_param(
					'iisii',
					$this->_params['type'],
					$this->_params['num'],
					$this->_params['content'],
					$this->_params['is_generalized'],
					$this->_params['userid']
				);
			}
		}

		public function log($content='',$type=1,$num=0,$userid=null,$isGeneralized=false){
			$userid=isset($userid)?$userid:(isset($_SESSION['current_user']['id'])?$_SESSION['current_user']['id']:0);
			return $this->_writeLogIntoDatabase($content,$type,$num,$userid,$isGeneralized);
		}

		protected function _writeLogIntoDatabase($content='',$type=1,$num=0,$userid,$isGeneralized=false){
			$this->_params['userid']=$userid;
			return parent::_writeLogIntoDatabase($content,$type,$num,$isGeneralized);
		}
	}