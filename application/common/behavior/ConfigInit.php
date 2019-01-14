<?php
namespace app\common\behavior;
use think\facade\Request;

class ConfigInit{
    /**
     * @param Request $request
     * @param $params
     */
    public function run(Request $request,$params){
        //行为逻辑
        $setting = setting();
        foreach($setting as $k=>$v){
            config($k,$v);
        }
    }
}