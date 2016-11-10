<?php

namespace application\admin\model;

/**
 * @author ROL
 * @date 2016-11-10 10:19:32
 * @version V1.0
 * @desc   
 */
class Period extends Base {

    
    public function getPeriodsStatusTextAttr($periods_status, $data) {
        if (empty($periods_status)) {
            $periods_status = $data["periods_status"];
        }
        $op_status = [0 => '开奖中',1=>'开奖结束'];
        return $op_status[intval($periods_status)];
    }
    
    /**
     * 期数中的商品
     * @return type
     */
    public function goods() {
        return $this->belongsTo("application\admin\model\Goods", "goods_id", "id");
    }

    /**
     * 期数中的中奖用户
     * @return type
     */
    public function user() {
        return $this->belongsTo('application\admin\model\User', "user_id", "id");
    }

}
