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
        $result = UserService::sendSms($mobile, $opType, $sendType);
        return parent::jResult($result);
    }

    
    /**
     * 单独验证短信接口
     * @param type $mobile
     * @param type $code
     * @return type 
     */
    public function verifiCode($mobile, $code) {
        $result = UserService::verifiCode($mobile, $code);
        return parent::jResult($result);
    }

    /**
     * 修改用户密码接口
     * @param type $userId
     * @param type $password
     * @return type
     */
    public function updatePassword($userId, $password) {
        $result = UserService::updatePassword($userId, $password);
        return parent::jResult($result);
    }
    
    
    /**
     * 添加用户接口
     * @param type $mobile
     * @param type $password
     * @param type $code
     * @return type 
     */
    public function addUserInCode($mobile, $password, $code) {
        $result = UserService::addUserInCode($mobile, $password, $code);
        return parent::jResult($result);
    }

    /**
     * 获取用户数据接口
     * @param type $userId
     * @return type 1242 用户资料获取失败；
     */
    public function getUserInfo($userId) {
        $result = UserService::getUserInfo($userId);
        return parent::jResult($result);
    }

    
    /**
     * 修改用户头像接口
     * @param type $userId
     * @return type
     */
    public function updatePortrait($userId,$pictureId) {
        $result = UserService::updatePortrait($pictureId,$userId);
        return parent::jResult($result);
    }
    
    /**
     * 修改用户昵称接口
     * @param type $userId
     * @param type $nickName
     */
    public function updateNickName($userId, $nickName) {
        $result = UserService::updateNickName($userId, $nickName);
        return parent::jResult($result);
    }

    /**
     * 通知列表接口
     * @param type $userId
     */
    public function announcement($userId) {
        $result = UserService::announcement($userId);
        return parent::jResult($result);
    }

    /**
     * 公告列表接口
     * @param type $userId
     * @return type
     */
    public function notification($userId) {
        $result = UserService::notification($userId);
        return parent::jResult($result);
    }
    
    /**
     * 修改通知接口
     * @param type $userId
     * @param type $noticeId
     * @return type
     */
    public function updateNotification($userId,$noticeId){
         $result = UserService::updateNotification($userId,$noticeId);
        return parent::jResult($result);
    }

    /**
     * 图片轮播接口
     */
    public function listSlider() {
        $listSlider = UserService::listSlider();
        return parent::jResult($listSlider);
    }
    
    /**
     * 用户登录成功接口
     * @param type $mobile
     * @param type $password
     * @return type
     */
    public function userLogin($mobile, $password) {
        $userLogin = UserService::userLogin($mobile,$password);
        return parent::jResult($userLogin);
    }


}
