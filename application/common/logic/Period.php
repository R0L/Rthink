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
       return PeriodModel::paginate(["periods_status"=>["in",$periodsStatus]]);
    }
    
    /**
     * 最新（时间）
     * @return type
     */
    public static function selectOyCreateTime() {
        return PeriodModel::scopePurchase()->order("create_time desc")->paginate();
    }
    
    /**
     * 进度（购买人次/总次数）
     * @return type
     */
    public static function selectOyBuyTimeTotalTime() {
//        return PeriodModel::hasWhere($relation, $where)
        return \think\Db::name("period")->alias('p')->field("*",false,"goods","p")->join("goods g","p.goods_id = g.id", 'LEFT' )->
                order("p.buy_time/g.total_time desc")->paginate();
    }
    
    /**
     * 人次（购买人次)
     * @return type
     */
    public static function selectOyBuyTime() {
//        return PeriodModel::hasWhere($relation, $where)
        return PeriodModel::scopePurchase()->order("buy_time desc")->paginate();
    }
    
    
    /**
     * 获取当前期数 通过$goodsId
     * @param type $goodsId
     */
    public static function getCurrentPeriodByGoodsId($goodsId){
        return PeriodModel::get(["goods_id"=>$goodsId,"periods_status"=>PeriodModel::PERIODS_PURCHASE]);
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
        return PeriodModel::scope("Purchase")->with("goods")->select();
    }
    
}
