<?php

namespace application\api\controller\v1;
use application\api\controller\UserAbstract;
use application\common\service\User as UserService;
/**
 * @author ROL
 * @date 2016-11-25 15:28:20
 * @version V1.0
 * @desc 用户相关模块   
 */
class User extends UserAbstract {
    
    
    /**
     * 发送短信验证码接口
     * @param type $mobile 手机号
     * @param type $opType 发送内容类型
     * @param type $sendType 发送方式类型 0：文字|1：语音
     * @return type
     */
    public function sendSms($mobile, $opType = 0, $sendType = 0) {
        $sendSms = UserService::sendSms($mobile, $opType, $sendType);
        return parent::jCode($sendSms,1204);
    }

    
    /**
     * 单独验证短信接口
     * @param type $mobile
     * @param type $code
     * @return type 
     */
    public function verifiCode($mobile, $code) {
        $verifiCode = UserService::verifiCode($mobile, $code);
        return parent::jCode($verifiCode, 1208);
    }

    /**
     * 修改用户密码接口
     * @param type $userId
     * @param type $password
     * @return type
     */
    public function updatePassword($userId, $password) {
        $updateModel = UserService::updatePassword($userId, $password);
        if($updateModel->getError()){
            return parent::jCode(1209,$updateModel->getError());
        }
        return parent::jCode(0,1230);
    }
    
    
    /**
     * 
     * @param type $mobile
     * @param type $password
     * @param type $code
     * @return type 
     */
    public function addUserInCode($mobile, $password, $code) {
        $addUserInCode = UserService::addUserInCode($mobile, $password, $code);
        return parent::jCode($addUserInCode,1240);
    }

    /**
     * 获取用户数据接口
     * @param type $userId
     * @return type 1242 用户资料获取失败；
     */
    public function getUserInfo($userId) {
        $userInfo = UserService::getUserInfo($userId);
        if(empty($userInfo)){
            return parent::jCode($userInfo);
        }
        $userInfo['userinfo'] = $userInfo->userinfo;
        return parent::jCode(0,1243,$userInfo);
    }

    
    /**
     * 修改用户头像接口
     * @param type $userId
     * @return type
     */
    public function updatePortrait($userId) {
        $updateModel = UserService::updatePortrait(\think\Request::instance(),$userId);
        if($updateModel->getError()){
            return parent::jCode(1245,$updateModel->getError());
        }
        return parent::jCode(0,1246);
    }
    
    /**
     * 修改用户昵称接口
     * @param type $userId
     * @param type $userName
     */
    public function updateUserName($userId, $userName) {
        $updateModel = UserService::updateUserName($userId, $userName);
        if($updateModel->getError()){
            return parent::jCode(1247,$updateModel->getError());
        }
        return parent::jCode(0,1248);
    }

    /**
     * 通知列表接口
     * @param type $userId
     */
    public function announcement($userId) {
        $announ = UserService::announcement($userId);
        return parent::jCode(0,1250,$announ->toArray());
    }

    /**
     * 公告列表接口
     * @param type $userId
     * @return type
     */
    public function notification($userId) {
        $notifi = UserService::notification($userId);
        return parent::jCode(0,1251,$notifi->toArray());
    }

    /**
     * 图片轮播接口
     */
    public function listSlider() {
        $listSlider = UserService::listSlider();
        return parent::jCode(0,1252,$listSlider->toArray());
    }


}
