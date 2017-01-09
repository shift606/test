<?php
class Core_Util_Curl{
    private $ch;
    public function __construct(){
        $this->ch=curl_init();
        curl_setopt($this->ch,CURLOPT_HEADER,1);            //是否显示头部信息
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 5);           //设置超时
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);      //跟踪301
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);        //返回结果
    }
    public function __destruct()
    {
        curl_close($this->ch);
    }

    protected function _throw($errNo=null){
        switch($errNo){
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
            case 10:
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
            case 22:
            case 23:
            case 24:
            case 25:
            case 26:
            case 27:
            case 28:
            case 29:
            case 30:
            case 31:
            case 32:
            case 33:
            case 34:
            case 35:
            case 36:
            case 37:
            case 38:
            case 39:
            case 40:
            case 41:
            case 42:
            case 43:
            case 44:
            case 45:
            case 46:
            case 47:
            case 48:
            case 49:
            case 50:
            case 51:
            case 52:
            case 53:
            case 54:
            case 55:
            case 56:
            case 57:
            case 58:
            case 59:
            case 60:
            case 61:
            case 62:
            case 63:
            case 64:
            case 65:
            case 66:
            case 67:
            case 68:
            case 69:
            case 70:
            case 71:
            case 72:
            case 73:
            case 74:
            case 75:
            case 76:
            case 77:
            case 78:
            case 79:
            case 80:
                throw new Exception(Err::getMsg(Err::COMMUNICATION_FAILURE));
            case null:
            default:
                throw new Exception(Err::getMsg(Err::DEFAULT_ERROR));
        }
    }

    public function get($url){
        curl_setopt($this->ch, CURLOPT_URL, $url);
        $response = curl_exec($this->ch);
        $errno=curl_errno($this->ch);
        if($errno){
            $this->_throw($errno);
        }
        if (curl_getinfo($this->ch, CURLINFO_HTTP_CODE) == '200') {
            return explode("\r\n\r\n", $response, 2);
        }else{
            $this->_throw(28);
        }
        return '';
    }

    public function post($url,$postData=[]){
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS,http_build_query($postData));
        $response = curl_exec($this->ch);
        $errno=curl_errno($this->ch);
        if($errno){
            $this->_throw($errno);
        }
        if (curl_getinfo($this->ch, CURLINFO_HTTP_CODE) == '200') {
            return explode("\r\n\r\n", $response, 2);
        }else{
            $this->_throw(28);
        }
        return '';
    }
}