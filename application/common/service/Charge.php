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
class Charge {
    
    
    /**
     * 支持支付的类型
     * @return type
     */
    public function getChargeType() {
        return Config::selectByConfigType();
    }
    
    
    /**
     * 充值
     * @param type $data
     */
    public function recharge($data) {
        return ChargeLogic::recharge($data);
    }
    
    
    /**
     * 提现
     * @param type $data
     * @return type
     */
    public function tixian($data) {
        return ChargeLogic::payment($data);
    }
    
    
    /**
     * 消费记录
     * @param type $userId
     * @return type
     */
    public function consumeRecharge($userId) {
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
