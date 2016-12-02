<?php

namespace application\api\controller\v1;
use application\api\controller\Api;
use application\common\service\Order as OrderSerive;
/**
 * @author ROL
 * @date 2016-11-29 10:28:18
 * @version V1.0
 * @desc   
 */
class Shoppingcart extends Api {
    
    /**
     * 购物车接口
     * @param type $userId
     * @return type
     */
    public function index($userId) {
        $shoppingcart = OrderSerive::shopCar($userId);
        return parent::jResult($shoppingcart);
    }
    
    
    /**
     * 编辑购物车接口
     * @param type $orderId
     * @param type $buyTime
     */
    public function edit($orderId, $buyTime) {
        $shopCarEidt = OrderSerive::shopCarEidt($orderId, $buyTime);
        return parent::jResult($shopCarEidt);
    }
    
    /**
     * 添加购物车接口
     * @param type $userId
     * @param type $periodId
     * @param type $buyTime
     */
    public function add($userId, $periodId, $buyTime) {
        $shopCarAdd = OrderSerive::shopCarAdd($userId, $periodId, $buyTime);
        return parent::jResult($shopCarAdd);
    }


}
