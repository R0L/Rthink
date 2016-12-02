<?php

namespace application\common\model;

/**
 * @author ROL
 * @date 2016-11-10 16:12:02
 * @version V1.0
 * @desc   
 */
class Charge extends BasePub {
    
    
    const CHARGE_FAILURE = -1; //失败
    const CHARGE_INIT = 0; //初始化
    const CHARGE_SUCCESS = 1; //成功

    public static $chargeStstus=[-1 => '失败', 0 => '初始化', 1 => '成功'];
    
    
    const CHARGE_TYPE_SYSTEM = 0; //系统支付
    const CHARGE_TYPE_ALIPAY = 1; //支付宝支付
    const CHARGE_TYPE_WECHATPAY = 2; //微信支付
    const CHARGE_TYPE_UNIONPAY = 3; //银联支付
    const CHARGE_TYPE_INTEGRATION = 4; //积分支付
    const CHARGE_TYPE_REDPACKET = 5; //红包支付
    const CHARGE_TYPE_TIXIAN = 6; //提现
    
    
    public static $chargeTypeStatus = [0 => '系统支付', 1 => '支付宝支付',2=>'微信支付',3=>"银联支付",4=>"积分支付",5=>"红包支付",6=>"提现"];
    
    
    
    protected $insert = ['charge_status'=>0, 'create_time', 'pub_id'];
    
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
        return self::$chargeStstus[intval($charge_status)];
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
        return self::$chargeTypeStatus[intval($charge_type)];
    }
    
    /**
     * 账单中的用户
     * @return type
     */
    public function user(){
        return $this->belongsTo('application\common\model\User',"user_id","id");
    }
}
