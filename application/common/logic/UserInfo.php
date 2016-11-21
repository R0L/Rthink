<?php

namespace application\common\logic;
use application\common\model\UserInfo as UserInfoModel;

/**
 * @author ROL
 * @date 2016-11-21 16:20:06
 * @version V1.0
 * @desc   
 */
class UserInfo extends UserInfoModel {
    
    
    /**
     * 编辑用户资料
     * @param type $userId
     * @param type $data
     */
    public static function updateUserInfo($userId,$data=[]) {
        UserInfoModel::update($data,["user_id"=>$userId]);
    }
    
}
