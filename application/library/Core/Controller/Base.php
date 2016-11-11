<?php
	class Core_Controller_Base extends Yaf_Controller_Abstract{

		protected $_views=[];

		public function init(){
			$req=$this->getRequest();
			$this->_view=new Html_Base();
			$this->_views['content']=new Core_View_Simple(MODULE_PATH.'/'.$req->module.'/views/'.$req->controller.'/'.$req->action.'.phtml');
			$this->_views['head']=new Html_Head();
			$this->_views['header']=new Core_View_Simple(VIEW_PATH.'/Pub/header.phtml');
			$this->_views['footer']=new Core_View_Simple(VIEW_PATH.'/Pub/footer.phtml');
			return $this;
		}

		public function getView($key=null){
			if(isset($key)){
				return $this->_views[$key];
			}
			else{
				return $this->_view;
			}
		}

		public function addCss($src=null,$key=null,$par='',$cross=false){
			$this->_views['head']->addCss($src,$key,$par,$cross);
			return $this;
		}

		public function addJs($src=null,$key=null,$par='',$cross=false){
			$this->_views['head']->addJs($src,$key,$par,$cross);
			return $this;
		}

		public function removeCss($key=null){
			$this->_views['head']->removeCss($key);
			return $this;
		}

		public function removeJs($key=null){
			$this->_views['head']->removeJs($key);
			return $this;
		}

		public function setBaseView($base_tpl_dir=null){
			return $this->_view->setBaseView($base_tpl_dir);
		}

		public function renderView(){
			$this->_view->assign("head", $this->_views['head']);
			$this->_view->assign("body_attr", '');
			$this->_view->assign("header", $this->_views['header']);
			$this->_view->assign("content", $this->_views['content']);
			$this->_view->assign("footer", $this->_views['footer']);
			return $this;
		}

	}