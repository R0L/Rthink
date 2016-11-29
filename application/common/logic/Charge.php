<?php

namespace application\common\logic;
use application\common\model\Charge as ChargeModel;

/**
 * @author ROL
 * @date 2016-11-22 13:29:10
 * @version V1.0
 * @desc   
 */
class Charge extends ChargeModel {
    
    
    /**
     * 充值
     * @param array $data
     * @return type
     */
    public static function recharge($data) {
        $data["money"] = -$data["money"] ;
        return $this->payment($data);
    }
    
    /**
     * 支付
     * @param type $data
     * @return type
     */
    public static function payment($userId,$money,$describle ="",$chargeCode="",$chargeType = ChargeModel::CHARGE_TYPE_SYSTEM,$chargeStatus=ChargeLogic::CHARGE_SUCCESS) {
        $data["user_id"] = $userId;
        $data["money"] = $money;
        $data["describle"] = $describle;
        $data["charge_code"] = $chargeCode;
        $data["charge_type"] = $chargeType;
        $data["charge_status"] = $chargeStatus;
        return ChargeModel::create($data);
    }
    
    /**
     * 获得消费记录 通过$chargeStatus
     * @param type $param
     */
    public static function selectByChargeStatus($userId,$chargeStatus=  ChargeModel::CHARGE_TYPE_TIXIAN) {
        return ChargeModel::paginate(["user_id"=>$userId,"charge_status"=>$chargeStatus]);
    }
    
    /**
     * 获得消费记录 通过$chargeStatus 默认false 消费
     * @param type $param
     */
    public static function selectByMoneyCon($userId,$moneyCon=false) {
        $map["user_id"] = $userId;
        if($moneyCon){
            $map["money"] = ["elt",0];
        }else{
            $map["money"] = ["gt",0];
        }
        return ChargeModel::paginate($map);
    }
    
}
