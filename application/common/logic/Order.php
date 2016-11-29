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
//        return OrderModel::where(["o.user_id"=>$userId,"o.order_status"=>["in",$orderStatus]])
//                ->alias('o')
//                ->join("period p","p.id = o.period_id")
//                ->join("goods g","g.id = p.goods_id")
//                ->join("picture pi","pi.id = g.cover_id")
//                ->join("user u","u.id = p.user_id")
//                ->field('p.period_no,pi.path,g.title,o.buy_time,o.order_code,u.user_name,')
//                ->paginate();
        return OrderModel::paginate(["user_id"=>$userId,"order_status"=>["in",$orderStatus]]);
    }
    
    
    /**
     * 获取订单 根据$userId
     * @param type $orderId
     * @return type
     */
    public static function isExistOrderId($orderId) {
        return OrderModel::where(["id"=>$orderId])->find(); 
    }
    
    /**
     * 添加购物车
     * @param type $userId
     * @param type $periodId
     * @param type $buyTime
     * @return type
     */
    public function addOrder($userId,$periodId,$buyTime,$orderStatus=OrderModel::ORDER_SHOPPINGCART) {
        return OrderLogic::create(["user_id"=>$userId,"period_id"=>$periodId,"buy_time"=>$buyTime,"order_status"=>$orderStatus]);
    }
    
}
