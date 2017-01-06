<?php
	class IndexController extends Core_Controller_Base {

		public function indexAction() {
			$req=$this->getRequest();
			$req->getQuery();
			$this->renderView();
		}

	}