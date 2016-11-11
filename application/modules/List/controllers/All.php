<?php
	class AllController extends Core_Controller_Base{

		public function indexAction(){
			$productList=new Test_Model_Collection_Index_Productlist();

			$this->getView('content')->assign('productList',$productList->getIndexProductList());

			$this->renderView();
		}

	}