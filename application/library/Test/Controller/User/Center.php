<?php
	class Test_Controller_User_Center extends Test_Controller_User{

		public function init(){
			if(!Tool::checkLogin()){
				$this->redirect('/user/entrance/login');
				exit;
			}

			parent::init();
			$this->_viewPath=MODULE_PATH.$this->_viewPath;
			$this->_views['left']=new Core_View_Simple($this->_viewPath.'/Pub/left.phtml');
			$this->_views['right']=new Core_View_Simple($this->_viewPath.'/Pub/right.phtml');
			$this->getView('left')->assign('idx',$this->getRequest()->controller);

			return $this;
		}

		public function renderView(){
			$this->_views['content']->assign('left',$this->_views['left']);
			$this->_views['content']->assign('right',$this->_views['right']);
			parent::renderView();
			return $this;
		}

		public function logoutAction(){
			$con=$this->getView('content');
			$con->tpl($this->_viewPath.'/Pub/interaction.phtml');
			$userModel=new Test_Model_User();
			$userModel->loadCurrent();
			if($userModel->logout($this->_request->getParams()[$_SESSION['current_user']['logout_key']])){
				$con->assign('tips','已退出登录');
			}
			else{
				$con->assign('tips','用户信息错误，无法退出登录');
			}
			$this->renderView();
		}
	}