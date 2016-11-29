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
     * 进行中
     */
    abstract function inlottery($userId);
    
    /**
     * 已揭晓
     */
    abstract function haslottery($userId);
    
    /**
     * 已中奖
     */
    abstract function haswin($userId);
    
    
}
