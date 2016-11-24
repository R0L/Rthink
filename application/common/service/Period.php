<?php
namespace application\common\service;
use application\common\logic\Period as PeriodLogic;
use application\common\logic\Share as ShareLogic;
use application\common\logic\Goods as GoodsLogic;
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
        $shareLogic =new ShareLogic();
        return $shareLogic->add($data);
    }
    /**
     * 编辑晒单
     * @param type $id
     * @param type $data
     * @return type
     */
    public function editShare($id,$data) {
        $shareLogic =new ShareLogic();
        return $shareLogic->edit($data, ["id"=>$id]);
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
