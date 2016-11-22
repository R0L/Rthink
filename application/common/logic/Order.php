<?php
namespace application\common\logic;
use application\common\model\Order as OrderModel;
/**
 * @author ROL
 * @date 2016-11-10 12:44:15
 * @version V1.0
 * @desc   
 */
class Order extends OrderModel{
    
    
    /**
     * 获取订单 通过$orderStatus
     * @param type $userId
     * @param type $orderStatus
     * @return type
     */
    public static function selectByOrderStatus($userId,$orderStatus=OrderModel::ORDER_HAVEINHAND) {
        return OrderModel::all(["user_id"=>$userId,"order_status"=>$orderStatus]);
    }
    
    
}
