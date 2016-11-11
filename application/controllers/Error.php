<?php
	class ErrorController extends Core_Controller_Base {
		public function errorAction($exception) {//默认Action
			$this->getView('content')
				->setTpl(VIEW_PATH.'/Error/error.phtml')
				->assign("exceptionObject",$exception);
			$this->renderView();
		}
	}