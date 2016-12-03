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
    public static function addOrder($userId,$periodId,$buyTime,$orderStatus=OrderModel::ORDER_SHOPPINGCART) {
        return OrderModel::create(["user_id"=>$userId,"period_id"=>$periodId,"buy_time"=>$buyTime,"order_status"=>$orderStatus]);
    }
    
    
    /**
     * 获取中奖订单 通过$periodId
     * @param type $periodId
     * @return type
     */
    public static function findByPeriodIdWin($periodId) {
        return OrderModel::get(["period_id"=>$periodId,"order_status"=>OrderModel::ORDER_HASWONTHEPRIZE]);
    }
    
    
    /**
     * 获取订单，用户，用户信息 通过$periodId
     * @param type $periodId
     * @return type
     */
    public static function selectByPeriodId($periodId) {
        return OrderModel::field('order_code,indiana_number,buy_time,create_time,order_status')->with([
                    "user" => function($query) {
                        $query->withField('user_name,last_login_ip');
                    },
                    "userinfo" => function($query) {
                        $query->withField('portrait,nick_name');
                    },
                    ])->where(["period_id"=>$periodId])->order(["create_time"=>"desc"])->paginate();
  
    }
    
    /**
     * 最后50个用户的开奖时间
     * @param type $periodId
     */
    public static function getLastUserBuyTime($periodsId) {
        return OrderModel::where(["period_id"=>$periodsId])->count("create_time");
    }
    
    /**
     * 获取中奖人订单信息
     * @param type $periodsId
     * @param type $lotteryValue
     * @return type
     */
    public static function lotteryOrder($periodsId,$lotteryValue) {
        return OrderModel::where(["period_id"=>$periodsId,"indiana_number"=>$lotteryValue])->find();
    }
}
