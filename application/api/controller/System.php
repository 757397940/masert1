<?php
namespace app\api\controller;
use think\Controller;

class System extends Controller{
    protected $middleware = ['Check'];


    /**
     * 发送短信
     */
    public function sendMobile(){
        $ajaxdata = apierror("success");
        switch (strtolower($this->request->method())){
            case'post':
                $mobile = input("mobile","");
                $type = input("type",1);

                $uid = $this->request->USER['uid'];

                //图形验证码验证
                if ($type == 3){
                    $captcha = input("captcha","");
                    if(!captcha_check($captcha)){
                        $ajaxdata = apierror("invalid_public","图形验证码错误");
                        break;
                    }
                };

                //手机号是否填写验证
                if (!$mobile){
                    $ajaxdata = apierror("invalid_public","手机号不能为空");
                    break;
                }

                //手机号格式
                $ismobile = preg_match("/(^1[3,4,5,7,8]{1}[0-9]{9}$)/",$mobile);
                if ($ismobile){
                    $ajaxdata = apierror("invalid_public","手机号格式错误");
                    break;
                }

                $MemberVerifyModel = new \app\common\model\MemberVerify();
                $res = $MemberVerifyModel->addData($mobile, intval($type),intval($uid));
                if ($res === false){
                    $ajaxdata = apierror("invalid_public",$MemberVerifyModel->getError());
                    break;
                }
                break;
            default:
                $ajaxdata  = apierror("invalid_request");
                break;
        }
        return json($ajaxdata());
    }
}