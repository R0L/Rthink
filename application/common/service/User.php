<?php

namespace application\common\service;

use application\common\logic\User as UserLogic;
use application\common\logic\Code;
use application\common\logic\UserInfo;
use ROL\Chuanglan\ChuanglanSMS;

/**
 * @author ROL
 * @date 2016-11-21 15:30:48
 * @version V1.0
 * @desc   
 */
class User {

    /**
     * 修改用户密码
     * @param type $userId
     * @param type $password
     * @return type
     */
    public static function updatePassword($userId, $password) {
        return UserLogic::updateUserByID($userId, ["password" => $password]);
    }

    /**
     * 修改用户头像
     * @param type $userId
     * @param type $portrait
     */
    public static function updatePortrait($userId, $portrait) {
        return UserInfo::updateUserInfo($userId, ["portrait" => $portrait]);
    }

    /**
     * 修改用户昵称
     * @param type $userId
     * @param type $nick_name
     * @return type
     */
    public static function updateNickname($userId, $nick_name) {
        return UserInfo::updateUserInfo($userId, ["nick_name" => $nick_name]);
    }

    /**
     * 修改手机号码(含验证码)
     * @param type $userId
     * @param type $mobile
     * @param type $code
     * @return type
     */
    public static function updateMobileINCode($userId, $mobile, $code) {
        $verifiCode = Code::verifiCode($mobile, $code);
        if(empty($verifiCode)){
            return json(["code"=>400,"info"=>"验证码不存在"]);
        }
        $updateUserByID = UserLogic::updateUserByID($userId, ["mobile" => $mobile]);
        if(empty($updateUserByID)){
            return json(["code"=>400,"info"=>"用户修改手机号码失败"]);
        }
        return json(["code"=>200,"info"=>"用户修改手机号码成功"]);
    }

    /**
     * 新增用户帐号(含验证码)
     * @param type $mobile
     * @param type $password
     * @param type $code
     * @return boolean
     */
    public static function addUserInCode($mobile, $password, $code) {
        $verifiCode = Code::verifiCode($mobile, $code);
        if(empty($verifiCode)){
            return json(["code"=>400,"info"=>"验证码不存在"]);
        }
        $statusDeal = UserLogic::deal(["user_name" => $mobile, "mobile" => $mobile, "password" => $password]);
        
        if(empty($statusDeal)){
            return json(["code"=>400,"info"=>"用户添加失败"]);
        }
        
        return json(["code"=>200,"info"=>"用户添加成功"]);
    }

    /**
     * 发送验证码
     * @param type $mobile
     * @param type $opType
     * @param type $sendType
     * @return boolean
     */
    public static function sendSms($mobile, $opType = 0, $sendType = 0) {
        $code = get_rand_number(1000, 9999, 4);
        $chuanglanSMS = new ChuanglanSMS();
        $sendStatus = false;
        switch ($opType) {
            case 0:
                break;
            case 1:
                break;
            case 2:
                break;
            default:
                break;
        }
        switch ($sendType) {
            case 0:
                $sendStatus = $chuanglanSMS->sendSms($mobile, $code);
                break;
            case 1:
                $sendStatus = $chuanglanSMS->sendVoice($mobile, $code);
                break;
            default:
                break;
        }
        $sendStatus && $addCode = Code::addCode($mobile, $code);
        if ($addCode) {
            return true;
        }
        return false;
    }

    
    /**
     * 验证验证码
     * @param type $mobile
     * @param type $code
     * @return type
     */
    public static function verifiCode($mobile, $code) {
        return Code::verifiCode($mobile, $code);
    }
    
    
    /**
     * 用户资料
     * @param type $userId
     * @return type
     */
    public static function getUserInfo($userId) {
       return UserLogic::get($userId);
    }
    
    
    /**
     * 用户登陆
     * @param type $mobile
     * @param type $password
     * @return type
     */
    public static function userLogin($mobile,$password) {
        
        $userByMobile = UserLogic::getUserByMobile($mobile);
        
        if(empty($userByMobile)){
            return json(["code" => 400,"info"=>"用户不存在"]);
        }
        
        if($userByMobile["password"] != $password){
            return json(["code" => 400,"info"=>"用户密码错误"]);
        }
        
        return json(["code" => 200,"info"=>"用户登陆成功"]);
        
    }
}
