<?php

namespace application\admin\controller;

use \think\Controller;
use ROL\Auth\Auth;
use application\admin\model\Menu as MenuModel;
use think\Cache;

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
        session('user_auth.username', "admin");
        session("user.group_id", 1);
        if (session("uid") != 1) {
            $auth = new Auth();
            if (!$auth->check($this->request->module() . '/' . $this->request->controller() . '/' . $this->request->action(), session('uid'))) {
                $this->error("你没有权限");
            }
        }

//        $menus = Cache::get(session("user.group_id"));
//        if(!$menus){
//            $Menu = new MenuModel();
//            Cache::set(session("user.group_id"),$Menu->getMenu());
//            $menus = Cache::get(session("user.group_id"));
//        }
        $Menu = new MenuModel();
        $menus = $Menu->getMenu();
        $this->assign("_MENU_", $menus);
    }

    //前置操作
    protected $beforeActionList = [];

    public function _empty() {
        return "操作不存在";
    }

    /**
     * 默认index
     * @return type
     */
    public function index() {
        return $this->fetch();
    }

    /**
     * 
     */
    public function del() {
        
    }

    public function edit() {
        
    }

}
