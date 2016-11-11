<?php
class Core_Util_Config{

//single----------------------------


    private static $_instance;

    private function __construct(){
        if(!file_exists(CONF_PATH.'/all.ini')){
            //trigger_error('Configure file not exists!',E_USER_ERROR);
            /*
            todo:合并配置项
            */
            file_put_contents(CONF_PATH.'/all.ini', file_get_contents(CONF_PATH.'/application.ini'));
            file_put_contents(CONF_PATH.'/all.ini', PHP_EOL, FILE_APPEND);
            file_put_contents(CONF_PATH.'/all.ini', file_get_contents(CONF_PATH.'/base.ini'), FILE_APPEND);
            file_put_contents(CONF_PATH.'/all.ini', PHP_EOL, FILE_APPEND);
            file_put_contents(CONF_PATH.'/all.ini', file_get_contents(CONF_PATH.'/database.ini'), FILE_APPEND);
            file_put_contents(CONF_PATH.'/all.ini', PHP_EOL, FILE_APPEND);
        }

        $this->_iniConfig = new Yaf_Config_Ini(CONF_PATH.'/all.ini');
        $this->_arrConfig = new Yaf_Config_Simple([]);

    }

    public function __clone(){
        trigger_error("Class 'Core_Util_Config' is a Singleton,clone is not allow!",E_USER_ERROR);
        return self::getInstance();
    }

    public static function getInstance(){
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self;
        }
        return self::$_instance;
    }


//private---------------

    //主要变量
    private $_iniConfig;//application.ini文件中所标识的
    private $_arrConfig;//其他

//protected------------

//public---------------

    public function __get($arg){
        if(isset(self::$_instance->_arrConfig[$arg]))
            return self::$_instance->_arrConfig[$arg];
        if(isset(self::$_instance->_iniConfig[$arg]))
            return self::$_instance->_iniConfig[$arg];
        return null;
    }

    public function __set($k,$v){
        return self::$_instance->_arrConfig[$k]=$v;
    }

    public static function get($arg){
        return self::$_instance->__get($arg);
    }

    public static function set($k,$v){
        return self::$_instance->__set($k,$v);
    }
}