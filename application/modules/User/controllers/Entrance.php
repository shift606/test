<?php
	class EntranceController extends Test_Controller_User_Entrance {

		public function indexAction() {
			$this->renderView();
		}

		public function loginAction(){
			$this->setBaseView('');
			$this->renderView();
		}

		public function registerAction(){

			$this->renderView();
		}

		public function loginpostAction(){
			$con=$this->getView('content');
			$con->tpl($this->_viewPath.'/Pub/interaction.phtml');
			$mobile=intval($_POST['mobile']);
			$permanent=isset($_POST['permanent'])?$_POST['permanent']:null;
			$permanent=($permanent=='7')?7:null;
			if(!$mobile){
				$con->assign('tips',Err::getMsg(Err::USER_INFO_MOBILE_IS_NULL));
			}else{
				$passwd=$_POST['passwd'];
				$userModel=new Test_Model_User();
				$result=$userModel->loginByForm($mobile,$passwd,$permanent);
				if($result===true){
					$con->assign('tips','成功登录');
				}
				else{
					$con->assign('tips',Err::getMsg($result));
				}
			}
			$this->renderView();
		}

		public function registerpostAction(){
			$con=$this->getView('content');
			$con->tpl($this->_viewPath.'/Pub/interaction.phtml');
			$mobile=intval($_POST['mobile']);
			if(!$mobile){
				$con->assign('tips',Err::getMsg(Err::USER_INFO_MOBILE_IS_NULL));
			}else{
				$passwd=$_POST['passwd'];
				$userModel=new Test_Model_User();
				$result=$userModel->createUser($mobile,$passwd);
				if($result===true){
					$userModel->login();
					$con->assign('tips','成功注册');
				}
				else if($result===false){
					$con->assign('tips',Err::getMsg());
				}else{
					$con->assign('tips',Err::getMsg($result));
				}
			}
			$this->renderView();
		}

	}