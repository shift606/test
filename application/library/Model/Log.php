<?php
	class Model_Log extends Model_Log_Interface{
		public function log($content='',$type=1,$num=0,$isGeneralized=false){
			return $this->_writeLogIntoDatabase($content,$type,$num,$isGeneralized);
		}
	}