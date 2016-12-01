<?php

namespace application\common\service;
use application\common\logic\User;
use application\common\logic\Order;
/**
 * @author ROL
 * @date 2016-11-29 10:11:47
 * @version V1.0
 * @desc   
 */
class Common {
    
    /**
     * 检查mobile
     * @param type $mobile
     * @param type $opType
     * @return type
     */
    public static function checkMobile($mobile,$opType = false) {
        if(empty($mobile)){
            return 1101;
        }
        if(!preg_match("/^1[3456789]\d{9}$/",$mobile)){
            return 1102;
        }
        if($opType){
            $existStstus = User::isExistMobile($mobile);
            if($existStstus){
                return 1241;
            }
        }
    }
    
    /**
     * 检查code
     * @param type $code
     * @return type
     */
    public static function checkCode($code) {
        if(empty($code)){
            return 1103;
        }
        if(!preg_match("/^\d{4}$/",$code)){
            return 1104;
        }
    }
    
    /**
     * 检查userId
     * @param type $userId
     * @return type
     */
    public static function checkUserId($userId) {
        if(empty($userId)){
            return 1105;
        }
        $existUserId = User::isExistUserId($userId);
        if(empty($existUserId)){
            return 11051;
        }
    }
    /**
     * 检查orderId
     * @param type $orderId
     * @return type
     */
    public static function checkOrderId($orderId) {
        if(empty($orderId)){
            return 1113;
        }
        $existUserId = Order::isExistOrderId($orderId);
        if(empty($existUserId)){
            return 1114;
        }
    }
    
    /**
     * 检查userPassword
     * @param type $password
     * @return type
     */
    public static function checkPassword($password) {
         if(empty($password)){
            return 1106;
        }
        if(!preg_match("/^\w{0,10}$/",$password)){
            return 1107;
        }
    }
    
    /**
     * 检查nickName
     * @param type $username
     * @return type
     */
    public static function checkUserName($username) {
         if(empty($username)){
            return 1108;
        }
        if(!preg_match("/^\w{0,30}$/",$username)){
            return 1109;
        }
    }
    
    /**
     * 检查$num
     * @param type $num
     * @return int
     */
    public static function checkNum($num) {
        if(!preg_match("/^\d+$/",$num)){
            return 1111;
        }
    }
    
    
    
}
