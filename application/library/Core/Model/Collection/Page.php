<?
	class Core_Model_Collection_Page{
		private $_per=10;
		private $_maxPagesLimited=1000;
		private $_pages=[
			'first'=>0,
			'prev'=>0,
			'current'=>0,
			'next'=>0,
			'last'=>0
		];
		public function __construct($per,$max){
			if(isset($per)){
				$this->_per=$per;
			}
			if(isset($max)){
				$this->_maxPagesLimited=$max;
			}
		}

		public function getPage($mode='current'){
			return $this->_pages[$mode];
		}
		public function getCount($mode='current'){
			return $this->_pages[$mode]*$this->_per;
		}
		public function getLimitString($mode='current'){
			return " LIMIT {$this->getCount($mode)},{$this->_per}";
		}
		public function getPageView(){
			return new Html_Page();
		}
	}