<?php

namespace application\admin\controller;

use application\common\controller\Common;
use ROL\Auth\Auth;
use application\common\service\Meun;
use application\common\service\Member;
use application\common\api\Config as ConfigApi;
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
class Admin extends Common {

    //初始化
    public function _initialize() {
        $user_id = Session::get('user_id');
        empty($user_id) && $this->error("你还没有登录,请先登录！","common/login");
        $meun = new Meun();
        $member = new Member();
        
        $request = Request::instance();
        
        $user = $member->getMemberById($user_id);
        $request->bind('user',$user);
        if($user->pid){
            $user = $member->getMemberById($user->pid);
        }
        $request->bind('pubuser',$user);
        $request->bind('group_id',$meun->getGroupIdByuid($user_id));
        
        if ($request->group_id) {
            $auth = new Auth();
            if (!$auth->check($request->module() . '/' . $request->controller() . '/' . $request->action(), $user_id)) {
                $this->error("你没有权限");
            }
        }
        
        $menus = Cache::remember($request->group_id, function (){
            $meun = new Meun();
            $request = Request::instance();
            return $meun->selectByModule($request->module(),$request->user->id);
        });
//        $menus = Cache::get($request->group_id);
//        if(empty($menus)){
//            Cache::set($request->group_id,$meun->selectByModuleUserId($request->module(),$user_id));
//            $menus = Cache::get($request->group_id);
//        };
        $menuParent = $meun->getMenuParent($request->module() . '/' . $request->controller() . '/' . $request->action());
        
        $this->assign("_MP_", array_reverse($menuParent));
        $this->assign("_MENU_", $menus);
        
        //加载所有的配置文件
        Config::set(ConfigApi::lists());
    }

    //前置操作
    protected $beforeActionList = [];

    public function _empty() {
        return "操作不存在";
    }
    
    /**
     * 全局操作
     * @param type $opResult
     */
    protected function opReturn($opResult = false,$refreshUrl="index"){
        if($opResult){
            $this->success("操作成功",$refreshUrl);
        }
        $this->error("操作失败");
    }
}
