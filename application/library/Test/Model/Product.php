<?php
	class Test_Model_Product extends Core_Model_Base{
		private $_mainTable='product';
		private $_data=[];
		protected function _getProductDataFromDatabase($id=null){
			if(isset($id)){
				$this->_data['id']=$id;
			}
			$stmt=$this->_con->prepare("SELECT `product_name` FROM {$this->_mainTable} WHERE `id`=? LIMIT 1");
			$stmt->bind_param('i',$this->_data['id']);
			$stmt->execute();
			$stmt->bind_result($this->_data['product_name']);
			$stmt->fetch();
		}
		public function __construct($id){
			parent::__construct();
			if(isset($id)){
				$this->_data['id']=$id;
				$this->_getProductDataFromDatabase();
			}
			$this->_mainTable=$this->_con->table($this->_mainTable);
		}
		public function getData($key){
			if(isset($key)){
				return $this->_data[$key];
			}
			return $this->_data;
		}
	}