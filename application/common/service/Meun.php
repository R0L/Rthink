<?php

namespace application\common\service;

use application\common\logic\AuthGroup;
use application\common\logic\AuthRule;
use application\common\logic\AuthGroupAccess;
use application\common\logic\Member;
use application\common\api\Tree;

/**
 * @author ROL
 * @date 2016-11-22 16:37:23
 * @version V1.0
 * @desc   
 */
class Meun {

    /**
     * 返回所有的AuthRule的树形菜单
     * @return type
     */
    public function selectToMenus() {
        $Tree = new Tree();
        return $Tree->toTree(AuthRule::selectToAuthRule());
    }

    /**
     * 通过$module，$userId返回AuthRule
     * @param type $module
     * @return type
     */
    public function selectByModule($module = null, $userId = null, $rules = null, $isMenu = true) {
        $map = [];
        $module && $map["module"] = $module;
        $rules && $map["id"] = ["in", $rules];
        $isMenu && $map["is_menu"] = 1;
        $Tree = new Tree();

        $authRuleAll = AuthRule::selectToAuthRule($map);
        if ($userId) {
            $authGroupAccess = AuthGroupAccess::getAuthGroupAccessByuid($userId);
            $authGroupRules = AuthGroupModel::getRulesToGroup($authGroupAccess->group_id);
            foreach ($authRuleAll as $authrule) {
                $bflag = false;
                if (in_array($authrule->id, explode(",", $authGroupRules))) {
                    $bflag = true;
                }
                $authrule->data("checked", $bflag)->append("checked");
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
    public function selectByModuleUserId($module = null, $userId = null) {
        $rulesByuidToGroup = $this->getRulesByuidToGroup($userId);
        if (empty($rulesByuidToGroup)) {
            return false;
        }
        return $this->selectByModule($module, $userId, $rulesByuidToGroup);
    }

    /**
     * 根据uid返回auth_group的rules栏目
     * @param type $uid
     * @return type
     */
    public function getRulesByuidToGroup($uid) {
        $group_id = AuthGroupAccess::getRulesByuidToGroup($uid);
        if (empty($group_id)) {
            return false;
        }
        return AuthGroup::getRulesToGroup($group_id);
    }
    
    
    /**
     * 根据uid返回auth_group的GroupId栏目
     * @param type $uid
     * @return type
     */
    public function getGroupIdByuid($uid) {
        return AuthGroupAccess::getRulesByuidToGroup($uid);
    }
    

    /**
     * 查询AuthGroupAccess数据
     * @param type $groupId
     * @return type
     */
    public function selectToAccess($groupId = null) {
        $map = [];
        $groupId && $map["group_id"] = $groupId;
        return AuthGroupAccess::selectToAuthGroupAccess($map);
    }

    /**
     * 查询还没有绑定用户权限组的用户list
     * @return type
     */
    public static function selectToUserExcept() {
        $map = [];
        $column = AuthGroupAccess::getRulesToUID();
        if (!empty($column)) {
            $map["id"] = ["not in", $column];
        }
        return Member::all($map);
    }

    /**
     * 返回当前菜单的上级
     * @param type $pid
     * @param type $parent
     * @return type
     */
    public function getMenuParent($pid = 0, $parent = []) {
        $authRuleGet = AuthRule::getAuthRule($pid);
        if (empty($authRuleGet)) {
            return $parent;
        }
        $parent[] = $authRuleGet;
        if ($pid = $authRuleGet->pid) {
            return $this->getMenuParent($pid, $parent);
        }
        return $parent;
    }

}
