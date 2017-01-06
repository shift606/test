<?php
	class AllController extends Core_Controller_Base{

		public function indexAction(){
			$req=$this->getRequest();
			$req->getQuery();

			$model=new Model_List_Record();
			$list=$model->getList();

			$this->getView('content')->assign('list',$list);

			$this->renderView();
		}

	}