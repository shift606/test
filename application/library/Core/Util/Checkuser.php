<?php
	class Core_Util_Checkuser{
		public static function is_login(){
			if(is_array($_SESSION['current_user'])&&count($_SESSION['current_user'])){
				return true;
			}
			return false;
		}
	}