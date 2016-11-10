<?php

namespace application\admin\model;

/**
 * @author ROL
 * @date 2016-11-10 16:12:02
 * @version V1.0
 * @desc   
 */
class Charge extends Base {
    
    /**
     * 获取账单的状态的格式化
     * @param type $charge_status
     * @param type $data
     * @return string
     */
    public function getChargeStatusTextAttr($charge_status, $data) {
        if (empty($charge_status)) {
            $charge_status = $data["charge_status"];
        }
        $op_status = [-1 => '失败', 0 => '初始化', 1 => '成功'];
        return $op_status[intval($charge_status)];
    }
    
    /**
     * 获取账单的方式的格式化
     * @param type $charge_type
     * @param type $data
     * @return string
     */
    public function getChargeTypeTextAttr($charge_type, $data) {
        if (empty($charge_type)) {
            $charge_type = $data["charge_type"];
        }
        $op_status = [0 => '系统支付', 1 => '支付宝支付',2=>'微信支付',3=>"银联支付",4=>"积分支付",5=>"红包支付",6=>"提现"];
        return $op_status[intval($charge_type)];
    }
    
    /**
     * 账单中的用户
     * @return type
     */
    public function user(){
        return $this->belongsTo('application\admin\model\User',"user_id","id");
    }
}
