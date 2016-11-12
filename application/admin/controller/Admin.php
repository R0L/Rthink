<?php

namespace application\admin\controller;

use \think\Controller;
use ROL\Auth\Auth;
use application\admin\logic\AuthGroup;
use application\admin\model\Member;
use think\Cache;
use think\Session;
use think\Request;

/**
 * @author ROL
 * @date 2016-10-29 11:46:29
 * @version V1.0
 * @desc   
 */
class Admin extends Controller {

    //初始化
    public function _initialize() {
        $user_id = Session::get('user_id');
        $request = Request::instance();
        $request->bind('user',Member::get($user_id));
        
        if ($user_id != 2) {
            $auth = new Auth();
            if (!$auth->check($request->module() . '/' . $request->controller() . '/' . $request->action(), $user_id)) {
                $this->error("你没有权限","common/login");
            }
        }
//        $menus = Cache::get(session("user.group_id"));
//        if(!$menus){
//            $Menu = new MenuModel();
//            Cache::set(session("user.group_id"),$Menu->getMenu());
//            $menus = Cache::get(session("user.group_id"));
//        }
        $AuthGroup = new AuthGroup();
        $menus = $AuthGroup->selectByModule();
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
