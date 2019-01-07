<?php
namespace app\common\model;

class Code extends Common{

    /**
     * @功能 根据邀请码获取用户
     * @param string $code 邀请码
     * @return bool
     */
    public function getUid($code=""){
        if (!empty($code)){
            $r = $this->where("code='{$code}'")->find();
            if (empty($r)){
                $this->error = "邀请码错误";return false;
            }
            return $r['uid'];//直接返回属于的用户编码
        }
        return true;
    }

}