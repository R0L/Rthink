<?php
namespace application\common\service;
use application\common\logic\Order as OrderLogic;
use application\common\logic\Period as PeriodLogic;
use application\common\logic\Picture as PictureLogic;
use application\common\logic\Goods as GoodsLogic;
use application\common\logic\User as UserLogic;
use application\common\api\Result;
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
    public static function shopCar($userId) {
        $shoppingcart = OrderLogic::selectByOrderStatus($userId,OrderLogic::ORDER_SHOPPINGCART);
        foreach ($shoppingcart as $item) {
            $periodGet = PeriodLogic::get($item->period_id);
            $goodsGet = GoodsLogic::get($periodGet->goods_id);
            $pictureGet = PictureLogic::getPathById($goodsGet->cover_id);
            $item->data("goods_picture",$pictureGet);//商品图片
            $item->data("goods_title",$goodsGet["title"]);//商品名称
            $item->data("total_time",$goodsGet["total_time"]);//总份数
            $item->data("buy_time",$item["buy_time"]);//购买份数
            $item->data("surplus_time",$goodsGet["total_time"]-$periodGet["buy_time"]);//剩余次数
            $item->visible(["goods_picture","goods_title","total_time","buy_time","surplus_time"]);
        }
        return Result::success(1830,$shoppingcart);
        
    }
    
    
    /**
     * 编辑购物车
     * @param type $orderId
     * @param type $buyTime
     * @return type
     */
    public static function shopCarEidt($orderId, $buyTime) {
        if(empty($buyTime)){
            $delById = OrderLogic::delById($orderId);
            if(empty($delById)){
                return Result::error(1846);
            }
            return Result::success(1847);
        }
        $updateModel = OrderLogic::update(["buy_time"=>$buyTime], ["id"=>$orderId]);
        if($updateModel->getError()){
            return Result::error(1841,$updateModel->getError());
        }
        return Result::success(1840);
    }
    
    
    /**
     * 添加购物车
     * @param type $userId
     * @param type $periodId
     * @param type $buyTime
     */
    public static function shopCarAdd($userId, $periodId, $buyTime) {
        $addModel = OrderLogic::addOrder($userId, $periodId, $buyTime);
        if($addModel->getError()){
            return Result::error(1843,$addModel->getError());
        }
//        $addBuyTime = PeriodLogic::addBuyTime($periodId,$buyTime);
//        if(empty($addBuyTime)){
//            return Result::error(1845,$addOrder->getError());
//        }
        return Result::success(1844);
    }
    
    
    
    
     /**
     * 进行中
     * @param type $userId
     * @return type
     */
    public static function inlottery($userId) {
        $inlottery = OrderLogic::selectByOrderStatus($userId, OrderLogic::ORDER_HAVEINHAND);
         foreach ($inlottery as $item) {
            $periodGet = PeriodLogic::get($item->period_id);
            $goodsGet = GoodsLogic::get($periodGet->goods_id);
            $pictureGet = PictureLogic::getPathById($goodsGet->cover_id);
            $item->data("periods_no",$periodGet["periods_no"]);//期号
            $item->data("periods_status",$periodGet["periods_status"]);//期状
            $item->data("goods_picture",$pictureGet);//商品图片
            $item->data("goods_title",$goodsGet["title"]);//商品名称
            $item->data("buy_time",$item["buy_time"]);//购买份数
            $item->data("indiana_number",$item["indiana_number"]);//夺宝号码
            $item->data("total_time",$goodsGet["total_time"]);//总次数
            $item->data("surplus_time",$goodsGet["total_time"]-$periodGet["buy_time"]);//剩余次数
            $item->data("count_down",time()-$goodsGet["count_down"]-$periodGet["update_time"]);//倒计时间
            $item->visible(["periods_no","periods_status","goods_picture","goods_title","buy_time","indiana_number","total_time","surplus_time","count_down"]);
        }
        return Result::success(1320,$inlottery);
    }
    
    /**
     * 已揭晓
     * @param type $userId
     * @return type
     */
    public static function haslottery($userId) {
        $haslottery = OrderLogic::selectByOrderStatus($userId, [OrderLogic::ORDER_HASWONTHEPRIZE,OrderLogic::ORDER_NOTWINNING,OrderLogic::ORDER_SUNSHEET]);
        foreach ($haslottery as $item) {
            $periodGet = PeriodLogic::get($item->period_id);
            $goodsGet = GoodsLogic::get($periodGet->goods_id);
            $pictureGet = PictureLogic::getPathById($goodsGet->cover_id);
            $userOrderGet = OrderLogic::findByPeriodIdWin($item->period_id);
            $userGet = UserLogic::get($userOrderGet->user_id); 
            $item->data("periods_no",$periodGet["periods_no"]);//期号
            $item->data("goods_picture",$pictureGet);//商品图片
            $item->data("goods_title",$goodsGet["title"]);//商品名称
            $item->data("buy_time",$item["buy_time"]);//购买份数
            $item->data("indiana_number",$periodGet["lucky_number"]);//夺宝号码
            $item->data("announce_time",$periodGet["update_time"]);//揭晓日期
            $item->data("win_user_name",$userGet["user_name"]);//获奖者名称
            $item->data("win_buy_time",$userOrderGet["buy_time"]);//获奖者购买次数
            $item->data("lucky_number",$userOrderGet["indiana_number"]);//夺宝号码
            $item->visible(["periods_no","goods_picture","goods_title","buy_time","indiana_number","announce_time","win_user_name","win_buy_time","lucky_number"]);
        }
        return Result::success(1300,$haslottery);
    }
    
    /**
     * 已中奖
     * @param type $userId
     * @return type
     */
    public static function haswin($userId) {
        $haswin = OrderLogic::selectByOrderStatus($userId, [OrderLogic::ORDER_HASWONTHEPRIZE,OrderLogic::ORDER_SUNSHEET]);
        foreach ($haswin as $item) {
            $periodGet = PeriodLogic::get($item->period_id);
            $goodsGet = GoodsLogic::get($periodGet->goods_id);
            $pictureGet = PictureLogic::getPathById($goodsGet->cover_id);
            $item->data("periods_no",$periodGet["periods_no"]);//期号
            $item->data("goods_picture",$pictureGet);//商品图片
            $item->data("goods_title",$goodsGet["title"]);//商品名称
            $item->data("buy_time",$item["buy_time"]);//购买份数
            $item->data("indiana_number",$periodGet["lucky_number"]);//夺宝号码
            $item->data("announce_time",$periodGet["update_time"]);//揭晓日期
            $item->visible(["periods_no","goods_picture","goods_title","buy_time","indiana_number","announce_time"]);
        }
        return Result::success(1310,$haswin);
    }
    
}
