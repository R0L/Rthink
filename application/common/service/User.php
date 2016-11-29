<?php

namespace application\common\service;

use application\common\logic\User as UserLogic;
use application\common\logic\Code;
use application\common\logic\UserInfo;
use application\common\logic\Notice;
use application\common\logic\Picture;
use application\common\logic\Slider;
use ROL\Chuanglan\ChuanglanSMS;
use application\common\controller\Attach;

/**
 * @author ROL
 * @date 2016-11-21 15:30:48
 * @version V1.0
 * @desc   
 */
class User extends Common {
    
    
    /**
     * 初始化用户数据
     * @param type $user_name
     * @param type $mobile
     * @param type $password
     * @return int 1231 用户数据插入失败；1232 用户信息插入失败
     */
    private static function initUser($user_name,$mobile,$password) {
        $addUser = UserLogic::addUser($user_name, $mobile, $password);
        if($addUser->getError()){
            return 1231;
        }
        $addUserInfo = UserInfo::addUserInfo($addUser["id"]);
        if($addUserInfo->getError()){
            return 1232;
        }
        return 0;
    }
    

    /**
     * 修改用户密码
     * @param type $userId
     * @param type $password
     * @return type
     */
    public static function updatePassword($userId, $password) {
        parent::checkUserId($userId);
        parent::checkPassword($password);
        return UserLogic::updateUserById($userId, ["password" => $password]);
    }
    
    /**
     * 修改用户头像
     * @param type $request
     * @param type $userId 1244 图片上传失败；
     */
    public static function updatePortrait($request,$userId) {
        parent::checkUserId($userId);
        $Attach = new Attach();
        try {
            $portrait = $Attach->uploadPicture($request);
        } catch (Exception $exc) {
            return 1244;
        }
        return UserInfo::updateUserInfo($userId, ["portrait" => $portrait]);
    }

    /**
     * 修改用户昵称
     * @param type $userId
     * @param type $userName
     * @return type
     */
    public static function updateUserName($userId, $userName) {
        parent::checkUserId($userId);
        parent::checkUserName($userName);
        return UserLogic::updateUserById($userId, ["user_name" => $userName]);
    }

    /**
     * 修改手机号码(含验证码)
     * @param type $userId
     * @param type $mobile
     * @param type $code
     * @return type
     */
    public function updateMobileInCode($userId, $mobile, $code) {
        $verifiCode = Code::verifiCode($mobile, $code);
        if (empty($verifiCode)) {
            throw new Exception("验证码不存在", 400);
        }
        $updateUserByID = UserLogic::updateUserById($userId, ["mobile" => $mobile]);
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
     * @return type 1231 数据库插入用户数据失败；1241 用户已经存在
     */
    public static function addUserInCode($mobile, $password, $code) {
        parent::checkMobile($mobile);
        parent::checkPassword($password,true);
        parent::checkCode($code);
        $verifiCode = self::verifiCode($mobile, $code);
        if($verifiCode){
            return $verifiCode;
        }
        return self::initUser($mobile, $mobile, $password);
    }

    /**
     * 发送验证码
     * @param type $mobile 手机号码
     * @param type $opType 发送内容
     * @param type $sendType 发送类型 0:短信;1:语音
     * @return type  1203 短信验证码发送失败；
     */
    public static function sendSms($mobile, $opType = 0, $sendType = 0) {
        parent::checkMobile($mobile,$opType);
        //生成验证码
        $code = \get_rand_number(1000, 9999, 1)[0];
        
        $addCode = Code::addCodeForAllow($mobile, $code);
        if($addCode){
            return $addCode;
        }
        
        //初始化发送组件
        $chuanglanSMS = new ChuanglanSMS("国讯通");
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
        if (empty($sendStatus)) {
            return 1203;
        }
        return 0;
    }

    /**
     * 验证验证码
     * @param type $mobile
     * @param type $code
     * @return type 1206 短信验证码状态更新失败；1207 短信验证码匹配不成功；1205 该用户还没有发送短信
     */
    public static function verifiCode($mobile, $code) {
        parent::checkMobile($mobile);
        parent::checkCode($code);
        $findCode = Code::findToNewCode($mobile);
        if(empty($findCode)){
            return 1205;
        }
        if($findCode['code'] == $code){
            $updateStatus = Code::updateToCodeUsered($findCode['id']);
            if($updateStatus->getError()){
                return 1206;
            }
            return 0;
        }
        return 1207;
    }

    /**
     * 用户资料
     * @param type $userId
     * @return type
     */
    public static function getUserInfo($userId) {
        parent::checkUserId($userId);
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
     * 通知列表
     * @param type $userId
     */
    public static function notification($userId) {
        return Notice::paginateByNoticeType($userId,Notice::NOTICE_NOTIFICATION);
    }
    /**
     * 公告列表
     * @param type $userId
     */
    public static function announcement($userId) {
        return Notice::paginateByNoticeType($userId,Notice::NOTICE_ANNOUNCEMENT);
    }
    
    /**
     * 图片轮播列表
     */
    public static function listSlider() {
        $selectToSlider = Slider::selectToSlider();
        foreach ($selectToSlider as $item) {
            $pictureGet = Picture::get($item->picture_id);
            $item->data("picture",$pictureGet["path"]);
            $item->visible(["title","picture","link","click_id"]);
        }
        return $selectToSlider;
    }
    
}
