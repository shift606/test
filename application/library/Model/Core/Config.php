<?php
	class Model_Core_Config extends Core_Model_Base{
		protected $_mainTable='config';
		protected $_fields=[
			'id'=>'id',
			'path'=>'path',
			'val'=>'val'
		];
		protected $_primary=['id'];
		protected static $_config=null;
		public function __construct(){
			parent::__construct();
			$this->_mainTable=$this->_con->table($this->_mainTable);
		}
		protected function _getConfigFromDatabase($path=null){
			$where=' WHERE 1';
			if(isset($path)){
				$where.=" AND `path`={$path}";
			}
			$rid=null;
			$rpath=null;
			$rval=null;
			$stmt=$this->_con->prepare("SELECT `id`,`path`,`val` FROM {$this->_mainTable} {$where}");
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($rid,$rpath,$rval);
			while($stmt->fetch()){
				self::$_config[$rpath]=['id'=>$rid,'value'=>$rval];
			}
		}

		public function getConfig($path=null){
			if(is_null(self::$_config)){
				self::_getConfigFromDatabase();
			}
			if(isset($path)){
				return self::$_config[$path];
			}
			return self::$_config;
		}

		public function updateConfig($path=null){
			$this->_getConfigFromDatabase($path);
			if(isset($path)){
				return self::$_config[$path];
			}
			return self::$_config;
		}
	}