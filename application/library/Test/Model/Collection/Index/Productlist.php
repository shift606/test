<?php
	class Test_Model_Collection_Index_Productlist extends Core_Model_Collection_Base{
		protected $_fields=[
			'id'=>'id',
			'product_name'=>'product_name',
			'insert_time'=>'insert_time'
		];
		protected $_mainTable='product';
		protected $_page;
		private $_limit=' LIMIT 0,1000';
		public function __construct(){
			parent::__construct();
			$fields=implode(',',$this->_fields);
			$this->_mainTable=$this->_con->table($this->_mainTable);
			$this->initList("SELECT {$fields} FROM {$this->_mainTable}");
		}

		public function getIndexProductList(){
			if(!isset($this->_list['index_list'])){
				$this->_getIndexProductListFromDatabase();
			}
			return $this->_list['index_list'];
		}
		private function _getIndexProductListFromDatabase(){
			$this->_list['index_list']=[];
			$stmt=$this->_con->prepare($this->_sql." WHERE `is_available`=1 AND `is_delete`=0{$this->_limit}");
			extract($this->_fields);
			$stmt->execute();
			$stmt->bind_result(
				$id,
				$product_name,
				$insert_time
				);
			$stmt->store_result();
			while($stmt->fetch()){
				$arr=[];
				$arr['id']=$id;
				$arr['product_name']=$product_name;
				$arr['insert_time']=$insert_time;
				$this->_list['index_list'][]=$arr;
			}
		}
	}