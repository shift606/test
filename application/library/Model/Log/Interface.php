<?php
	class Model_Log_Interface extends Core_Model_Base{
		protected $_isCanLog=false;
		public $_isIgnoreLog=false;
		protected $_table='base';
		protected $_stmt;
		protected $_fields=[
			'id'=>'id',
			'type'=>'type',
			'num'=>'num',
			'content'=>'content',
			'is_generalized'=>'is_generalized',
			'write_time'=>'write_time'
		];
		protected $_params=[
			'type'=>1,
			'num'=>1,
			'content'=>'',
			'is_generalized'=>0
		];
		public function __construct($con='log',$init=true){
			parent::__construct($con);
			$this->_isCanLog=!!$this->_con;
			$this->_table=$this->_con->table($this->_table);
			$this->_prepareStmt();
		}
		protected function _prepareStmt(){
			if($this->_isCanLog){
				$insertFields=[
					$this->_fields['type'],
					$this->_fields['num'],
					$this->_fields['content'],
					$this->_fields['is_generalized'],
					$this->_fields['write_time']
				];
				$insertFields='`'.implode('`,`',$insertFields).'`';
				$this->_stmt=$this->_con->prepare("INSERT INTO {$this->_table} ({$insertFields}) VALUES (?,?,?,?,NOW())");
				$this->_stmt->bind_param(
					'iisi',
					$this->_params['type'],
					$this->_params['num'],
					$this->_params['content'],
					$this->_params['is_generalized']
				);
			}
		}
		protected function _writeLogIntoDatabase($content='',$type=1,$num=0,$isGeneralized=false){

			if(!$this->_isCanLog){
				return ERR::LOG_SERVER_UNAVAILABLE;
			}
			if($this->_isIgnoreLog){
				return ERR::LOG_CONFIG_NOT_LOG;
			}

			$this->_params['type']=$type;
			$this->_params['num']=$num;
			$this->_params['content']=$content;
			$this->_params['is_generalized']=$isGeneralized;

			return $this->_stmt->execute();

		}
	}