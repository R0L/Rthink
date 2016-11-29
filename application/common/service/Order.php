<?php
namespace application\common\service;
use application\common\logic\Order as OrderLogic;
use application\common\logic\Period as PeriodLogic;
use application\common\logic\Picture as PictureLogic;
use application\common\logic\Goods as GoodsLogic;
/**
 * @author ROL
 * @date 2016-11-10 12:44:15
 * @version V1.0
 * @desc   
 */

class Order extends Common{
    
    
    /**
     * 购物车
     * @param type $userId
     * @return type
     */
    public static function shoppingcart($userId) {
        parent::checkUserId($userId);
        $shoppingcart = OrderLogic::selectByOrderStatus($userId,OrderLogic::ORDER_SHOPPINGCART);
        
        foreach ($shoppingcart as $item) {
            $periodGet = PeriodLogic::get($item->period_id);
            $goodsGet = GoodsLogic::get($periodGet->goods_id);
            $pictureGet = PictureLogic::get($goodsGet->cover_id);
            $item->data("goods_picture",$pictureGet["path"]);//商品图片
            $item->data("goods_title",$goodsGet["title"]);//商品名称
            $item->data("total_time",$goodsGet["total_time"]);//总份数
            $item->data("buy_time",$item["buy_time"]);//购买份数
            $item->data("surplus_time",$goodsGet["total_time"]-$periodGet["buy_time"]);//剩余次数
            $item->visible(["goods_picture","goods_title","total_time","buy_time","surplus_time"]);
        }
        return $shoppingcart;
        
    }
    
    
    
    
    
    
    
    
    /**
     * 编辑购物车
     * @param type $orderId
     * @param type $buyTime
     * @return type
     */
    public static function shoppingcartEidt($orderId, $buyTime) {
        parent::checkOrderId($orderId);
        parent::checkNum($buyTime);
        if(empty($buyTime)){
            $delById = OrderLogic::delById($orderId);
            if(empty($delById)){
                return 1342;
            }
            return 0;
        }
        $updateModel = OrderLogic::update(["buy_time"=>$buyTime], ["id"=>$orderId]);
        if($updateModel->getError()){
            return 1341;
        }
        return 0;
    }
    
    
    /**
     * 添加购物车
     * @param type $userId
     * @param type $periodId
     * @param type $buyTime
     */
    public static function shoppingcartAdd($userId, $periodId, $buyTime) {
        $addOrder = OrderLogic::addOrder(["user_id"=>$userId,"period_id"=>$periodId,"buy_time"=>$buyTime]);
        if($addOrder->getError()){
            return 1343;
        }
        $addBuyTime = PeriodLogic::addBuyTime($periodId,$buyTime);
        if(empty($addBuyTime)){
            return 1345;
        }
        return 0;
    }
    
    
    
}
