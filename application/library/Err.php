<?php
	class Err{
		const DEFAULT_ERROR=                    100000;
		const HAD_BEEN_INSTALLED=               101001;
		//VIEW              2
		//  TEMPLATE        01
		//
		const VIEW_TEMPLATE_NO_EXIST=           201001;
		//USER              3
		//  INFO            01
		//
		const USER_INFO_MOBILE_IS_NULL=         301101;
		const USER_INFO_MOBILE_WRONG_FORMAT=    301102;
		const USER_INFO_PASSWORD_UNKNOW=        301200;
		const USER_INFO_PASSWORD_IS_NULL=       301203;
		const USER_INFO_PASSWORD_TOO_SHORT=     301204;
		const USER_INFO_PASSWORD_TOO_LONG=      301205;
		const USER_INFO_EMAIL_WRONG_FORMAT=     301301;
		const USER_INFO_IS_EXIST=               301401;
		const USER_INFO_IS_NOT_EXIST=           301402;
		const USER_INFO_ID_IS_NULL=             301403;
		//  LOGIN           02
		const USER_LOGIN_ERROR=                 302100;
		const USER_MOBILE_IS_NOT_EXIST=         302101;
		const USER_PASSWORD_IS_INCORRECT=       302102;

		//LOG               4
		const LOG_DEFAULT_ERROR=                400000;
		//  SERVER
		const LOG_SERVER_UNAVAILABLE=           401001;
		//  CONFIG
		const LOG_CONFIG_NOT_LOG=               402001;

		private static $_errorMsg=[
			self::DEFAULT_ERROR=>'未知错误',
			self::HAD_BEEN_INSTALLED=>'已安装',

			self::VIEW_TEMPLATE_NO_EXIST=>'用户视觉模板不存在',

			self::USER_INFO_MOBILE_IS_NULL=>'手机号码为空',
			self::USER_INFO_MOBILE_WRONG_FORMAT=>'手机号码格式有误',
			self::USER_INFO_PASSWORD_UNKNOW=>'密码未知错误',
			self::USER_INFO_PASSWORD_IS_NULL=>'密码为空',
			self::USER_INFO_PASSWORD_TOO_SHORT=>'密码过短',
			self::USER_INFO_PASSWORD_TOO_LONG=>'密码过长',
			self::USER_INFO_EMAIL_WRONG_FORMAT=>'电子邮件地址格式有误',
			self::USER_INFO_IS_EXIST=>'用户信息已存在',
			self::USER_INFO_IS_NOT_EXIST=>'用户信息不存在',
			self::USER_INFO_ID_IS_NULL=>'用户ID为空',
			self::USER_LOGIN_ERROR=>'登录错误',
			self::USER_MOBILE_IS_NOT_EXIST=>'手机号不存在',
			self::USER_PASSWORD_IS_INCORRECT=>'密码错误',
			self::LOG_DEFAULT_ERROR=>'日志未知错误',
			self::LOG_SERVER_UNAVAILABLE=>'日志服务器不可用',
			self::LOG_CONFIG_NOT_LOG=>'该次日志记录已忽略'
		];

		public static function error($err_no=100000){
			return $err_no;
		}

		public static function getMsg($err_no=100000){
			return self::$_errorMsg[$err_no];
		}
	}