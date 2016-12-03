<?php

namespace application\api\controller;

/**
 * @author ROL
 * @date 2016-11-29 14:43:29
 * @version V1.0
 * @desc   
 */
abstract class PeriodAbstract extends Api {


    /**
     * 热门（当前期数）
     */
    abstract function hotPeriod();

    /**
     * 最新（时间）
     */
    abstract function newestPeriod();

    /**
     * 进度（购买人次/总次数）
     */
    abstract function progressPeriod();

    /**
     * 人次（购买人次) 
     */
    abstract function mantimePeriod();
    
    /**
     * 即将揭晓
     */
    abstract function soonPeriod();
    
    
    /**
     * 当前期数参与的人数
     */
    abstract function currentPeriodPerson($periodId);
    
}
