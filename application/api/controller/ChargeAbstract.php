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
    abstract function chargeType();

    /**
     * 充值
     */
    abstract function recharge();

    /**
     * 提现
     */
    abstract function tixian();

    /**
     * 消费记录
     */
    abstract function consumeRecharge();

    /**
     * 充值记录
     */
    abstract function recordRecharge();

    /**
     * 提现记录
     */
    abstract function recordTixian();
}
