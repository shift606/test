<?php
	define("APP_PATH"   ,   realpath(dirname(__FILE__) . '/../')); /* 指向public的上一级 */
	define("CONF_PATH"   ,   APP_PATH.'/conf');
	define("VIEW_PATH"  ,   APP_PATH.'/application/views');
	define("MODULE_PATH"  ,   APP_PATH.'/application/modules');
	define("LIB_PATH"   ,   APP_PATH.'/application/library');
	define("WEB_ROOT"   ,   '/');
	error_reporting(E_ALL^E_STRICT);
	$app  = new Yaf_Application(APP_PATH . "/conf/application.ini");
	$app->bootstrap()->run();