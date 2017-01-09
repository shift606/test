<?php
	class AllController extends Core_Controller_Base{

		public function indexAction(){
			$this->addCss('/css/record.css');
			$model=new Model_List_Record();
			$list=$model->getList();

			$this->getView('content')->assign('list',$list);

			$this->renderView();
		}

	}