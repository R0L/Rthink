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
        $hotPeriod = PeriodLogic::selectOyCurrentPeriods();
        foreach ($hotPeriod as $item) {
            $pictureGet = PictureLogic::getPathById($item->goods->cover_id);
            $item->data("periods_no",$item["periods_no"]);//期号
            $item->data("goods_picture",$pictureGet);//商品图片
            $item->data("goods_title",$item->goods["title"]);//商品名称
            $item->data("total_time",$item->goods["total_time"]);//总共份数
            $item->data("buy_time",$item["buy_time"]);//购买份数
            $item->visible(["periods_no","goods_picture","goods_title","total_time","buy_time"]);
        }
        return Result::success(1330,$hotPeriod);
    }
    
    /**
     * 最新（时间）
     * @return type
     */
    public static function newestPeriod() {
        $newestperiod = PeriodLogic::selectOyCreateTime();
        foreach ($newestperiod as $item) {
            $pictureGet = PictureLogic::getPathById($item->goods->cover_id);
            $item->data("periods_no",$item["periods_no"]);//期号
            $item->data("goods_picture",$pictureGet);//商品图片
            $item->data("goods_title",$item->goods["title"]);//商品名称
            $item->data("total_time",$item->goods["total_time"]);//总共份数
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
//        $result = [];
//        foreach ($progressperiod as $item) {
//            $goodsGet = GoodsLogic::get($item["goods_id"]);
//            $pictureGet = PictureLogic::get($goodsGet->cover_id);
//            $item["periods_no"] = $item["periods_no"];//期号
//            $item["goods_picture"] = $pictureGet["path"];//商品图片
//            $item["goods_title"] = $goodsGet["title"];//商品名称
//            $item["total_time"] = $goodsGet["total_time"];//购买份数
//            $item["buy_time"] = $item["buy_time"];//购买份数
//            unset($item["order_code"]);
//            unset($item["goods_id"]);
//            unset($item["user_id"]);
//            unset($item["lucky_number"]);
//            unset($item["periods_name"]);
//            unset($item["create_time"]);
//            unset($item["update_time"]);
//            unset($item["announce_time"]);
//            unset($item["delete_time"]);
//            unset($item["periods_status"]);
//            unset($item["pub_id"]);
//            $result[] = $item;
//        }
        foreach ($progressperiod as $item) {
            $pictureGet = PictureLogic::get($item->goods->cover_id);
            $item->data("periods_no",$item["periods_no"]);//期号
            $item->data("goods_picture",$pictureGet["path"]);//商品图片
            $item->data("goods_title",$item->goods["title"]);//商品名称
            $item->data("total_time",$item->goods["total_time"]);//购买份数
            $item->data("buy_time",$item["buy_time"]);//购买份数
            $item->visible(["periods_no","goods_picture","goods_title","total_time","buy_time"]);
        }
        return Result::success(1350,$progressperiod);
    }
    
    /**
     * 人次（购买人次)
     */
    public static function mantimePeriod() {
        $mantimePeriod = PeriodLogic::selectOyBuyTime();
        foreach ($mantimePeriod as $item) {
            $pictureGet = PictureLogic::getPathById($item->goods->cover_id);
            $item->data("periods_no",$item["periods_no"]);//期号
            $item->data("goods_picture",$pictureGet);//商品图片
            $item->data("goods_title",$item->goods["title"]);//商品名称
            $item->data("total_time",$item->goods["total_time"]);//总共份数
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
        $mantimePeriod = PeriodLogic::selectToPeriods(PeriodLogic::PERIODS_INLOTTERY);
        foreach ($mantimePeriod as $item) {
            $pictureGet = PictureLogic::getPathById($item->goods->cover_id);
            $item->data("periods_no",$item["periods_no"]);//期号
            $item->data("goods_picture",$pictureGet);//商品图片
            $item->data("goods_title",$item->goods["title"]);//商品名称
            $item->data("total_time",$item->goods["total_time"]);//总份数
            $item->data("buy_time",$item["buy_time"]);//购买份数
            $item->data("surplus_time",$item->goods["total_time"]-$item["buy_time"]);//剩余次数
            $item->data("count_down",time()-$item->goods["count_down"]-$item["update_time"]);//倒计时间
            $item->visible(["periods_no","goods_picture","goods_title","total_time","buy_time","surplus_time","count_down"]);
        }
        return Result::success(1360,$mantimePeriod);
    }
    
    /**
     * 当前期数参与的人数
     * @param type $periodId
     */
    public static function currentPeriodPerson($periodId) {
        $currentPerson = OrderLogic::selectByPeriodId($periodId);
        foreach ($currentPerson as $item) {
            $pictureGet = PictureLogic::getPathById($item->userinfo->portrait);
            $item->data("user_picture",$pictureGet);//用户头像
            $item->data("nick_name",$item->userinfo["nick_name"]);//用户昵称
            $item->data("user_ip",$item->user["last_login_ip"]);//ip
            $item->data("join_time",$item["create_time"]);//购买时间
            $item->visible(["user_picture","nick_name","user_ip","join_time"]);
        }
        return Result::success(1380,$currentPerson);
    }
    
    
    /**
     * 开奖
     */
    public static function lottery() {
        $lotteryPeriod = PeriodLogic::lotteryPeriod();
        
        foreach ($lotteryPeriod as $period) {
            
            $lotteryValue = (intval(self::ssq())+intval(OrderLogic::getLastUserBuyTime($period["pid"])))%(intval($period["gid"])+intval($period["total_time"]))+intval($period["gid"]);
            
            
            $lotteryOrder = OrderLogic::lotteryOrder($period["pid"], $lotteryValue);
            
            
            $lotteryUpdate = PeriodLogic::lotteryUpdate($period["pid"], $lotteryOrder["user_id"], $lotteryValue);
            
            
            $addPersiods = GoodsLogic::addPersiods($period["goods_id"]);
            
            if(empty($addPersiods)){
                return Result::error();//添加期数失败
            }
            
            //生成下一期
            $addPeriod = PeriodLogic::addPeriod($period["goods_id"], intval($period["periods_no"])+1);
            
            if($addPeriod->getError()){
                return Result::error();//生成期数失败
            }
            
            
            
            
            
            
        }
        
    }
    

    
    
    
    /**
     * 双色球
     * @return string
     */
    public static function ssq() {
        $ch = curl_init();
        $url = 'http://apis.baidu.com/apistore/lottery/lotteryquery?lotterycode=ssq&recordcnt=1';
        $header = array(
            'apikey: baaa384bf64d518283e7efc87ccd29a1',
        );
        // 添加apikey到header
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行HTTP请求
        curl_setopt($ch, CURLOPT_URL, $url);
        $res = curl_exec($ch);

        $lottery = json_decode($res);

        if (empty($lottery->errNum)) {
            $temp = $lottery->retData->data[0]->openCode;
            $result = array_sum(explode(",", str_replace("+", ",", $temp)));
//            Cache::set($lottery->retData->data[0]->openTimeStamp, $result);
        } else {
            $result = "0000";
        }
        return $result;
    }

}
