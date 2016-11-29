<?php

namespace application\api\controller\v1;
use application\api\controller\OrderAbstract;
use application\common\service\Order as OrderSerive;
/**
 * @author ROL
 * @date 2016-11-29 10:28:18
 * @version V1.0
 * @desc   
 */
class Order extends OrderAbstract {
    
    /**
     * 购物车接口
     * @param type $userId
     * @return type
     */
    public function shoppingcart($userId) {
        $shoppingcart = OrderSerive::shoppingcart($userId);
        return parent::jCode(0,1330,$shoppingcart->toArray());
    }
    
    
    /**
     * 编辑购物车接口
     * @param type $userId
     * @param type $orderId
     * @param type $buyTime
     */
    public function shoppingcartEidt($orderId, $buyTime) {
        $shoppingcartEidt = OrderSerive::shoppingcartEidt($orderId, $buyTime);
        return parent::jCode($shoppingcartEidt,1340);
    }
    
    /**
     * 添加购物车接口
     * @param type $userId
     * @param type $periodId
     * @param type $buyTime
     */
    public function shoppingcartAdd($userId, $periodId, $buyTime) {
        $shoppingcartAdd = OrderSerive::shoppingcartAdd($userId, $periodId, $buyTime);
        return parent::jCode($shoppingcartAdd,1343);
    }

    


}
