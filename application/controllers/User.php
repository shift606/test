<?php
	class UserController extends Core_Controller_Base {
		public function indexAction() {
			$this->redirect('/user/center/index');
			exit;
		}
	}