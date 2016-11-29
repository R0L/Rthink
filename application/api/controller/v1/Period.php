<?php

namespace application\api\controller\v1;
use application\api\controller\PeriodAbstract;
use application\common\service\Period as PeriodService;
/**
 * @author ROL
 * @date 2016-11-29 14:43:18
 * @version V1.0
 * @desc   
 */
class Period extends PeriodAbstract {

    /**
     * 已揭晓接口
     * @param type $userId
     * @return type
     */
    public function haslottery($userId) {
        $haslottery = PeriodService::haslottery($userId);
        return parent::jCode(0,1300,$haslottery->toArray());
    }

    /**
     * 已中奖接口
     * @param type $userId
     * @return type
     */
    public function haswin($userId) {
        $haswin = PeriodService::haswin($userId);
        return parent::jCode(0,1310,$haswin->toArray());
    }

    /**
     * 进行中接口
     * @param type $userId
     * @return type
     */
    public function inlottery($userId) {
        $inlottery = PeriodService::inlottery($userId);
        return parent::jCode(0,1320,$inlottery->toArray());
    }

}
