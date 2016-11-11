<?php
	class Core_Controller_Admin_Base extends Core_Controller_Base{
		public function init(){
			if(!isset($_SESSION['admin_admit'])||$_SESSION['admin_admit']!==true){
				$this->redirect('/error');
				exit;
			}
			return parent::init();
		}
	}