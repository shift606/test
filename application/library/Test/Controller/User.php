<?php
	class Test_Controller_User extends Core_Controller_Base{
		protected $_viewPath='/User/views/';
		private $_user;

		public function init(){
			parent::init();
			$this->_views['head']->addCss('/css/user.css')->addJs('/js/user.js');
		}
	}