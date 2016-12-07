<?php
class Core_Util_Curl{
    private $ch;
    public function __construct(){
        $this->ch=curl_init();
        curl_setopt($this->ch,CURLOPT_HEADER,1);            //是否显示头部信息
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 5);           //设置超时
        curl_setopt($this->ch, CURLOPT_USERAGENT, _USERAGENT_);   //用户访问代理 User-Agent
        curl_setopt($this->ch, CURLOPT_REFERER, _REFERER_);        //设置 referer
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);      //跟踪301
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);        //返回结果
    }
    public function __destruct()
    {
        curl_close($this->ch);
    }

    public function get($url){
        curl_setopt($this->ch, CURLOPT_URL, $url);
        return curl_exec($this->ch);
    }

    public function post($url,$postData=[]){
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS,http_build_query($postData));
        return curl_exec($this->ch);
    }
}