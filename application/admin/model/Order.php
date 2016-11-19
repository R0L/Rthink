<?php

namespace application\admin\model;

/**
 * @author ROL
 * @date 2016-11-10 10:19:16
 * @version V1.0
 * @desc   
 */
class Order extends Base {
    
    
    const ORDER_SHOPPINGCART = 0 ;// 加入购物车
    const ORDER_HAVEINHAND = 1 ;// 进行中
    const ORDER_HASWONTHEPRIZE = 2 ;// 已中奖
    const ORDER_NOTWINNING = -1 ;// 未中奖
    const ORDER_SUNSHEET = -1 ;// 已晒单
    
    public static $orderStstus=[-1 => '未中奖', 0 => '加入购物车', 1 => '进行中', 2 => '已中奖', 3 => '已晒单'];
    
    /**
     * 获取订单状态
     * @param type $status
     * @param type $data
     * @return string
     */
    public function getOrderStatusTextAttr($status, $data) {
        if (empty($status)) {
            $status = $data["status"];
        }
        return self::$orderStstus[intval($status)];
    }
    
    /**
     * 设置订单ORDERCODE
     * @param type $value
     * @param type $data
     * @return type
     */
    public function setOrderCodeAttr($value, $data) {
        if(empty($value)){
            $order_code = $data["order_code"];
        }
        $OrderCode = $order_code === NULL ? get_rand_number(10000000, 99999999, 8) : $order_code;
        return serialize($OrderCode);
    }
    
    
     /**
     * 订单中的期数
     * @return type
     */
    public function period() {
        return $this->belongsTo("application\admin\model\Period", "period_id", "id");
    }

    /**
     * 订单中的用户
     * @return type
     */
    public function user() {
        return $this->belongsTo('application\admin\model\User', "user_id", "id");
    }

}
