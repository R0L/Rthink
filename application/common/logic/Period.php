<?php
namespace application\common\logic;
use application\common\model\Period as PeriodModel;
/**
 * @author ROL
 * @date 2016-11-10 12:44:15
 * @version V1.0
 * @desc   
 */
class Period extends PeriodModel{
    
    
    /**
     * 获取期数信息 通过$periodsStatus
     * @param type $userId
     * @param type $periodsStatus
     * @return type
     */
    public static function selectByPeriodsStatus($userId,$periodsStatus=PeriodModel::PERIODS_PURCHASE) {
       return PeriodModel::paginate(["user_id"=>$userId,"periods_status"=>["in",$periodsStatus]]);
    }
    
    public static function selectToPeriods($periodsStatus=PeriodModel::PERIODS_PURCHASE) {
//       return PeriodModel::paginate(["periods_status"=>["in",$periodsStatus]]);
        return PeriodModel::scope("Purchase")->field('order_code,lucky_number,buy_time,periods_no,periods_status')->with([
                    "goods" => function($query) {
                        $query->withField('title,cover_id,total_time,count_down,total_periods,current_periods,goods_status');
                    },
                    "user" => function($query) {
                        $query->withField('user_name');
                    },
                    ])->where(["periods_status"=>["in",$periodsStatus]])->order(["create_time"=>"desc"])->paginate();
    }
    
    /**
     * 最新（时间）
     * @return type
     */
    public static function selectOyCreateTime() {
//        return PeriodModel::scopePurchase()->order("create_time desc")->paginate();
        return PeriodModel::scope("Purchase")->field('order_code,lucky_number,buy_time,periods_no,periods_status')->with([
                    "goods" => function($query) {
                        $query->withField('title,cover_id,total_time,count_down,total_periods,current_periods,goods_status');
                    },
                    "user" => function($query) {
                        $query->withField('user_name');
                    },
                    ])->order(["create_time"=>"desc"])->paginate();
    }
    
    /**
     * 进度（购买人次/总次数）
     * @return type
     */
    public static function selectOyBuyTimeTotalTime() {
//        return PeriodModel::hasWhere($relation, $where)
//        return \think\Db::name("period")->alias('p')->field("*",false,"goods","p")->join("goods g","p.goods_id = g.id", 'LEFT' )->
//                order("p.buy_time/g.total_time desc")->paginate();
        return PeriodModel::scope("Purchase")->field('order_code,lucky_number,buy_time,periods_no,periods_status')->with([
                    "goods" => function($query) {
                        $query->withField('title,cover_id,total_time,count_down,total_periods,current_periods,goods_status');
                    },
                    "user" => function($query) {
                        $query->withField('user_name');
                    },
                    ])->order(["period.buy_time/goods.total_time"=>"desc"])->paginate();
    }
    
    /**
     * 人次（购买人次)
     * @return type
     */
    public static function selectOyBuyTime() {
//        return PeriodModel::hasWhere($relation, $where)
//        return PeriodModel::scopePurchase()->order("buy_time desc")->paginate();
        return PeriodModel::scope("Purchase")->field('order_code,lucky_number,buy_time,periods_no,periods_status')->with([
                    "goods" => function($query) {
                        $query->withField('title,cover_id,total_time,count_down,total_periods,current_periods,goods_status');
                    },
                    "user" => function($query) {
                        $query->withField('user_name');
                    },
                    ])->order(["buy_time"=>"desc"])->paginate();
    }
    
    
    /**
     * 获取当前期数 通过$goodsId
     * @param type $goodsId
     */
    public static function getCurrentPeriodByGoodsId($goodsId){
        return PeriodModel::scope("Purchase")->order(["create_time"=>"desc"])->get($goodsId);
    }
    
    /**
     * 获取结束的期数  通过$goodsId,$periodsStatus
     * @param type $goodsId
     * @return type
     */
    public static function paginatePeriodByGoodsId($goodsId,$periodsStatus){
//        return PeriodModel::where(["goods_id"=>$goodsId,"periods_status"=>$periodsStatus])->order(["create_time"=>"desc"])->paginate();
        return PeriodModel::field('id,order_code,lucky_number,buy_time,periods_no,periods_status')->with([
                    "user" => function($query) {
                        $query->withField('user_name,last_login_ip');
                    },
                    "userinfo" => function($query) {
                        $query->withField('portrait,nick_name');
                    },
                    ])->where(["goods_id"=>$goodsId,"periods_status"=>$periodsStatus])->order(["create_time"=>"desc"])->paginate();
    }
    
    
    /**
     * 增加购买次数
     * @param type $periodId
     * @param type $addTime
     * @return type
     */
    public static function addBuyTime($periodId,$addTime) {
        return PeriodModel::where(["id"=>$periodId])->setInc("buy_time",$addTime);
    }
    
    
    /**
     * 获得Persiod 通过$userId,$periodId
     * @param type $userId
     * @param type $periodId
     * @return type
     */
    public static function isExistPeriod($userId,$periodId) {
        return PeriodModel::where(["id"=>$periodId,"user_id"=>$userId])->find();
    }
    
    
    public static function selectOyCurrentPeriods() {
        return PeriodModel::scope("Purchase")->field('order_code,lucky_number,buy_time,periods_no,periods_status')->with([
                    "goods" => function($query) {
                        $query->withField('title,cover_id,total_time,count_down,total_periods,current_periods,goods_status');
                    },
                    "user" => function($query) {
                        $query->withField('user_name');
                    },
                    ])->order(["current_periods"=>"desc"])->paginate();
    }
    
    
    
    
    /**
     * 全平台获取购买完的期数
     */
    public static function lotteryPeriod() {
        return DB::name("period")->join("goods", "period.goods_id == goods.id")->field("period.id as pid,goods.id as gid,*")->where(["goods.total_time"=>"period.buy_time","goods.goods_status"=>1,"period.periods_status"=>0])->select();
    }
        
    
    /**
     * 添加期数 通过$goodsId,$periodsNo
     */
    public static function addPeriod($goodsId,$periodsNo) {
       return PeriodModel::create(["goods_id"=>$goodsId,"periods_no"=>$periodsNo]);
    }
    
    
    /**
     * 插入开奖数据
     * @param type $periodsId
     * @param type $userId
     * @param type $luckyNumber
     * @param type $buyTime
     * @return type
     */
    public static function lotteryUpdate($periodsId,$userId,$luckyNumber) {
        return PeriodModel::update(["user_id"=>$userId,"lucky_number"=>$luckyNumber,"periods_status"=>PeriodModel::PERIODS_INLOTTERY],["id"=>$periodsId]);
        
    }

    
    
}
