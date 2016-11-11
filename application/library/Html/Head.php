<?php
	class Html_Head extends Core_View_Simple{
		private $_css=[];
		private $_js=[];
		protected $_defaultHeadTpl='/Pub/head.phtml';

		private function _getSrcKey($src){
			$start=strripos($src,'/')+1;
			$length=$start-strripos($src,'.')-2;
			return substr($src,$start,$length);
		}
		private function _constructLinkTag($href,$par='',$opt=[]){
			$optArr=[];
			if(!isset($opt['rel'])){
				$opt['rel']='stylesheet';
			}
			foreach($opt as $k=>$v){
				$optArr[]=$k.'=\''.$v.'\'';
			}
			$optArr=implode(' ',$optArr);
			return "<link href='{$href}{$par}' {$optArr}>";
		}
		private function _constructScriptTag($src,$par='',$opt=[]){
			$optArr=[];
			foreach($opt as $k=>$v){
				$optArr[]=$k.'=\''.$v.'\'';
			}
			$optArr=implode(' ',$optArr);
			return "<script type='text/javascript' src='{$src}{$par}' {$optArr}></script>";
		}

		public function __construct($view=null,$option=[]){
			if(!isset($view)){
				$view=VIEW_PATH.$this->_defaultHeadTpl;
			}
			$this->addCss('/css/base.css','base');
			$this->addJs('/js/jquery.js','jquery');
			parent::__construct($view,$option);
		}

		public function addCss($src=null,$key=null,$par='',$cross=false,$option=[]){
			if($cross){
				$src=WEB_ROOT.$src;
			}
			if(isset($src)){
				if(!isset($key)){
					$key=$this->_getSrcKey($src);
				}
				$this->_css[$key]=$this->_constructLinkTag($src,$par,$option);
			}
			return $this;
		}

		public function addJs($src=null,$key=null,$par='',$cross=false,$option=[]){
			if($cross){
				$src=WEB_ROOT.$src;
			}
			if(isset($src)){
				if(!isset($key)){
					$key=$this->_getSrcKey($src);
				}
				$this->_js[$key]=$this->_constructScriptTag($src,$par,$option);
			}
			return $this;
		}

		public function removeCss($key=null){
			if(isset($key)){
				unset($this->_css[$key]);
			}
			else {
				$this->_css=[];
			}
		}

		public function removeJs($key=null){
			if(isset($key)){
				unset($this->_js[$key]);
			}
			else {
				$this->_js=[];
			}
		}

		public function render(){
			$this->assign('css',$this->_css);
			$this->assign('js',$this->_js);
			return parent::render();
		}
	}