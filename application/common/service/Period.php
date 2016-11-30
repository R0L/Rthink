<?php
namespace application\common\service;
use application\common\logic\Period as PeriodLogic;
use application\common\logic\Share as ShareLogic;
use application\common\logic\Goods as GoodsLogic;
use application\common\logic\Picture as PictureLogic;
use application\common\logic\User as UserLogic;
use application\common\logic\Order as OrderLogic;
/**
 * @author ROL
 * @date 2016-11-10 12:44:15
 * @version V1.0
 * @desc   
 */

class Period{
    
    /**
     * 进行中
     * @param type $userId
     * @return type
     */
    public static function inlottery($userId) {
        $inlottery = PeriodLogic::selectByPeriodsStatus($userId,PeriodLogic::PERIODS_INLOTTERY);
         foreach ($inlottery as $item) {
            $goodsGet = GoodsLogic::get($item->goods_id);
            $pictureGet = PictureLogic::get($goodsGet->cover_id);
            $orderGet = OrderLogic::get(["user_id"=>$userId,"period_id"=>$item->id]);
            $item->data("periods_no",$item["periods_no"]);//期号
            $item->data("goods_picture",$pictureGet["path"]);//商品图片
            $item->data("goods_title",$goodsGet["title"]);//商品名称
            $item->data("buy_time",$orderGet["buy_time"]);//购买份数
            $item->data("indiana_number",$orderGet["indiana_number"]);//夺宝号码
            $item->data("total_time",$goodsGet["total_time"]);//总次数
            $item->data("surplus_time",$goodsGet["total_time"]-$item["buy_time"]);//剩余次数
            $item->data("count_down",time()-$goodsGet["count_down"]-$item["announce_time"]);//倒计时间
            $item->visible(["periods_no","goods_picture","goods_title","buy_time","indiana_number","total_time","surplus_time","count_down"]);
        }
        return $inlottery;
    }
    
    /**
     * 已揭晓
     * @param type $userId
     * @return type
     */
    public static function haslottery($userId) {
        $haslottery = PeriodLogic::selectByPeriodsStatus($userId,PeriodLogic::PERIODS_HASLOTTERY);
        foreach ($haslottery as $item) {
            $goodsGet = GoodsLogic::get($item->goods_id);
            $pictureGet = PictureLogic::get($goodsGet->cover_id);
            $orderGet = OrderLogic::get(["user_id"=>$userId,"period_id"=>$item->id]);
            $userGet = UserLogic::get($item->user_id); 
            $userOrderGet = OrderLogic::get(["order_code"=>$item->order_code]);
            $item->data("periods_no",$item["periods_no"]);//期号
            $item->data("goods_picture",$pictureGet["path"]);//商品图片
            $item->data("goods_title",$goodsGet["title"]);//商品名称
            $item->data("buy_time",$orderGet["buy_time"]);//购买份数
            $item->data("indiana_number",$orderGet["indiana_number"]);//夺宝号码
            $item->data("announce_time",$item["announce_time"]);//揭晓日期
            $item->data("win_user_name",$userGet["user_name"]);//获奖者名称
            $item->data("win_buy_time",$userOrderGet["buy_time"]);//获奖者购买次数
            $item->data("lucky_number",$userOrderGet["lucky_number"]);//夺宝号码
            $item->visible(["periods_no","goods_picture","goods_title","buy_time","indiana_number","announce_time","win_user_name","win_buy_time","lucky_number"]);
        }
        return $haslottery;
    }
    
    /**
     * 已中奖
     * @param type $userId
     * @return type
     */
    public static function haswin($userId) {
        $haswin = PeriodLogic::selectByPeriodsStatus($userId,PeriodLogic::PERIODS_HASLOTTERY);
        foreach ($haswin as $item) {
            $goodsGet = GoodsLogic::get($item->goods_id);
            $pictureGet = PictureLogic::get($goodsGet->cover_id);
            $orderGet = OrderLogic::get(["user_id"=>$userId,"period_id"=>$item->id]);
            $item->data("periods_no",$item["periods_no"]);//期号
            $item->data("goods_picture",$pictureGet["path"]);//商品图片
            $item->data("goods_title",$goodsGet["title"]);//商品名称
            $item->data("buy_time",$orderGet["buy_time"]);//购买份数
            $item->data("indiana_number",$orderGet["indiana_number"]);//夺宝号码
            $item->data("announce_time",$item["announce_time"]);//揭晓日期
            $item->visible(["periods_no","goods_picture","goods_title","buy_time","indiana_number","announce_time"]);
        }
        return $haswin;
    }
    
    /**
     * 热门（当前期数）
     * @return type
     */
    public static function hotPeriod() {
        $hotPeriod = GoodsLogic::selectOyCurrentPeriods();
        foreach ($hotPeriod as $item) {
            $periodGet = PeriodLogic::getCurrentPeriodByGoodsId($item->id);
            $pictureGet = PictureLogic::get($hotPeriod->cover_id);
            $item->data("periods_no",$periodGet["periods_no"]);//期号
            $item->data("goods_picture",$pictureGet["path"]);//商品图片
            $item->data("goods_title",$hotPeriod["title"]);//商品名称
            $item->data("total_time",$hotPeriod["total_time"]);//购买份数
            $item->data("buy_time",$periodGet["buy_time"]);//购买份数
            $item->visible(["periods_no","goods_picture","goods_title","total_time","buy_time"]);
        }
        return $hotPeriod;
    }
    
