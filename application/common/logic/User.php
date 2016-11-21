<?php

namespace application\common\logic;
use application\common\model\User as UserModel;

/**
 * @author ROL
 * @date 2016-11-21 15:29:27
 * @version V1.0
 * @desc   
 */
class User extends UserModel{
    
    /**
     * 编辑用户信息 通过$mobile
     * @param type $map
     */
    public static function updateUserByMobile($mobile,$data) {
        UserModel::update($data,["mobile"=>$mobile]);
    }
    /**
     * 编辑用户信息 通过$id
     * @param type $map
     */
    public static function updateUserByID($id,$data) {
        UserModel::update($data,["id"=>$id]);
    }
    
    /**
     * 获得用户 通过$mobile
     * @param type $mobile
     * @return type
     */
    public static function getUserByMobile($mobile) {
       return UserModel::get(["mobile"=>$mobile]);
    }
    
}
