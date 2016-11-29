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
    public static function selectByPeriodsStatus($userId,$periodsStatus=PeriodModel::PERIODS_INLOTTERY) {
       return PeriodModel::paginate(["user_id"=>$userId,"periods_status"=>$periodsStatus]);
    }
    
    /**
     * 最新（时间）
     * @return type
     */
    public static function selectOyCreateTime() {
        return PeriodModel::order("create_time desc")->paginate();
    }
    
    /**
     * 进度（购买人次/总次数）
     * @return type
     */
    public static function selectOyBuyTimeTotalTime() {
//        return PeriodModel::hasWhere($relation, $where)
        return PeriodModel::order("buy_time desc")->paginate();
    }
    
    /**
     * 人次（购买人次)
     * @return type
     */
    public static function selectOyBuyTime() {
//        return PeriodModel::hasWhere($relation, $where)
        return PeriodModel::order("buy_time desc")->paginate();
    }
    
    /**
     * 获取当前期数 通过$goodsId
     * @param type $goodsId
     */
    public static function getCurrentPeriodByGoodsId($goodsId){
        return PeriodModel::get(["goods_id"=>$goodsId,"periods_status"=>PeriodModel::PERIODS_INLOTTERY]);
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
    
    
}
