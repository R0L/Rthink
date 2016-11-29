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
            $userGet = UserLogic::get($item->user_id); 
            $userOrderGet = OrderLogic::get(["order_code"=>$item->order_code]);
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
     * 晒单
     * @return type
     */
    public function listShare() {
        return ShareLogic::selectToShare();
    }
    
    /**
     * 添加晒单
     * @param type $data
     * @return type
     */
    public function addShare($data) {
        return ShareLogic::create($data);
    }
    /**
     * 编辑晒单
     * @param type $id
     * @param type $data
     * @return type
     */
    public function editShare($id,$data) {
        return ShareLogic::update($data, ["id"=>$id]);
    }
    
    /**
     * 期数列表
     * @param type $type 热门（当前期数）、最新（时间）、进度（购买人次/总次数）、人次（购买人次) 0、1、2、3
     * 4 即将揭晓
     * @return type
     */
    public function listPeriod($type){
        switch ($type) {
            case 0:
                GoodsLogic::selectOyCurrentPeriods();
                break;
            case 1:
                PeriodLogic::selectOyCreateTime();
                break;
            case 2:
                PeriodLogic::selectOyBuyTimeTotalTime();
                break;
            case 3:
                PeriodLogic::selectOyBuyTime();
                break;
            case 4:
                PeriodLogic::selectOyBuyTime();
                break;

            default:
                break;
        }
    }
    
    
    
    
}
