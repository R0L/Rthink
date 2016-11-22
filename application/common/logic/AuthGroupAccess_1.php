<?php

namespace application\common\logic;
use application\common\model\AuthGroupAccess as AuthGroupAccessModel;
/**
 * @author ROL
 * @date 2016-11-22 16:38:22
 * @version V1.0
 * @desc   
 */
class AuthGroupAccess extends AuthGroupAccessModel{
    
    
    /**
     * 获得AuthGroupAccess 通过 $userId
     * @param type $userId
     * @return type
     */
    public static function getAuthGroupAccessByUserId($userId) {
        return AuthGroupAccess::get(["uid"=>$userId]);
    }
    
    public static function getRulesByuidToGroup($uid){
        return AuthGroupAccess::get(["uid"=>$uid])->value("group_id");
    }
    
}
