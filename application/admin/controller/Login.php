<?php
namespace app\admin\controller;


use app\common\controller\Base;
use think\Request;
use think\Db\Where;

class Login extends Base{
    public function index(){
//        $this->assign();
        return $this->fetch();
    }


    //注册
    public function register(){
        $membermodel = new \app\common\model\Member();
        $codemodel  = new \app\common\model\Code();
        $M_Group = new \app\common\model\AuthGroup();

        //获取角色组
        $where = new Where;
        $where['id'] = ['notin',"1,12"];
        $group = $M_Group->where($where)->order("id",'asc')->select();
        foreach($group as $k=>$v){
            if ($v['title']=="企业方人员"){
                $group[$k]['title'] = "我要招聘";
            }
            if ($v['title']=="求职者"){
                $group[$k]['title'] = "我要求职";
            }
            if($v['title']=="外协部"){
                $group[$k]['title'] = "我要推荐";
            }
        }

        $this->_arr['group'] = $group;
        $this->_arr['type'] = input("type");
        $this->_arr['invitecode'] = input("invitecode");//邀请码
        $refer_uid = $codemodel->getUid($this->_arr['invitecode']);//推荐人
        if ($refer_uid){
            $member = $membermodel->getuser($refer_uid);
            if($member['group_id']==8){
                //求职者推荐
                $group_id = 8;
            }elseif($member['group_id']==11 && $member['type']==2){
                //招聘经纪人推荐
                $group_id = 8;
            }elseif($member['group_id']==11 && $member['type']==1){
                //项目合伙人推荐
                $group_id = 10;
            }elseif($member['group_id']==10){
                //企业推荐
                $group_id = 10;
            }else{
                $group_id = 0;
            }
            $this->_arr['group_id'] = $group_id;
        }
        $this->assign($this->_arr);
        return $this->fetch();
    }
}
