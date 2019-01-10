<?php
namespace app\common\model;

class MemberVerify extends Common{
    /**
     * 操作验证码数据
     * @param string $mobile 手机号码
     * @param int $type 1注册，2找回密码，3更换绑定 4验证登录
     * @param int $uid
     */
    public function addData($mobile='',$type = 1, $uid = 0){
        if(!$mobile){
            $this->error = "手机号不能为空";
            return false;
        }
        $where = array();
        $where['mobile'] = $mobile;
        $where['status'] = 0;
        $where['type'] = $type;
        if($uid){
            $where['uid'] = $uid;
        }
        $data = array();
        $info = $this->where($where)->find();


    }
}