<?php
	class Test_Controller_User_Entrance extends Test_Controller_User{

		public function init(){
			if(Tool::checkLogin()){
				$this->redirect('/user/center/index');
				exit;
			}

			parent::init();
			$this->_viewPath=MODULE_PATH.$this->_viewPath;

			return $this;
		}

	}