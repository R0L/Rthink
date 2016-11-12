<?php

namespace application\admin\logic;
use application\admin\model\AuthGroup as AuthGroupModel;
use application\admin\model\AuthRule;
use application\admin\model\AuthGroupAccess;
use application\admin\model\Member;
use application\common\model\Tree;

/**
 * @author ROL
 * @date 2016-11-12 9:45:54
 * @version V1.0
 * @desc   
 */
class AuthGroup extends AuthGroupModel {
    
    /**
     * 更新权限组表
     * @param type $id
     * @param type $rules
     * @return type
     */
    public function updateAuthGroup($id,$rules) {
        return AuthGroupModel::update(["rules"=>$rules],["id"=>$id]);
    }
    
    
     /**
     * 通过$module，$userId返回AuthRule
     * @param type $module
     * @return type
     */
    public function selectByModule($module=null,$userId = null) {
        $map =  [];
        $module&&$map["module"] = $module;
        $Tree = new Tree();
        
        $authRuleAll = AuthRule::all($map);
        if($userId){
            $authGroupAccess = AuthGroupAccess::get(["uid"=>$userId]);
            $authGroup = AuthGroupModel::get($authGroupAccess->group_id);
            foreach ($authRuleAll as $authrule) {
                $bflag = false;
                if( in_array($authrule->id, explode(",",$authGroup->rules)) ){
                    $bflag = true;
                }
                $authrule->data("checked",$bflag)->append("checked");
            }
        }
        return $Tree->toTree($authRuleAll);
    }
     /**
     * 通过$module，$groupId返回AuthRule
     * @param type $module
     * @return type
     */
    public function selectByModuleGroupId($module=null,$groupId = null) {
        $map =  [];
        $module&&$map["module"] = $module;
        $Tree = new Tree();
        
        $authRuleAll = AuthRule::all($map);
        if($groupId){
            $authGroup = AuthGroupModel::get($groupId);
            foreach ($authRuleAll as $authrule) {
                $bflag = false;
                if( in_array($authrule->id, explode(",",$authGroup->rules)) ){
                    $bflag = true;
                }
                $authrule->data("checked",$bflag)->append("checked");
            }
        }
        return $Tree->toTree($authRuleAll);
    }
    
    
    /**
     * 查询AuthGroupAccess数据
     * @param type $GroupId
     * @return type
     */
    public function selectToAccess($GroupId = null) {
        $map = [];
        $GroupId && $map["group_id"] = $GroupId;
        return AuthGroupAccess::all($map);
    }
    
    /**
     * 查询AuthGroup数据
     * @param type $id
     * @return type
     */
    public function selectToGroup($id = null) {
        $map = [];
        $id && $map["id"] = $id;
        return AuthGroup::all($map);
    }
    
    /**
     * 查询AuthGroupAccess数据的UID数组
     * @return type
     */
    public function selectToUserExcept() {
        return Member::all(AuthGroupAccess::where(true)->column('uid'));
    }
    
    /**
     * 添加user到GROUP
     * @param type $data
     * @return type
     */
    public function addToGroup($data) {
        return AuthGroup::create($data);
    }
    
}
