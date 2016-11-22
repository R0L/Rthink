<?php

namespace application\common\logic;

use application\common\model\AuthRule as AuthRuleModel;

/**
 * @author ROL
 * @date 2016-11-16 16:20:48
 * @version V1.0
 * @desc   
 */
class AuthRule extends AuthRuleModel {

    /**
     * 返回所有的AuthRule
     * @return type
     */
    public static function selectToAuthRule($map = []) {
        return AuthRuleModel::all($map);
    }

    /**
     * 根据id/name获得AuthRule
     * @param type $id
     * @param type $isName
     * @return type
     */
    public static function getAuthRule($id = NULL, $isName = false) {
        $map = [];
        if ($isName) {
            $map["name"] = $isName;
        } else if (is_numeric($id)) {
            $map["id"] = $id;
        } else if (is_string($id)) {
            $map["name"] = $id;
        }
        return AuthRuleModel::get($map);
    }

}
