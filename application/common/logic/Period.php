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
     * @param type $uiserId
     * @param type $periodsStatus
     * @return type
     */
    public static function selectByPeriodsStatus($uiserId,$periodsStatus=PeriodModel::PERIODS_INLOTTERY) {
       return PeriodModel::all(["user_id"=>$uiserId,"periods_status"=>$periodsStatus]);
    }
    
    
}
