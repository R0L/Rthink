<?php

namespace application\common\service;

use application\common\logic\User as UserLogic;
use application\common\logic\Code;
use application\common\logic\UserInfo;
use application\common\logic\Amap;
use application\common\logic\UserAddress;
use application\common\logic\Notice;
use application\common\logic\Slider;
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
    public function updatePassword($userId, $password) {
        return UserLogic::updateUserByID($userId, ["password" => $password]);
    }

    /**
     * 修改用户头像
     * @param type $userId
     * @param type $portrait
     */
    public function updatePortrait($userId, $portrait) {
        return UserInfo::updateUserInfo($userId, ["portrait" => $portrait]);
    }

    /**
     * 修改用户昵称
     * @param type $userId
     * @param type $nick_name
     * @return type
     */
    public function updateNickname($userId, $nick_name) {
        return UserInfo::updateUserInfo($userId, ["nick_name" => $nick_name]);
    }

    /**
     * 修改手机号码(含验证码)
     * @param type $userId
     * @param type $mobile
     * @param type $code
     * @return type
     */
    public function updateMobileINCode($userId, $mobile, $code) {
        $verifiCode = Code::verifiCode($mobile, $code);
        if (empty($verifiCode)) {
            throw new Exception("验证码不存在", 400);
        }
        $updateUserByID = UserLogic::updateUserByID($userId, ["mobile" => $mobile]);
        if (empty($updateUserByID)) {
            throw new Exception("用户修改手机号码失败", 400);
        }
        return true;
    }

    /**
     * 新增用户帐号(含验证码)
     * @param type $mobile
     * @param type $password
     * @param type $code
     * @return boolean
     */
    public function addUserInCode($mobile, $password, $code) {
        $verifiCode = Code::verifiCode($mobile, $code);
        if (empty($verifiCode)) {
            throw new Exception("验证码不存在", 400);
        }
        $statusDeal = UserLogic::deal(["user_name" => $mobile, "mobile" => $mobile, "password" => $password]);

        if (empty($statusDeal)) {
            throw new Exception("用户添加失败", 400);
        }

        return true;
    }

    /**
     * 发送验证码
     * @param type $mobile
     * @param type $opType
     * @param type $sendType
     * @return boolean
     */
    public function sendSms($mobile, $opType = 0, $sendType = 0) {
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
    public function verifiCode($mobile, $code) {
        return Code::verifiCode($mobile, $code);
    }

    /**
     * 用户资料
     * @param type $userId
     * @return type
     */
    public function getUserInfo($userId) {
        return UserLogic::get($userId);
    }

    /**
     * 用户登陆
     * @param type $mobile
     * @param type $password
     * @return type
     */
    public function userLogin($mobile, $password) {

        $userByMobile = UserLogic::getUserByMobile($mobile);

        if (empty($userByMobile)) {
            throw new Exception("用户不存在", 400);
        }

        if ($userByMobile["password"] != $password) {
            throw new Exception("用户密码错误", 400);
        }

        return true;
    }

    
    /**
     * 地址接口
     * @param type $adcode
     * @param type $level
     * @return type
     */
    public function listAmap($adcode=null,$level="province") {
        return Amap::getAmap($adcode, $level);
    }
    
    /**
     * 添加地址
     * @param type $data
     * @return type
     */
    public function addAddress($data) {
        $userAddress = new UserAddress();
        return $userAddress->add($data);
    }
    
    /**
     * 编辑地址
     * @param type $data
     * @param type $where
     * @return type
     */
    public function editAddress($data,$where) {
        $userAddress = new UserAddress();
        return $userAddress->edit($data, $where);
    }
    
    /**
     * 删除地址
     * @param type $id
     * @return type
     */
    public function delAddress($id) {
        return UserAddress::delById($id);
    }
    
    /**
     * 地址列表
     * @param type $userId
     * @return type
     */
    public function listAddress($userId) {
        return UserAddress::all(["user_id"=>$userId]);
    }
    
    
    /**
     * 通知列表
     * @param type $userId
     * @param type $noticeType
     */
    public function listMessage($userId,$noticeType=Notice::NOTICE_NOTIFICATION) {
        return Notice::selectByNoticeType($userId,$noticeType);
    }
    
    /**
     * 图片轮播列表
     */
    public function listSlider() {
        return Slider::selectToSlider();
    }
    
}
