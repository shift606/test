<?php
	class Core_Model_Collection_Base extends Core_Model_Base{
		protected $_list=[];
		protected $_sql;

		public function initList($sql){
			$this->_sql=$sql;
		}

		public function getList($key=null){
			if(isset($key)){
				return $this->_list[$key];
			}
			else{
				return $this->_list;
			}
		}

		//public function _getListFromDatabase(){}

	}