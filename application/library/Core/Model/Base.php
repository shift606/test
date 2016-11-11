<?php
	class Core_Model_Base{
		protected $_con;
		protected $_fieldType=[
			'varchar'=>'s',
			'datetime'=>'s',
			'int'=>'i'
		];
		public function getFieldType($fieldName){
			return $this->_fieldType[$fieldName];
		}
		public function __construct($con='default'){
			$this->_con=Core_Db_Mysqli::getConn($con);
		}
	}