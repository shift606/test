<?php
	class ListController extends Core_Controller_Base{
		public function indexAction() {
			$this->redirect('/list/all/index');
			exit;
		}
	}