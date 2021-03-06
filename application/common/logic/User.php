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
     * 编辑用户信息 通过$id
     * @param type $map
     */
    public static function updateUserById($id,$data) {
        return UserModel::update($data,["id"=>$id]);
    }
    
    /**
     * 获得用户 通过$mobile
     * @param type $mobile
     * @return type
     */
    public static function getUserByMobile($mobile) {
       return UserModel::get(["mobile"=>$mobile]);
    }
    
    /**
     * 添加用户
     * @param type $user_name
     * @param type $mobile
     * @param type $password
     * @return type
     */
    public static function addUser($user_name,$mobile,$password) {
        return UserModel::create(["user_name" => $user_name, "mobile" => $mobile, "password" => $password]);
    }
    
    /**
     * 获取用户数量 根据$mobile
     * @param type $mobile
     * @return type
     */
    public static function isExistMobile($mobile) {
        return UserModel::where(["mobile"=>$mobile])->find();
    }
    /**
     * 判断用户Id存在 根据$userId
     * @param type $userId
     * @return type
     */
    public static function isExistUserId($userId) {
        return UserModel::where(["id"=>$userId])->find();
    }
    
}
