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