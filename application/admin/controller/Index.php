<?php
namespace app\admin\controller;

class Index extends Com
{
    public function  __construct(){
        parent::__construct();
    }

    public function index(){
        $this->assign($this->_arr);
        return $this->fetch();
    }
}
