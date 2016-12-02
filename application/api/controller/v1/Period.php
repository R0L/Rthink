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
     * 热门（当前期数）接口
     */
    public function hotPeriod() {
        $hotperiod = PeriodService::hotPeriod();
        return parent::jResult($hotperiod);
    }
    
    /**
     * 最新（时间） 接口
     * @return type
     */
    public function newestPeriod() {
        $newestperiod = PeriodService::newestPeriod();
        return parent::jResult($newestperiod);
    }
    
    /**
     * 进度（购买人次/总次数）接口
     */
    public function progressPeriod() {
        $progressperiod = PeriodService::progressPeriod();
        return parent::jResult($progressperiod);
    }

    /**
     * 人次（购买人次) 接口
     */
    public function mantimePeriod() {
        $mantimePeriod = PeriodService::mantimePeriod();
        return parent::jResult($mantimePeriod);
    }

    /**
     * 即将揭晓接口
     */
    public function soonPeriod() {
        $soonPeriod = PeriodService::soonPeriod();
        return parent::jResult($soonPeriod);
    }


}
