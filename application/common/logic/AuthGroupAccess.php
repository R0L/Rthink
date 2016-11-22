<?php

namespace application\common\logic;

use application\common\model\AuthGroupAccess as AuthGroupAccessModel;

/**
 * @author ROL
 * @date 2016-11-22 16:38:22
 * @version V1.0
 * @desc   
 */
class AuthGroupAccess extends AuthGroupAccessModel {

    
    /**
     * 获得AuthGroupAccess
     * @param type $map
     * @return type
     */
    public static function selectToAuthGroupAccess($map=[]) {
        return AuthGroupAccess::all($map);
    }
    
    /**
     * 获得AuthGroupAccess 通过 $userId
     * @param type $uid
     * @return type
     */
    public static function getAuthGroupAccessByuid($uid) {
        return AuthGroupAccess::get(["uid" => $uid]);
    }

    /**
     * 获得AuthGroupAccess的group_id 通过 $userId
     * @param type $uid
     * @return type
     */
    public static function getRulesByuidToGroup($uid) {
        return AuthGroupAccess::get(["uid" => $uid])->value("group_id");
    }
    
    /**
     * 获得AuthGroupAccess的uid
     * @return type
     */
    public static function getRulesToUID() {
        return AuthGroupAccess::where(true)->column('uid');
    }

}