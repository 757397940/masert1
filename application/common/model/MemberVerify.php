<?php
namespace app\common\model;

use think\Config;
use think\Request;

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
        if ($info['sendnum']>=5){
            $this->error = "你已经连续超过5次发送了,该号码已禁用，请联系管理员";
            return false;
        }
        if ($info){
            //修改数据
            $data['dateline'] = time();
            $data['code'] = $this->getCode();
            $data['regip'] = Request::instance()->ip();
            $r = $this->save($data,$where);
            if($r){
                $id = $info['id'];
            }
        }else{
            //新增数据
            $date['uid'] = $uid;
            $date['mobile'] = $mobile;
            $data['dateline'] = time();
            $data['code'] = $this->getCode();
            $data['regip'] = Request::instance()->ip();
            $data['type']  = $type;
            $id = $this->insertGetId($data);
        }

        if ($type==1){
            $content = "您正在注册您正在注册凌晨科技移动办公平台用户，验证码".$data['code']."。5分钟之内有效，感谢您的支持!";
        }elseif($type==3){
            $content = "您正在更改绑定凌晨科技移动办公平台用户手机号码，验证码".$data['code']."。5分钟之内有效，感谢您的支持！";
        }else{
            $content = "您正在修改密码，验证码".$data['code']."。5分钟之内有效，感谢您的支持！";
        }
        $post_data = array();
        $post_data['account'] = Config::get('SEN_MOBILE_ACCOUNT');

    }

    //获取验证码
    public function getCode(){
        return rand(1000,9999);
    }
}