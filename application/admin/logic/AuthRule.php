<?php

namespace application\admin\logic;
use application\admin\model\AuthRule as AuthRuleModel;
use application\common\model\Tree;

/**
 * @author ROL
 * @date 2016-11-16 16:20:48
 * @version V1.0
 * @desc   
 */
class AuthRule extends  AuthRuleModel{
    
    
    
    /**
     * 返回所有的AuthRule
     * @return type
     */
    public static function selectToAuthRule() {
        return AuthRuleModel::all();
    }
    
    /**
     * 返回所有的AuthRule的树形菜单
     * @return type
     */
    public static function selectToMenus(){
        $Tree = new Tree();
        return $Tree->toTree(self::selectToAuthRule());
    }
    
}
