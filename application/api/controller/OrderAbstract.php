<?php

namespace application\api\controller;
/**
 * @author ROL
 * @date 2016-11-25 13:07:25
 * @version V1.0
 * @desc   
 */
abstract class OrderAbstract extends Api{
    
    
//    /**
//     * 购物车
//     */
//    abstract function shoppingcart($userId);
//    
//    
//    /**
//     * 购物编辑
//     */
//    abstract function eidt($orderId,$buyTime);
//    
//    /**
//     * 购物编辑
//     */
//    abstract function add($userId,$periodId,$buyTime);
    
    
    
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
