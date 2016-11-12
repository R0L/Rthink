<?php

namespace application\admin\controller;

use application\admin\logic\AuthGroup;
use application\admin\model\AuthGroupAccess;
use think\Request;

/**
 * @author ROL
 * @date 2016-11-12 9:15:37
 * @version V1.0
 * @desc  权限管理控制器
 */
class AuthManager extends Admin {
    
    /**
     * 权限分组展示
     * @return type
     */
    public function index() {
        $AuthGroup = new AuthGroup();
        $lists = $AuthGroup->paginate();
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    /**
     * 	访问授权
     *  @param Request $request
     *  @return type
     */
    public function access(Request $request) {
        $AuthGroup = new AuthGroup();
        if($request->isPost()){
            $status_update = $AuthGroup->updateAuthGroup(input("param.id"),  implode(",", input("param.ids/a")));
            if($status_update){
                $this->error("更新成功");
            }else{
                $this->error("更新失败");
            }
        }
        $group_id = input("param.group_id");
        $result = $AuthGroup->selectByModuleGroupId($request->module(), $group_id);
        $this->assign("list", $result);
        $this->assign("info", ["id"=>  input("param.group_id")]);
        return $this->fetch();
    }
    
    
    /**
     * 用户授权
     * @param Request $request
     * @return type
     */
    public function user(Request $request) {
        $AuthGroupAccess = new AuthGroupAccess();
        $result = $AuthGroupAccess->where(["group_id"=>input("param.group_id")])->paginate();
        $this->assign("lists", $result);
        return $this->fetch();
    }
    
    /**
     * 给用户添加用户组
     * @return type
     */
    public function accessAdd(Request $reqesut) {
        
        if($reqesut->isPost()){
            $addToGroup = AuthGroup::addToGroup(input());
            if($addToGroup){
                $this->success("添加成功");
            }else{
                $this->error("添加失败");
            }
        }
        
        $resultToGroup = AuthGroup::selectToGroup();
        $this->assign("group_list", $resultToGroup);
        
        $resultToUserExcept = AuthGroup::selectToUserExcept();
        $this->assign("user_list", $resultToUserExcept);
        
        return $this->fetch();
    }
    
    public function accessDel() {
    }
}
