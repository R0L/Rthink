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
     * 获取按照当前期数排序的分页
     */
//    public static function selectOyCurrentPeriods() {
////        return GoodsModel::scope("goods_status")->order("current_periods desc")->paginate();
//        return GoodsModel::scope("goods_status")->alias("goods")->join("period","")
//    }
}
