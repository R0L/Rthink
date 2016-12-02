<?php
namespace application\common\service;
use application\common\logic\Period as PeriodLogic;
use application\common\logic\Goods as GoodsLogic;
use application\common\logic\Picture as PictureLogic;
use application\common\logic\User as UserLogic;
use application\common\logic\Order as OrderLogic;
use application\common\api\Result;
/**
 * @author ROL
 * @date 2016-11-10 12:44:15
 * @version V1.0
 * @desc   
 */

class Period{
    
    /**
     * 热门（当前期数）
     * @return type
     */
    public static function hotPeriod() {
//        $hotPeriod = GoodsLogic::selectOyCurrentPeriods();
//        foreach ($hotPeriod as $item) {
//            $periodGet = PeriodLogic::getCurrentPeriodByGoodsId($item->id);
//            $pictureGet = PictureLogic::getPathById($item->cover_id);
//            $item->data("periods_no",$periodGet["periods_no"]);//期号
//            $item->data("goods_picture",$pictureGet);//商品图片
//            $item->data("goods_title",$item["title"]);//商品名称
//            $item->data("total_time",$item["total_time"]);//总共份数
//            $item->data("buy_time",$periodGet["buy_time"]);//购买份数
//            $item->visible(["periods_no","goods_picture","goods_title","total_time","buy_time"]);
//        }
        $hotPeriod = PeriodLogic::selectOyCurrentPeriods();
        return Result::success(1330,$hotPeriod);
    }
    
    /**
     * 最新（时间）
     * @return type
     */
    public static function newestPeriod() {
        $newestperiod = PeriodLogic::selectOyCreateTime();
        foreach ($newestperiod as $item) {
            $goodsGet = GoodsLogic::get($item->goods_id);
            $pictureGet = PictureLogic::getPathById($goodsGet->cover_id);
            $item->data("periods_no",$item["periods_no"]);//期号
            $item->data("goods_picture",$pictureGet);//商品图片
            $item->data("goods_title",$goodsGet["title"]);//商品名称
            $item->data("total_time",$goodsGet["total_time"]);//总共份数
            $item->data("buy_time",$item["buy_time"]);//购买份数
            $item->visible(["periods_no","goods_picture","goods_title","total_time","buy_time"]);
        }
        return Result::success(1340,$newestperiod);
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
        return Result::success(1350,$result);
    }
    
    /**
     * 人次（购买人次)
     */
    public static function mantimePeriod() {
        $mantimePeriod = PeriodLogic::selectOyBuyTime();
        foreach ($mantimePeriod as $item) {
            $goodsGet = GoodsLogic::get($item->goods_id);
            $pictureGet = PictureLogic::getPathById($goodsGet->cover_id);
            $item->data("periods_no",$item["periods_no"]);//期号
            $item->data("goods_picture",$pictureGet);//商品图片
            $item->data("goods_title",$goodsGet["title"]);//商品名称
            $item->data("total_time",$goodsGet["total_time"]);//总共份数
            $item->data("buy_time",$item["buy_time"]);//购买份数
            $item->visible(["periods_no","goods_picture","goods_title","total_time","buy_time"]);
        }
        return Result::success(1360,$mantimePeriod);
    }
    
    /**
     * 即将揭晓
     * @param type $param
     */
    public static function soonPeriod() {
        $mantimePeriod = PeriodLogic::selectToPeriods(Period::PERIODS_INLOTTERY);
        foreach ($mantimePeriod as $item) {
            $goodsGet = GoodsLogic::get($item->goods_id);
            $pictureGet = PictureLogic::getPathById($goodsGet->cover_id);
            $item->data("periods_no",$item["periods_no"]);//期号
            $item->data("goods_picture",$pictureGet);//商品图片
            $item->data("goods_title",$goodsGet["title"]);//商品名称
            $item->data("total_time",$goodsGet["total_time"]);//总份数
            $item->data("buy_time",$item["buy_time"]);//购买份数
            $item->data("surplus_time",$goodsGet["total_time"]-$item["buy_time"]);//剩余次数
            $item->data("count_down",time()-$goodsGet["count_down"]-$item["announce_time"]);//倒计时间
            $item->visible(["periods_no","goods_picture","goods_title","total_time","buy_time","surplus_time","count_down"]);
        }
        return Result::success(1360,$mantimePeriod);
    }
    
}
