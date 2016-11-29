<?php

namespace application\api\controller\v1;
use application\api\controller\ChargeAbstract;
use application\common\service\Charge as ChargeService;
/**
 * @author ROL
 * @date 2016-11-29 17:06:04
 * @version V1.0
 * @desc   
 */
class Charge extends ChargeAbstract {
    
    /**
     * 充值类型接口
     */
    public function chargeType() {
        $chargeType = ChargeService::getChargeType();
        return parent::jCode(0, 1600, $chargeType);
    }


    /**
     * 充值接口
     * @param type $userId
     * @param type $money
     * @param type $describle
     * @return type
     */
    public function recharge($userId,$money,$describle,$chargeStatus) {
        $recharge = ChargeService::recharge($userId,$money,$describle,$chargeStatus);
         if($recharge->getError()){
            return parent::jCode(1633,$recharge->getError());
        }
        return parent::jCode(1634,null,$recharge->chargeCode);
    }
    
    /**
     * 提现接口
     * @param type $userId
     * @param type $money
     * @param type $describle
     * @return type
     */
    public function tixian($userId,$money,$describle) {
        $tixian = ChargeService::tixian($userId,$money,$describle);
        if($tixian->getError()){
            return parent::jCode(1631,$tixian->getError());
        }
        return parent::jCode(1632);
    }

    /**
     * 消费记录接口
     * @param type $userId
     * @return type
     */
    public function recordConsume($userId) {
        $recordConsume = ChargeService::recordConsume($userId);
        return parent::jCode(0, 1610, $recordConsume->toArray());
    }
    
    /**
     * 充值记录接口
     * @param type $userId
     * @return type
     */
    public function recordRecharge($userId) {
        $recordRecharge = ChargeService::recordRecharge($userId);
        return parent::jCode(0, 1620, $recordRecharge->toArray());
    }
    
    
    /**
     * 提现记录接口
     * @param type $userId
     * @return type
     */
    public function recordTixian($userId) {
        $recordTixian = ChargeService::recordTixian($userId);
        return parent::jCode(0, 1630, $recordTixian->toArray());
    }

}
