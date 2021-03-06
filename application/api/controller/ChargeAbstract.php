<?php

namespace application\api\controller;

/**
 * @author ROL
 * @date 2016-11-25 13:07:25
 * @version V1.0
 * @desc   
 */
abstract class ChargeAbstract extends Api {

    /**
     * 支持支付的类型
     */
    abstract function getChargeType();

    /**
     * 充值
     */
    abstract function recharge($userId,$money,$chargeType,$describle);

    /**
     * 提现
     */
    abstract function tixian($userId,$money,$describle);

    /**
     * 消费记录
     */
    abstract function recordConsume($userId);

    /**
     * 充值记录
     */
    abstract function recordRecharge($userId);

    /**
     * 提现记录
     */
    abstract function recordTixian($userId);
}
