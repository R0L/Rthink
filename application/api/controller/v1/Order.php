<?php

namespace application\api\controller\v1;
use application\api\controller\OrderAbstract;
use application\common\service\Order as OrderService;
/**
 * @author ROL
 * @date 2016-12-2 15:30:19
 * @version V1.0
 * @desc   
 */
class Order extends OrderAbstract{
    
    /**
     * 进行中接口
     */
    public function haslottery($userId) {
        $haslottery = OrderService::haslottery($userId);
        return parent::jResult($haslottery);
    }
    /**
     * 已揭晓接口
     */
    public function haswin($userId) {
         $haswin = OrderService::haswin($userId);
        return parent::jResult($haswin);
    }

    /**
     * 已中奖接口
     */
    public function inlottery($userId) {
        $inlottery = OrderService::inlottery($userId);
        return parent::jResult($inlottery);
    }
    
    
    /**
     * 添加订单接口
     * @param type $userId
     * @param type $periodId
     */
    public function addOrder($userId, $periodId,$buyTime) {
        $addOrder = OrderService::addOrder($userId, $periodId,$buyTime);
        return parent::jResult($addOrder);
    }


}
