<?php

namespace application\common\service;

use application\common\logic\User as UserLogic;
use application\common\logic\Code as CodeLogic;
use application\common\logic\UserInfo as UserInfoLogic;
use application\common\logic\Picture as PictureLogic;
use application\common\logic\Slider as SliderLogic;
use application\common\logic\Notice as NoticeLogic;
use application\common\logic\NoticeRecord as NoticeRecordLogic;
use ROL\Chuanglan\ChuanglanSMS;
use application\common\api\Result;
use think\Config;

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
        $existMobile = UserLogic::isExistMobile($mobile);
        if($existMobile){
            return Result::error(1241);
        }
        
        $addUser = UserLogic::addUser($user_name, $mobile, $password);
        if($addUser->getError()){
            return Result::error(1231,$addUser->getError());
        }
        $addUserInfo = UserInfoLogic::addUserInfo($addUser["id"]);
        if($addUserInfo->getError()){
            return Result::error(1232,$addUserInfo->getError());
        }
        return Result::success(1240);
    }
    

    /**
     * 修改用户密码
     * @param type $userId
     * @param type $password
     * @return type
     */
    public static function updatePassword($userId, $password) {
        $updateModel = UserLogic::updateUserById($userId, ["password" => $password]);
        if($updateModel->getError()){
            return Result::error(1209,$updateModel->getError());
        }
        return Result::success(1230);
    }
    
    /**
     * 修改用户头像
     * @param type $userId
     * @param type $pictureId
     */
    public static function updatePortrait($userId,$pictureId) {
        $updateModel = UserInfoLogic::updateUserInfo($userId, ["portrait" => $pictureId]);
        if($updateModel->getError()){
            return Result::error(1245,$updateModel->getError());
        }
        return Result::success(1246);
    }

    /**
     * 修改用户昵称
     * @param type $userId
     * @param type $nickName
     * @return type
     */
    public static function updateNickName($userId, $nickName) {
        $updateModel=  UserInfoLogic::updateUserInfo($userId, ["nick_name" => $nickName]);
        if($updateModel->getError()){
            Result::error(1245,$updateModel->getError());
        }
        return Result::success(1248);
    }

    /**
     * 修改手机号码(含验证码)
     * @param type $userId
     * @param type $mobile
     * @param type $code
     * @return type
     */
    public function updateMobileInCode($userId, $mobile, $code) {
        $verifiCode = Code::verifiCodeLogic($mobile, $code);
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
        $result = self::verifiCode($mobile, $code);
        if($result->isError()){
            return $result;
        }
        return self::initUser($mobile, $mobile, $password);
    }

    /**
     * 首先判断是否在今天发送的限制之内，添加CODE
     * @param type $mobile
     * @param type $code
     * @return int 1201 短信验证码初始化失败；1202 短信验证码达到今日发送上线；0 短信初始化成功；
     */
    private static function addCodeForAllow($mobile, $code){
        if(Config::get("CODE_DAY_LIMIT")<=Code::countByMobile($mobile)){
            $addModel = CodeLogic::addCode($mobile, $code);
            if($addModel->getError()){
                return Result::error(1201,$addModel->getError());
            }
            return Result::success();
            
        }
        return Result::error(1202);
    }


    /**
     * 发送验证码
     * @param type $mobile 手机号码
     * @param type $opType 发送内容
     * @param type $sendType 发送类型 0:短信;1:语音
     * @return type  1203 短信验证码发送失败；
     */
    public static function sendSms($mobile, $opType = 0, $sendType = 0) {
        //生成验证码
        $code = \get_rand_number(1000, 9999, 1)[0];
        
        $result = self::addCodeForAllow($mobile, $code);
        if($result->isError()){
            return $result;
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
            return Result::error(1203);
        }
        return Result::success(1204);
    }

    /**
     * 验证验证码
     * @param type $mobile
     * @param type $code
     * @return type 1206 短信验证码状态更新失败；1207 短信验证码匹配不成功；1205 该用户还没有发送短信
     */
    public static function verifiCode($mobile, $code) {
        $findCode = CodeLogic::findToNewCode($mobile);
        if(empty($findCode)){
            return Result::error(1205);
        }
        if($findCode['code'] == $code){
            $updateStatus = CodeLogic::updateToCodeUsered($findCode['id']);
            if($updateStatus->getError()){
                return Result::error(1206,$updateStatus->getError());
            }
            return Result::success(1208);
        }
        return Result::error(1207);
    }

    /**
     * 用户资料
     * @param type $userId
     * @return type
     */
    public static function getUserInfo($userId) {
        $userGet = UserLogic::get($userId);
        if(empty($userGet)){
            return Result::error(1242);
        }
        $userInfoGet = UserInfoLogic::get($userId);
        if(empty($userInfoGet)){
            return Result::error(1251);
        }
        
        $pictureGet = PictureLogic::getPathById($userInfoGet->portrait);
        
        if(empty($pictureGet)){
            return Result::error(1252);
        }
        
        $userArr = $userGet->visible(["user_name","mobile","login_num"])->toArray();
        $userInfoArr = $userInfoGet->visible(["amount","info","red_packets","nick_name"])->toArray();
        
        $userInfoArr["portrait"] = $pictureGet;
        
        $array_merge = array_merge($userArr, $userInfoArr);
        
        return Result::success(1243,$array_merge);
    }

    /**
     * 用户登陆
     * @param type $mobile
     * @param type $password
     * @return type
     */
    public static function userLogin($mobile, $password) {
        $userByMobile = UserLogic::isExistMobile($mobile);
        if (empty($userByMobile)) {
            return Result::error(1260);
        }
        if ($userByMobile["password"] != $password) {
            return Result::error(1261);
        }
        $userByMobile->visible(["id","user_name","mobile","login_num"]);
        return Result::success(1262,$userByMobile);
    }
    
    
    /**
     * 通知列表
     * @param type $userId
     */
    public static function notification($userId) {
        $notif = NoticeLogic::paginateByNoticeType(NoticeLogic::NOTICE_NOTIFICATION);
        foreach ($notif as $item) {
            $noticeRecord = NoticeRecordLogic::getNoticeRecordByUserId($userId, $item->id);
            if(empty($noticeRecord)){
                $readStatus = NoticeRecordLogic::NOT_READ;
            }else{
                $readStatus = $noticeRecord->notice_record_status;
            }
            $item->data("readStatus",$readStatus);
            $item->visible(["title","content","readStatus","readStatus","create_time"]);
        }
        return Result::success(1251, $notif);
    }
    
    /**
     * 修改通知状态
     * @param type $userId
     * @param type $noticeId
     * @return type
     */
    public static function updateNotification($userId,$noticeId) {
        $updateModel = NoticeRecordLogic::updateNoticeRecord($userId, $noticeId);
        if($updateModel->getError()){
            return Result::error(1271, $updateModel->getError());
        }
        return Result::success(1270);
    }
    /**
     * 公告列表
     * @param type $userId
     */
    public static function announcement($userId) {
        $announ = NoticeLogic::paginateByNoticeType(NoticeLogic::NOTICE_ANNOUNCEMENT);
        foreach ($announ as $item) {
            $noticeRecord = NoticeRecordLogic::getNoticeRecordByUserId($userId, $item->id);
            if(empty($noticeRecord)){
                $readStatus = NoticeRecordLogic::NOT_READ;
            }else{
                $readStatus = $noticeRecord->notice_record_status;
            }
            $item->data("readStatus",$readStatus);
            $item->visible(["id","title","content","readStatus","readStatus","create_time"]);
        }
        return Result::success(1250, $announ);
    }
    
    /**
     * 图片轮播列表
     */
    public static function listSlider() {
        $selectToSlider = SliderLogic::selectToSlider();
        foreach ($selectToSlider as $item) {
            $pictureGet = PictureLogic::get($item->picture_id);
            $item->data("picture",$pictureGet["path"]);
            $item->visible(["id","title","picture","link","click_id"]);
        }
        return Result::success(1252,$selectToSlider);
    }
    
}
