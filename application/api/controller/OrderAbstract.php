<?php

namespace application\api\controller;
/**
 * @author ROL
 * @date 2016-11-25 13:07:25
 * @version V1.0
 * @desc   
 */
abstract class OrderAbstract extends Api{
    
    
    /**
     * 购物车
     */
    abstract function shoppingcart($userId);
    
    
    /**
     * 购物编辑
     */
    abstract function shoppingcartEidt($orderId,$buyTime);
    
    /**
     * 购物编辑
     */
    abstract function shoppingcartAdd($userId,$periodId,$buyTime);
    
}
