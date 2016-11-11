<?php
	class InstallController extends Core_Controller_Base {
		public function indexAction() {
			if(file_exists(APP_PATH.'/install.ed')){
				$this->redirect('/index');
				exit;
			}
			else{
				file_put_contents(APP_PATH.'/install.ed','');
			}
			$this->renderView();
		}
	}