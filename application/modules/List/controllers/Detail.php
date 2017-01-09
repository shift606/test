<?php
class DetailController extends Core_Controller_Base{

    public function indexAction(){
        $model=new Model_List_Record();
        $one=$model->getOne();
        $this->addCss('/css/record.css');
        $view=$this->getView('content');
        $view->assign('one',$one);

        $this->renderView();
    }

}