<?php

namespace application\common\logic;
use application\common\model\AuthGroup as AuthGroupModel;
use application\common\model\AuthRule;
use application\common\model\AuthGroupAccess;
use application\common\model\Member;
use application\common\model\Tree;

/**
 * @author ROL
 * @date 2016-11-12 9:45:54
 * @version V1.0
 * @desc   
 */
class AuthGroup extends AuthGroupModel{
    
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
    public static function selectByModule($module=null,$userId = null,$rules = null,$isMenu = true) {
        $map =  [];
        $module&&$map["module"] = $module;
        $rules&&$map["id"] = ["in",$rules];
        $isMenu && $map["is_menu"] = 1;
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
     * 返回用户的菜单列表
     * @param type $module
     * @param type $userId
     * @return boolean
     */
    public static function selectByModuleUserId($module=null,$userId = null) {
        $rulesByuidToGroup = self::getRulesByuidToGroup($userId);
        if(empty($rulesByuidToGroup)){
            return false;
        }
        return self::selectByModule($module,$userId,$rulesByuidToGroup);
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
    public static function selectToGroup($id = null) {
        $map = [];
        $id && $map["id"] = $id;
        return AuthGroupModel::all($map);
    }
    
    /**
     * 查询还没有绑定用户权限组的用户list
     * @return type
     */
    public static function selectToUserExcept() {
        $map = [];
        $column = AuthGroupAccess::where(true)->column('uid');
        if(!empty($column)){
            $map["id"] = ["not in",$column];
        }
        return Member::all($map);
    }
    
    /**
     * 添加user到GROUP
     * @param type $data
     * @return type
     */
    public static function addToGroup($data) {
        return AuthGroup::create($data);
    }
    
    /**
     * 添加uid和group_id到group_access
     * @param type $data
     * @return type
     */
    public static function addToAccess($data) {
        return AuthGroupAccess::create($data);
    }
    
    /**
     * 根据uid删除group_access
     * @param type $uid
     * @return type
     */
    public static function delToAccess($uid) {
        return AuthGroupAccess::destroy(["uid"=>$uid]);
    }
    
    
    /**
     * 根据id返回auth_group的rules栏目
     * @param type $id
     * @return type
     */
    public static function getRulesToGroup($id) {
        return AuthGroup::get($id)->value("rules");
    }
    
    /**
     * 根据uid返回auth_group的rules栏目
     * @param type $uid
     * @return type
     */
    public static function getRulesByuidToGroup($uid) {
        $group_id = AuthGroupAccess::get(["uid"=>$uid])->value("group_id");
        if(empty($group_id)){
            return false;
        }
        return self::getRulesToGroup($group_id);
    }
    
    /**
     * 根据uid返回group_access中的group_id
     * @param type $uid
     * @return type
     */
    public static function getGroupIdByUid($uid) {
        return AuthGroupAccess::get(["uid"=>$uid])->value("group_id");
    }
    
    
    /**
     * 根据id/name获得AuthRule
     * @param type $id
     * @param type $isName
     * @return type
     */
    public static function getAuthRule($id = NULL,$isName=false) {
        $map = [];
        if($isName){
            $map["name"] = $isName;
        }else if(is_numeric($id)){
            $map["id"] = $id;
        }else if(is_string($id)){
            $map["name"] = $id;
        }
        return AuthRule::get($map);
    }
    
    /**
     * 返回当前菜单的上级
     * @param type $name
     * @param type $pid
     * @return type
     */
    public static function getMenuParent($pid = 0,$parent = []) {
        $authRuleGet = self::getAuthRule($pid);
        if(empty($authRuleGet)){
            return $parent;
        }
        $parent[] = $authRuleGet;
        if($pid = $authRuleGet->pid){
            return self::getMenuParent($pid,$parent);
        }
        return $parent;
    }
}
