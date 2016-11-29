<?php

namespace application\common\service;
use application\common\logic\Config;
use application\common\logic\Charge as ChargeLogic;

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
        return $payType;
    }
    
    
    /**
     * 充值
     * @param type $data
     */
    public function recharge($userId,$money,$chargeType,$describle="",$chargeStatus=ChargeLogic::CHARGE_INIT) {
        parent::checkUserId($userId);
        $chargeCode = StrOrderOne();
        $payment = ChargeLogic::payment($userId,$money,$describle,$chargeCode,$chargeType,$chargeStatus);
        $payment->data("chargeCode",$chargeCode)->append("chargeCode");
        return $payment;
    }
    
    
    /**
     * 提现
     * @param type $data
     * @return type
     */
    public function tixian($userId,$money,$describle="") {
        parent::checkUserId($userId);
        return ChargeLogic::payment($userId,$money,$describle,null,ChargeLogic::CHARGE_TYPE_TIXIAN,ChargeLogic::CHARGE_SUCCESS);
    }
    
    
    /**
     * 消费记录
     * @param type $userId
     * @return type
     */
    public function recordConsume($userId) {
        return ChargeLogic::selectByMoneyCon($userId);
    }
    
    /**
     * 充值记录
     * @param type $userId
     * @return type
     */
    public function recordRecharge($userId) {
        return ChargeLogic::selectByMoneyCon($userId, true);
    }
    
    
    /**
     * 提现记录
     * @param type $userId
     * @return type
     */
    public function recordTixian($userId) {
        return ChargeLogic::selectByChargeStatus($userId,  ChargeLogic::CHARGE_TYPE_TIXIAN);
    }
    
    
}
