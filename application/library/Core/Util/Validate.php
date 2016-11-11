<?php
	class Core_Util_Validate{
		public static function preValidation($value){
			if (!is_string($value) && !is_int($value) && !is_float($value)) {
				return false;
			}
			return true;
		}
		public static function checkNum($value){
			return self::preValidation($value)&&preg_match('/^\d+$/',$value);
		}
		public static function checkLength($value,$min=0,$max=null){
			if(!self::preValidation($value)){
				return false;
			}
			$len=strlen($value);
			if($len<$min){
				return -1;
			}
			if(isset($max)&&($len>$max)){
				return -2;
			}
			return true;
		}
		//todo:以下未测试
		public static function checkEmailFormat($value){
			return self::preValidation($value)&&preg_match('/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/',$value);
		}
		public static function checkDateFormat($value){
			return self::preValidation($value)&&preg_match('/^(\d{4})-((0([1-9]{1}))|(1[1|2]))-(([0-2]([1-9]{1}))|(3[0|1]))$/',$value);
		}
		public static function checkNumAlpha_($value){
			return self::preValidation($value)&&preg_match('/^\w+$/',$value);
		}
		public static function checkUtf($value){
			return self::preValidation($value)&&preg_match('/^[\x00-\xff]*$/',$value);
		}
		public static function checkChinese($value){
			return self::preValidation($value)&&preg_match('/^[\x{4e00}-\x{9fa5}]*$/',$value);
		}
		public static function checkMobile($value){
			return self::preValidation($value)&&preg_match('/^1[3458]{1}\d{9}$/',$value);
		}
	}