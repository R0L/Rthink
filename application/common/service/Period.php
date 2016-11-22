<?php
namespace application\common\service;
use application\common\logic\Period as PeriodLogic;
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
    public function inlottery($userId) {
        return PeriodLogic::selectByPeriodsStatus($userId,PeriodLogic::PERIODS_INLOTTERY);
    }
    
    /**
     * 已揭晓
     * @param type $userId
     * @return type
     */
    public function haslottery($userId) {
        return PeriodLogic::selectByPeriodsStatus($userId,PeriodLogic::PERIODS_HASLOTTERY);
    }
    
    /**
     * 已中奖
     * @param type $userId
     * @return type
     */
    public function haswin($userId) {
        return PeriodLogic::selectByPeriodsStatus($userId,PeriodLogic::PERIODS_HASLOTTERY);
    }
}
