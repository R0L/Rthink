<?php

namespace application\api\controller;

/**
 * @author ROL
 * @date 2016-11-30 11:18:06
 * @version V1.0
 * @desc   
 */
abstract class GoodsAbstract extends Api {
    
    /**
     * 商品详情
     */
    abstract function goodsDetails($goodsId);
    
    /**
     * 商品图文
     */
    abstract function goodsImageText($goodsId);
    
    /**
     * 历史中奖记录
     */
    abstract function historyLottery($goodsId);
    
}
