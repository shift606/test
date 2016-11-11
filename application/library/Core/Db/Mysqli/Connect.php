<?php
	class Core_Db_Mysqli_Connect extends Mysqli{
		private $_conf;
		public function __construct($db){
			$this->_conf=$db;
			parent::__construct(
				$this->_conf['server_name'],
				$this->_conf['username'],
				$this->_conf['password'],
				$this->_conf['database'],
				$this->_conf['port'],
				$this->_conf['socket']
			);
			$this->set_charset("utf8");
		}
		public function __destruct(){
			$this->close();
		}
		public function table($table){
			return $this->_conf['prefix'].$table;
		}
	}