<?php

namespace application\admin\controller;

use application\common\service\Meun;
use application\common\logic\AuthGroup;
use application\common\logic\AuthGroupAccess;
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
    public function index(Request $request) {
        $lists = AuthGroup::paginate($request->except("page"));
        $this->assign('lists', $lists);
        return $this->fetch();
    }
    
    /**
     * 	访问授权
     *  @param Request $request
     *  @return type
     */
    public function access(Request $request) {
        if($request->isPost()){
            $status_update = AuthGroup::updateAuthGroup($request->param("id"),  implode(",", $request->param("ids/a")));
            if($status_update){
                $this->error("更新成功");
            }else{
                $this->error("更新失败");
            }
        }
        $group_id = $request->param("group_id");
        $meun = new Meun();
        $result = $meun->selectByModuleGroupId($request->module(), $group_id);
        $this->assign("list", $result);
        $this->assign("info", ["id"=>  $group_id]);
        return $this->fetch();
    }
    
    
    /**
     * 用户授权
     * @param Request $request
     * @return type
     */
    public function user(Request $request) {
        $group_id = $request->param("group_id");
        $lists = AuthGroupAccess::paginate(["group_id"=>$group_id]);
        $this->assign("lists", $lists);
        $this->assign("group_id", $group_id);
        return $this->fetch();
    }
    
    /**
     * 给用户添加用户组
     * @return type
     */
    public function accessAdd(Request $reqesut) {
        
        if($reqesut->isPost()){
            $addToGroup = AuthGroup::addToAccess($reqesut->param());
            if($addToGroup){
                $this->success("添加成功","index");
            }else{
                $this->error("添加失败");
            }
        }
        
        $resultToGroup = AuthGroup::selectToAuthGroup();
        $this->assign("group_list", $resultToGroup);
        
        $resultToUserExcept = AuthGroup::selectToUserExcept();
        $this->assign("user_list", $resultToUserExcept);
        
        return $this->fetch();
    }
    
    /**
     * 权限管理-成员授权-删除
     * @param Request $reqesut
     */
    public function accessDel(Request $reqesut) {
        $uid = $reqesut->param("uid");
        $uid || $this->error("不存在参数uid");
        $delToAccess = AuthGroup::delToAccess($uid);
        if($delToAccess){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }
    
    
    /**
     * 权限管理-添加
     * @param Request $reqesut
     */
    public function add(Request $reqesut) {
        if($reqesut->isPost()){
            $authGroup = new AuthGroup();
            $addAuthGroup = $authGroup->addAuthGroup($reqesut->param());
            $this->opReturn($addAuthGroup);
        }
        return $this->fetch("edit");
    }
    
    /**
     * 权限管理-编辑
     * @param Request $reqesut
     * @return type
     */
    public function edit(Request $reqesut) {
        $id = $reqesut->param("id");
        if($reqesut->isPost()){
            $authGroup = new AuthGroup();
            $addAuthGroup = $authGroup->editAuthGroup($reqesut->param(),$id);
            $this->opReturn($addAuthGroup);
        }
        $authGroupGet = AuthGroup::get($id);
        $this->assign("info", $authGroupGet);
        return $this->fetch("edit");
    }
    
    /**
     * 权限管理-删除
     * @param Request $reqesut
     */
    public function del(Request $reqesut) {
        $delByIds = AuthGroup::delByIds($reqesut->param("id/a"),true);
        $this->opReturn($delByIds);
    }
    
    /**
     * 权限管理-成员授权-删除
     * @param Request $reqesut
     */
    public function userDel(Request $reqesut) {
        $delByIds = AuthGroupAccess::delByIds($reqesut->param("id/a"));
        $this->opReturn($delByIds);
    }
    
    /**
     * 权限管理-成员授权-添加
     * @param Request $request
     */
    public function userAdd(Request $request) {
       if($request->isPost()){
            $this->opReturn(AuthGroupAccess::create($request->param()));
       }
       
       $selectToAuthGroup = AuthGroup::selectToAuthGroup(null,$request->param('group_id'));
       $this->assign("group_list", $selectToAuthGroup);
       
       $meun = new Meun();
       $selectToUserExcept = $meun->selectToUserExcept();
       $this->assign("user_list", $selectToUserExcept);
       
       return $this->fetch();
    }
    
}
