<?php

namespace application\common\logic;
use application\common\model\AuthRule as AuthRuleModel;
use application\common\model\Tree;

/**
 * @author ROL
 * @date 2016-11-16 16:20:48
 * @version V1.0
 * @desc   
 */
class AuthRule extends AuthRuleModel{
    
    
    
    /**
     * 返回所有的AuthRule
     * @return type
     */
    public static function selectToAuthRule($map=[]) {
        return AuthRuleModel::all($map);
    }
    
}
