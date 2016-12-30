<?php
class Model_List_Record extends Core_Model_Collection_Base{
    public function getList(){
        $conf=Core_Util_Config::getInstance();
        $client=new Core_Util_Curl();
        /*$list = $client->post($conf['model']['list']['getList'], [
            "InterfaceName" => "Intel",
            "FunctionName" => "func",
            "ReturnType" => "0001",
            "ReturnName" => "return",
            "ReturnTemplateId" => "dbkasbd",
            "ParaViewModels" => [
                ["ParaName" => "p1", "ParaType" => "0002", "ParaIndex" => "1"],
                ["ParaName" => "p1", "ParaType" => "0002", "ParaIndex" => "1"],
                ["ParaName" => "p1", "ParaType" => "0002", "ParaIndex" => "1"]
            ]
        ]);*/
        $list = $client->get($conf['model']['list']['getList']);
        if($list===false)return [];
        $list=json_decode(json_decode($list[1]));
        $ret=[];
        foreach($list as $v){
            $ret[]=['title'=>$v->InterfaceName];
        }
        return $ret;
    }
}