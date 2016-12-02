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
    public function getChargeType() {
        $result = ChargeService::getChargeType();
        return parent::jResult($result);
    }


    /**
     * 充值接口
     * @param type $userId
     * @param type $money
     * @param type $chargeType
     * @param type $describle
     * @param type $chargeStatus
     * @return type
     */
    public function recharge($userId,$money,$chargeType,$describle) {
        $result = ChargeService::recharge($userId,$money,$chargeType,$describle);
        return parent::jResult($result);
    }
    
    /**
     * 提现接口
     * @param type $userId
     * @param type $money
     * @param type $describle
     * @return type
     */
    public function tixian($userId,$money,$describle) {
        $result = ChargeService::tixian($userId,$money,$describle);
        return parent::jResult($result);
    }

    /**
     * 消费记录接口
     * @param type $userId
     * @return type
     */
    public function recordConsume($userId) {
        $recordConsume = ChargeService::recordConsume($userId);
        return parent::jResult($recordConsume);
    }
    
    /**
     * 充值记录接口
     * @param type $userId
     * @return type
     */
    public function recordRecharge($userId) {
        $recordRecharge = ChargeService::recordRecharge($userId);
        return parent::jResult($recordRecharge);
    }
    
    
    /**
     * 提现记录接口
     * @param type $userId
     * @return type
     */
    public function recordTixian($userId) {
        $recordTixian = ChargeService::recordTixian($userId);
        return parent::jResult($recordTixian);
    }

}
