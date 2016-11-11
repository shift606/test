<?php
	class Core_View_Simple{

		protected $_view;

		public function __construct($view=0,$option=[]){
			if($view instanceof Yaf_View_Simple)
				$this->_view=$view;
			else
				$this->_view=new Yaf_View_Simple($view,$option);
		}

		public function display($tpl,$option=[]){
			$this->_view->display($tpl,$option);
		}

		public function render($tpl=null){
			$path=$this->getScriptPath();
			if(isset($tpl)){
				if(is_file($tpl)){
					return $this->_view->render($tpl);
				}
				if(file_exists($path)){
					$originalTpl=$path.$tpl;
					if(is_file($originalTpl)){
						return $this->_view->render($originalTpl);
					}
				}
				if(is_file($path)){
					return $this->_view->render($path);
				}
			}
			if(is_file($path)){
				return $this->_view->render($path);
			}
			return Err::error(Err::VIEW_TEMPLATE_NO_EXIST);
		}

		public function setScriptPath($tpl){
			return $this->_view->setScriptPath($tpl);
		}
		public function setTpl($tpl){//same as:$this->setScriptPath()
			return $this->_view->setScriptPath($tpl);
		}

		public function getScriptPath(){
			return $this->_view->getScriptPath();
		}
		public function getTpl(){//same as:$this->getScriptPath()
			return $this->_view->getScriptPath();
		}

		public function tpl($tpl=null){
			if(isset($tpl)){
				return $this->_view->setScriptPath($tpl);
			}
			return $this->_view->getScriptPath();
		}

		public function assign($key,$value=null){
			$this->_view->assign($key,$value);
			return $this;
		}
	}