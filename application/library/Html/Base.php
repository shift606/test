<?php
	class Html_Base extends Core_View_Simple{

		protected $_defaultBaseTpl='/Pub/base.phtml';

		public function __construct($view=null,$option=[]){
			if(!isset($view)){
				$view=VIEW_PATH.$this->_defaultBaseTpl;
			}
			parent::__construct($view,$option);
		}

		public function setBaseView($baseTplDir=null){
			if(isset($baseTplDir)){
				$this->_view->setScriptPath($baseTplDir);
			}
			$this->_view->setScriptPath(VIEW_PATH.$this->_defaultBaseTpl);
			return $this;
		}
	}