    /**
     * 最新（时间）
     * @return type
     */
    public static function newestPeriod() {
        $newestperiod = PeriodLogic::selectOyCreateTime();
        foreach ($newestperiod as $item) {
            $goodsGet = GoodsLogic::get($item->goods_id);
            $pictureGet = PictureLogic::get($goodsGet->cover_id);
            $item->data("periods_no",$item["periods_no"]);//期号
            $item->data("goods_picture",$pictureGet["path"]);//商品图片
            $item->data("goods_title",$goodsGet["title"]);//商品名称
            $item->data("total_time",$goodsGet["total_time"]);//购买份数
            $item->data("buy_time",$item["buy_time"]);//购买份数
            $item->visible(["periods_no","goods_picture","goods_title","total_time","buy_time"]);
        }
        return $newestperiod;
    }
    
    /**
     * 进度（购买人次/总次数）
     * @return type
     */
    public static function progressPeriod() {
        $progressperiod = PeriodLogic::selectOyBuyTimeTotalTime();
        $result = [];
        foreach ($progressperiod as $item) {
            $goodsGet = GoodsLogic::get($item["goods_id"]);
            $pictureGet = PictureLogic::get($goodsGet->cover_id);
            $item["periods_no"] = $item["periods_no"];//期号
            $item["goods_picture"] = $pictureGet["path"];//商品图片
            $item["goods_title"] = $goodsGet["title"];//商品名称
            $item["total_time"] = $goodsGet["total_time"];//购买份数
            $item["buy_time"] = $item["buy_time"];//购买份数
            unset($item["order_code"]);
            unset($item["goods_id"]);
            unset($item["user_id"]);
            unset($item["lucky_number"]);
            unset($item["periods_name"]);
            unset($item["create_time"]);
            unset($item["update_time"]);
            unset($item["announce_time"]);
            unset($item["delete_time"]);
            unset($item["periods_status"]);
            unset($item["pub_id"]);
            $result[] = $item;
        }
//        foreach ($progressperiod as $item) {
//            $goodsGet = GoodsLogic::get($item->goods_id);
//            $pictureGet = PictureLogic::get($goodsGet->cover_id);
//            $item->data("periods_no",$item["periods_no"]);//期号
//            $item->data("goods_picture",$pictureGet["path"]);//商品图片
//            $item->data("goods_title",$goodsGet["title"]);//商品名称
//            $item->data("total_time",$goodsGet["total_time"]);//购买份数
//            $item->data("buy_time",$item["buy_time"]);//购买份数
//            $item->visible(["periods_no","goods_picture","goods_title","total_time","buy_time"]);
//        }
        return $result;
    }
    
    /**
     * 人次（购买人次)
     */
    public static function mantimePeriod() {
        $mantimePeriod = PeriodLogic::selectOyBuyTime();
        foreach ($mantimePeriod as $item) {
            $goodsGet = GoodsLogic::get($item->goods_id);
            $pictureGet = PictureLogic::get($goodsGet->cover_id);
            $item->data("periods_no",$item["periods_no"]);//期号
            $item->data("goods_picture",$pictureGet["path"]);//商品图片
            $item->data("goods_title",$goodsGet["title"]);//商品名称
            $item->data("total_time",$goodsGet["total_time"]);//购买份数
            $item->data("buy_time",$item["buy_time"]);//购买份数
            $item->visible(["periods_no","goods_picture","goods_title","total_time","buy_time"]);
        }
        return $mantimePeriod;
    }
    
    /**
     * 即将揭晓
     * @param type $param
     */
    public static function soonPeriod() {
        $mantimePeriod = PeriodLogic::selectToPeriods();
        foreach ($mantimePeriod as $key=>$item) {
            $goodsGet = GoodsLogic::get($item->goods_id);
            $pictureGet = PictureLogic::get($goodsGet->cover_id);
            if($goodsGet["total_time"] == $item["buy_time"] && time()-$goodsGet["count_down"]-$item["announce_time"]>0){
                $item->data("periods_no",$item["periods_no"]);//期号
                $item->data("goods_picture",$pictureGet["path"]);//商品图片
                $item->data("goods_title",$goodsGet["title"]);//商品名称
                $item->data("total_time",$goodsGet["total_time"]);//总份数
                $item->data("buy_time",$item["buy_time"]);//购买份数
                $item->data("surplus_time",$goodsGet["total_time"]-$item["buy_time"]);//剩余次数
                $item->data("count_down",time()-$goodsGet["count_down"]-$item["announce_time"]);//倒计时间
                $item->visible(["periods_no","goods_picture","goods_title","total_time","buy_time","surplus_time","count_down"]);
            }else{
                unset($mantimePeriod[$key]);
            }
        }
        return $mantimePeriod;
    }
    
}
