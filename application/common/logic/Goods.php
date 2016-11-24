<?php

namespace application\common\logic;
use application\common\model\Goods as GoodsModel;
/**
 * @author ROL
 * @date 2016-11-24 11:06:33
 * @version V1.0
 * @desc   
 */
class Goods extends GoodsModel{
    
    
    /**
     * 热门（当前期数）
     */
    public static function selectOyCurrentPeriods() {
        return GoodsModel::order("current_periods desc")->paginate();
    }
}
