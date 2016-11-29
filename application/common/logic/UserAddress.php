<?php

namespace application\common\logic;
use application\common\model\UserAddress as UserAddressModel;

/**
 * @author ROL
 * @date 2016-11-22 10:46:33
 * @version V1.0
 * @desc   
 */
class UserAddress extends UserAddressModel{
    
    
    /**
     * 获取用户地址列表 通过$userId
     * @param type $userId
     * @return type
     */
    public static function selectAddressByUserId($userId) {
        return UserAddressModel::paginate(["user_id"=>$userId]);
    }
    
    
    
    
    
}
