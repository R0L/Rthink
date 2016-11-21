<?php

namespace application\common\model;

/**
 * @author ROL
 * @date 2016-11-10 10:19:32
 * @version V1.0
 * @desc   
 */
class Period extends Base {

    
    const PERIODS_INLOTTERY = 0 ;// 开奖中
    const PERIODS_HASLOTTERY = 1 ;// 已开奖
    
    public static $periodsStstus=[0 => '开奖中',1=>'已开奖'];
    
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
