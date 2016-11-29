<?php

namespace application\api\controller\v1;
use application\api\controller\ChargeAbstract;
use application\common\service\Charge as ChargeLogic;
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
        $chargeType = ChargeLogic::getChargeType();
        return parent::jCode(0, 1600, $chargeType);
    }

    public function consumeRecharge() {
        
    }

    public function recharge() {
        
    }

    public function recordRecharge() {
        
    }

    public function recordTixian() {
        
    }

    public function tixian() {
        
    }

}
