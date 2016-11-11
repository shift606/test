<?php
	class Model_Core_Log extends Model_Log{
		public function __construct($con='log',$init=true){
			$this->_table='sys';
			parent::__construct($con);
		}
	}