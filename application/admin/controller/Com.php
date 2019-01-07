<?php
namespace app\admin\controller;

use app\common\controller\Base;
use think\facade\Config;
use think\facade\Session;

class Com extends Base{
    protected $USER;
    public function __construct(){
        parent::__construct();
        $this->USER =  Session::get('user');
        $prefix =  Config::get("database.prefix");
        if (!empty($this->USER['uid'])){
            $member = db("member")
                ->where("uid='{$this->USER['uid']}'")
                ->Field("real_name,nick_name,head_img,mobile,email,type,sign_time,sign_time_end,sign_pic,cardid,recom_success,recom_sum")
                ->find();
            foreach($member as $k=>$v){
                $this->USER[$k] = $v;
            }
        }
    }

//    $userinfo = db("auth_group")
//        ->alias()


}