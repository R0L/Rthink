<?php

namespace application\admin\controller;

use \think\Controller;
use ROL\Auth\Auth;
use application\common\logic\AuthGroup;
use application\common\logic\Config as ConfigLogic;
use application\common\model\Member;
use think\Config;
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
        
        empty($user_id) && $this->error("你还没有登录,请先登录！","common/login");
        
        $request = Request::instance();
        $user = Member::useGlobalScope(false)->get(["status"=>1,"id"=>$user_id]);
        $request->bind('user',$user);
        if($user->pid){
            $user = Member::useGlobalScope(false)->get(["status"=>1,"id"=>$user->pid]);
        }
        $request->bind('pubuser',$user);
        $request->bind('group_id',AuthGroup::getGroupIdByuid($user_id));
        
        if ($request->group_id != 1) {
            $auth = new Auth();
            if (!$auth->check($request->module() . '/' . $request->controller() . '/' . $request->action(), $user_id)) {
                $this->error("你没有权限");
            }
        }
        $menus = Cache::get($request->group_id);
        if(empty($menus)){
            Cache::set($request->group_id,AuthGroup::selectByModuleUserId($request->module(),$user_id));
            $menus = Cache::get($request->group_id);
        };
//        $menuParent = AuthGroup::getMenuParent($request->path());
        $menuParent = AuthGroup::getMenuParent($request->module() . '/' . $request->controller() . '/' . $request->action());
        
        $this->assign("_MP_", array_reverse($menuParent));
        $this->assign("_MENU_", $menus);
        
        Config::set(ConfigLogic::getConfig());
    }

    //前置操作
    protected $beforeActionList = [];

    public function _empty() {
        return "操作不存在";
    }
}
