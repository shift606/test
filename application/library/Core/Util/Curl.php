<?php
class Core_Util_Curl{
    private $curl;
    public function __construct(){
        $this->curl=curl_init();
        curl_setopt($this->curl,CURLOPT_HEADER,1);            //是否显示头部信息
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 5);           //设置超时
        curl_setopt($this->curl, CURLOPT_USERAGENT, _USERAGENT_);   //用户访问代理 User-Agent
        curl_setopt($this->curl, CURLOPT_REFERER, _REFERER_);        //设置 referer
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, 1);      //跟踪301
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);        //返回结果
    }
    public function __destruct()
    {
        curl_close($this->curl);
    }

}