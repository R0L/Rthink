<?php

namespace application\common\service;
use application\common\logic\Config;
use application\common\logic\Charge as ChargeLogic;
use application\common\api\Result;
/**
 * @author ROL
 * @date 2016-11-22 10:59:15
 * @version V1.0
 * @desc   
 */
class Charge extends Common {
    
    
    /**
     * 支持支付的类型
     * @return type
     */
    public static function getChargeType() {
        $payType = Config::selectToPayType();
        return Result::success(1600,$payType);
        
    }
    
    
    /**
     * 充值
     * @param type $data
     */
    public static function recharge($userId,$money,$chargeType,$describle="",$chargeStatus=ChargeLogic::CHARGE_INIT) {
        $chargeCode = StrOrderOne();
        $paymentModel = ChargeLogic::payment($userId,$money,$describle,$chargeCode,$chargeType,$chargeStatus);
        if($paymentModel->getError()){
            return Result::error(1633,$paymentModel->getError());
        }
        return Result::success(1634,["chargeCode"=>$chargeCode]);
    }
    
    
    /**
     * 提现
     * @param type $data
     * @return type
     */
    public static function tixian($userId,$money,$describle="") {
        $payment = ChargeLogic::payment($userId,$money,$describle,null,ChargeLogic::CHARGE_TYPE_TIXIAN,ChargeLogic::CHARGE_INIT);
        if($payment->getError()){
            return Result::error(1631,$payment->getError());
        }
        return Result::success(1632);
    }
    
    
    /**
     * 消费记录
     * @param type $userId
     * @return type
     */
    public static function recordConsume($userId) {
        $recordConsume = ChargeLogic::selectByMoneyCon($userId);
        return Result::success(1610,$recordConsume);
    }
    
    /**
     * 充值记录
     * @param type $userId
     * @return type
     */
    public static function recordRecharge($userId) {
        $recordRecharge = ChargeLogic::selectByMoneyCon($userId, true);
        return Result::success(1620,$recordRecharge);
    }
    
    
    /**
     * 提现记录
     * @param type $userId
     * @return type
     */
    public static function recordTixian($userId) {
        $recordTixian = ChargeLogic::selectByChargeStatus($userId,  ChargeLogic::CHARGE_TYPE_TIXIAN);
        return Result::success(1630,$recordTixian);
    }
    
    
}
