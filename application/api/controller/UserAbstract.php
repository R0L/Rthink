<?php

namespace application\api\controller;
/**
 * @author ROL
 * @date 2016-11-25 13:07:25
 * @version V1.0
 * @desc   
 */
abstract class UserAbstract extends Api{
    
    /**
     * 发送短信接口
     */
    abstract function sendSms($mobile,$opType,$sendType);
    
    
    /**
     * 验证手机号接口
     */
    abstract function verifiCode($mobile, $code);
    
    
    /**
     * 修改用户密码接口
     */
    abstract function updatePassword($userId, $password);
    
    /**
     * 添加用户含短信验证接口
     */
    abstract function addUserInCode($mobile, $password, $code);
    
    
    /**
     * 获取用户资料
     */
    abstract function getUserInfo($userId);
    
    
    /**
     * 修改用户头像
     */
    abstract function updatePortrait($userId,$pictureId);
    
    
    /**
     * 修改用户昵称
     */
    abstract function updateNickName($userId,$nickName);
    
    /**
     * 通知
     */
    abstract function notification($userId);
    
    /**
     * 公告
     */
    abstract function announcement($userId);
    
    /**
     * 修改通知状态
     */
    abstract function updateNotification($userId,$noticeId);
    
    /**
     * 图片轮播
     */
    abstract function listSlider();
    
    
    /**
     * 用户登录
     */
    abstract function userLogin($mobile, $password);
    
}
