<?php
/**
 * 返回api错误信息
 */
function apierror($errname, $msg = ''){
    $errcode = config("errcode");
    $error = [
        'errcode'=>$errcode[$errname]['code'],
        'errmsg'=>!empty($msg) ? $msg : $errcode[$errname]['msg'],
        'time'=>time()
    ];
    return $error;
}

function setting($k=''){
    $settingModel = db("setting");
    $config = [];
    if($k==''){
        $setting  = $settingModel->field("k,v")->select();
        foreach($setting as $k=>$v){
            $config[$v['k']] = $v['v'];
        }
        return $config;
    }else{
        $resulf = $settingModel->where("k={$k}")->find();
        return $result['v'];

    }
}