<?
	class Html_Page extends Core_View_Simple{
		protected $_defaultPageTpl='/Parts/page.phtml';
		public function __construct($view=null,$option=[]){
			if(!isset($view)){
				$view=VIEW_PATH.$this->_defaultPageTpl;
			}
			parent::__construct($view,$option);
		}
	}