<?php

namespace application\admin\controller;
use \think\Controller;
use ROL\Auth\Auth;

/**
 * @author ROL
 * @date 2016-10-29 11:46:29
 * @version V1.0
 * @desc   
 */
class Admin extends Controller {

    //初始化
    public function _initialize() {
        session("uid", 1);
        $auth = new Auth();
        if (!$auth->check($this->request->module() . '/' . $this->request->controller() . '/' . $this->request->action(), session('uid'))) {
            $this->error("你没有权限");
        }
    }

    //前置操作
    protected $beforeActionList = [];

    public function _empty() {
        return "操作不存在";
    }

}
