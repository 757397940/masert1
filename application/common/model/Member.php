<?php
namespace app\common\model;

use think\Config;
use think\Db;

class Member extends Common{
    /**
     * 获取用户
     * @param $uid
     * @return array|bool|\PDOStatement|string|\think|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getuser($uid){
        if (empty($uid)){
            return false;
        }
        $res = $this->alias("m")
            ->join("__AUTH_GROUP_ACCESS__ a", "m.uid=a.uid","left")
            ->field("m.*,a.group_id")
            ->where("m.uid=$uid")
            ->find();
        return $res;
    }
}