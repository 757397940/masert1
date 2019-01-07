<?php

return [
    'errcode' => [
        'success' => ['code' => 0, 'msg' => '操作成功'],
        'invalid_request' => ['code' => 40000, 'msg' => '不支持的请求方式'],
        'invalid_rules' => ['code' => 40001, 'msg' => '没有权限'],
        'invalid_public' => ['code' => 40002, 'msg' => '参数错误'],
        'invalid_login' => ['code' => 40003, 'msg' => '未登录'],
        'invalid_adminlogin' => ['code' => 40004, 'msg' => '没有登录后台权限'],
        'invalid_no_data' => ['code'=>40005, 'msg' => '没有数据'],
        'invalid_query' => ['code'=>40006, 'msg' => '查询失败'],
        'invalid_insert' => ['code'=>40007, 'msg' => '新增数据失败'],
        'invalid_update' => ['code'=>40008, 'msg' => '修改数据失败'],
        'invalid_delete' => ['code'=>40009, 'msg' => '删除数据失败'],
        'invalid_buy'    =>  ['code'=>40010, 'msg' => '未购买视频'],
        'server_abnormal'=>  ['code'=>50000, 'msg' => '服务器异常'],
    ]
];