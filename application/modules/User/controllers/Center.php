<?php
	class CenterController extends Test_Controller_User_Center {

		public function indexAction() {
			$this->getView('left')->assign('idx','index');
			$this->renderView();
		}

	}