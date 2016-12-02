<?php

namespace application\common\model;

/**
 * @author ROL
 * @date 2016-11-10 10:19:32
 * @version V1.0
 * @desc   
 */
class Period extends BasePub {

    
    const PERIODS_PURCHASE = 0 ;// 购买中
    const PERIODS_INLOTTERY = 1 ;// 开奖中
    const PERIODS_HASLOTTERY = 2 ;// 已开奖
    
    public static $periodsStstus = [0 => '购买中', 0 => '开奖中', 1 => '已开奖'];

    
    //自动完成
    protected $insert = [ 'create_time', 'pub_id'];
    
    
    /**
     * 获取期数状态
     * @param type $periods_status
     * @param type $data
     * @return type
     */
    public function getPeriodsStatusTextAttr($periods_status, $data) {
        if (empty($periods_status)) {
            $periods_status = $data["periods_status"];
        }
        return self::$periodsStstus[intval($periods_status)];
    }
    
    /**
     * 条件:购买中
     * @param type $query
     */
    protected function scopePurchase($query){
        $query->where(["periods_status"=>  Period::PERIODS_PURCHASE]);
    }
    
    
    /**
     * 期数中的商品
     * @return type
     */
    public function goods() {
        return $this->belongsTo("application\common\model\Goods", "goods_id", "id");
    }

    /**
     * 期数中的中奖用户
     * @return type
     */
    public function user() {
        return $this->belongsTo('application\common\model\User', "user_id", "id");
    }

}
